<?php

namespace V1nk0\PostatPlc\Requests;

use SimpleXMLElement;
use V1nk0\PostatPlc\Data\PickupOrderRow;
use V1nk0\PostatPlc\Request;
use V1nk0\PostatPlc\Response;
use V1nk0\PostatPlc\Responses\ImportPickupOrderBusinessResponse;

class ImportPickupOrderBusiness extends Request
{
    public string $action = 'ImportPickupOrderBusiness';

    public function __construct(protected PickupOrderRow $pickupOrderRow)
    {
        parent::__construct();
    }

    public function getBody(): string
    {
        $body = '  <post:clientID>{{CLIENT_ID}}</post:clientID>' . "\r\n";
        $body .= '  <post:orgUnitID>{{ORG_UNIT_ID}}</post:orgUnitID>' . "\r\n";
        $body .= '  <post:orgUnitGuid>{{ORG_UNIT_GUID}}</post:orgUnitGuid>' . "\r\n";
        $body .= '  <post:row>' . "\r\n";
        $body .= '      ' . $this->pickupOrderRow->toXml() . "\r\n";
        $body .= '  </post:row>'. "\r\n";

        return rtrim($body, "/\r|\n/");
    }

    /**
     * @param SimpleXMLElement $response
     * @return ImportPickupOrderBusinessResponse
     */
    public function returnResponse(SimpleXMLElement $response): Response
    {
        $number = (isset($response->ImportPickupOrderBusinessResult) && !empty($response->ImportPickupOrderBusinessResult)) ? (string)$response->ImportPickupOrderBusinessResult : null;
        return new ImportPickupOrderBusinessResponse($number);
    }
}
