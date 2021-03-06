<?php

namespace V1nk0\LaravelPostat\Requests;

use SimpleXMLElement;
use V1nk0\LaravelPostat\Credentials;
use V1nk0\LaravelPostat\Data\ShipmentRow;
use V1nk0\LaravelPostat\Entities\Collo;
use V1nk0\LaravelPostat\Entities\ColloCode;
use V1nk0\LaravelPostat\Entities\Label;
use V1nk0\LaravelPostat\Enums\PrinterLanguage;
use V1nk0\LaravelPostat\Environment;
use V1nk0\LaravelPostat\Request;
use V1nk0\LaravelPostat\Response;
use V1nk0\LaravelPostat\Responses\ImportShipmentResponse;

class ImportShipment extends Request
{
    public string $action = 'ImportShipment';

    public function __construct(
        protected ShipmentRow $shipmentRow,
        protected Credentials $credentials,
        protected Environment $environment
    ){
        parent::__construct($this->credentials, $this->environment);
    }

    public function getBody(): string
    {
        $body = '  <post:row>' . "\r\n";
        $body .= '      ' . $this->shipmentRow->toXml() . "\r\n";
        $body .= '  </post:row>' . "\r\n";

        return rtrim($body, "/\r|\n/");
    }

    /**
     * @param SimpleXMLElement $response
     * @return ImportShipmentResponse
     */
    public function returnResponse(SimpleXMLElement $response): Response
    {
        $colli = [];

        foreach($response->ImportShipmentResult->ColloRow as $colloRow) {

            $collo = new Collo;

            $collo->height = (!empty($colloRow->Height)) ? (int)$colloRow->Height : null;
            $collo->length = (!empty($colloRow->Length)) ? (int)$colloRow->Length : null;
            $collo->weight = (!empty($colloRow->Weight)) ? (float)$colloRow->Weight : null;
            $collo->width = (!empty($colloRow->Width)) ? (int)$colloRow->Width : null;

            foreach($colloRow->ColloCodeList->ColloCodeRow as $colloCodeRow) {
                $collo->addCode(new ColloCode(
                    (string)$colloCodeRow->Code,
                    (!empty($colloRow->NumberTypeId)) ? (int)$colloCodeRow->NumberTypeId : null,
                    (!empty($colloRow->OUCarrierThirdPartyID)) ? (string)$colloCodeRow->OUCarrierThirdPartyID : null,
                ));
            }

            $colli[] = $collo;
        }

        $label = null;
        if($this->shipmentRow->printer) {
            $label = new Label(
                $this->shipmentRow->printer->printerLanguage,
                $this->shipmentRow->printer->labelFormat,
                $this->shipmentRow->printer->paperLayout,
                $this->shipmentRow->printer->encoding,
            );

            if($this->shipmentRow->printer->printerLanguage->name === (PrinterLanguage::ZPL2)->name) {
                $label->base64 = (!empty($response->zplLabelData)) ? (string)$response->zplLabelData : null;
            }

            if($this->shipmentRow->printer->printerLanguage->name === (PrinterLanguage::PDF)->name) {
                $label->base64 = (!empty($response->pdfData)) ? (string)$response->pdfData : null;
            }
        }

        return new ImportShipmentResponse(
            $colli,
            $label
        );
    }
}
