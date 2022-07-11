<?php

namespace V1nk0\PostatPlc\Requests;

use Illuminate\Support\Facades\Log;
use SimpleXMLElement;
use V1nk0\PostatPlc\Data\CancelShipmentRow;
use V1nk0\PostatPlc\Data\ColloCodeList;
use V1nk0\PostatPlc\Entities\CancelShipmentResult;
use V1nk0\PostatPlc\Exceptions\PlcException;
use V1nk0\PostatPlc\Request;
use V1nk0\PostatPlc\Response;
use V1nk0\PostatPlc\Responses\CancelShipmentsResponse;

class CancelShipments extends Request
{
    public string $action = 'CancelShipments';

    /**
     * @param CancelShipmentRow[]|CancelShipmentRow $cancelShipmentRow_s
     */
    public function __construct(protected array|CancelShipmentRow $cancelShipmentRow_s)
    {
        parent::__construct();
    }

    /** @throws PlcException */
    public function getBody(): string
    {
        $cancelShipmentRows = (is_array($this->cancelShipmentRow_s)) ? $this->cancelShipmentRow_s : [$this->cancelShipmentRow_s];

        $body = '<post:shipments>' . "\r\n";

        foreach($cancelShipmentRows as $cancelShipmentRow) {
            $body .= '  <post:CancelShipmentRow>' . "\r\n";
            $body .= '      '.$cancelShipmentRow->toXml();
            $body .= '  </post:CancelShipmentRow>' . "\r\n";
        }

        $body .= '  </post:shipments>' . "\r\n";

        return rtrim($body, "/\r|\n/");
    }

    /**
     * @param SimpleXMLElement $response
     * @return CancelShipmentsResponse
     */
    public function returnResponse(SimpleXMLElement $response): Response
    {
        $shipments = [];

        foreach($response->CancelShipmentsResult->CancelShipmentResult as $shipment) {
            $success = ((string)$shipment->CancelSuccessful === 'true');
            $number = (isset($shipment->Number) && !empty($shipment->Number)) ? (string)$shipment->Number : null;

            $errorCode = (isset($shipment->ErrorCode) && !empty($shipment->ErrorCode)) ? (string)$shipment->ErrorCode : null;
            $errorMessage = (isset($shipment->ErrorMessage) && !empty($shipment->ErrorMessage)) ? (string)$shipment->ErrorMessage : null;
            // @todo: error-handling / error-logging if occurred

            $shipments[] = new CancelShipmentResult($success, $number, $errorCode, $errorMessage);
        }

        return new CancelShipmentsResponse($shipments);
    }
}
