<?php

namespace V1nk0\LaravelPostat\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use V1nk0\LaravelPostat\Enums\Product;

class ShipmentRow extends Data
{
    /**
     * @param Product $product
     * @param AddressRow $recipient
     * @param ColloRow[] $colloList
     * @param AddressRow|null $sender
     * @param AddressRow|null $alternativeReturnAddress
     * @param PrinterRow|null $printer
     * @param string|null $number
     * @param string|null $costCenterId
     * @param Carbon|null $shippingDateTimeFrom
     * @param Carbon|null $shippingDateTimeTo
     * @param string|null $senderReference1
     * @param string|null $senderReference2
     * @param string|null $deliveryInstructions
     */
    public function __construct(
        public Product $product,
        public AddressRow $recipient,
        public array $colloList = [],
        public ?AddressRow $sender = null,
        public ?PrinterRow $printer = null,
        public ?AddressRow $alternativeReturnAddress = null,
        public ?string $number = null,
        public ?string $costCenterId = null,
        public ?Carbon $shippingDateTimeFrom = null,
        public ?Carbon $shippingDateTimeTo = null,
        public ?string $senderReference1 = null,
        public ?string $senderReference2 = null,
        public ?string $deliveryInstructions = null,

    ){}

    public function toXml(): string
    {
        $xml = '';

        if($this->alternativeReturnAddress) {
            $xml .= '<post:AlternativeReturnOrgUnitAddress>' . "\r\n";
            $xml .= '   '.$this->alternativeReturnAddress->toXml() . "\r\n";
            $xml .= '</post:AlternativeReturnOrgUnitAddress>' . "\r\n";
        }

        $xml .= '<post:ClientID>{{CLIENT_ID}}</post:ClientID>' . "\r\n";

        if(count($this->colloList) > 0) {
            $xml .= '<post:ColloList>' . "\r\n";
                foreach($this->colloList as $colloRow) {
                    $xml .= '   <post:ColloRow>' . "\r\n";
                    $xml .= '       '.$colloRow->toXml() . "\r\n";
                    $xml .= '   <post:ColloRow>' . "\r\n";
                }
            $xml .= '</post:ColloList>' . "\r\n";
        }

        if($this->costCenterId) {
            $xml .= '<post:CostCenterThirdPartyID>'.$this->costCenterId.'</post:CostCenterThirdPartyID>' . "\r\n";
        }

        if($this->deliveryInstructions) {
            $xml .= '<post:DeliveryInstruction>'.$this->deliveryInstructions.'</post:DeliveryInstruction>' . "\r\n";
        }

        $xml .= '<post:DeliveryServiceThirdPartyID>'.$this->product->id().'</post:DeliveryServiceThirdPartyID>' . "\r\n";

        if($this->number) {
            $xml .= '<post:Number>'.$this->number.'</post:Number>' . "\r\n";
        }

        $xml .= '<post:OURecipientAddress>' . "\r\n";
        $xml .= '   '.$this->recipient->toXml() . "\r\n";
        $xml .= '</post:OURecipientAddress>' . "\r\n";

        if($this->sender) {
            $xml .= '<post:OUShipperAddress>' . "\r\n";
            $xml .= '   '.$this->sender->toXml() . "\r\n";
            $xml .= '</post:OUShipperAddress>' . "\r\n";
        }

        if($this->senderReference1) {
            $xml .= '<post:OUShipperReference1>'.$this->senderReference1.'</post:OUShipperReference1>' . "\r\n";
        }

        if($this->senderReference2) {
            $xml .= '<post:OUShipperReference2>'.$this->senderReference2.'</post:OUShipperReference2>' . "\r\n";
        }

        $xml .= '<post:OrgUnitGuid>{{ORG_UNIT_GUID}}</post:OrgUnitGuid>' . "\r\n";
        $xml .= '<post:OrgUnitID>{{ORG_UNIT_ID}}</post:OrgUnitID>' . "\r\n";

        if($this->printer) {
            $xml .= '<post:PrinterObject>' . "\r\n";
            $xml .= '   ' . $this->printer->toXml() . "\r\n";;
            $xml .= '</post:PrinterObject>' . "\r\n";
        }

        if($this->shippingDateTimeFrom) {
            $xml .= '<post:ShippingDateTimeFrom>'.$this->shippingDateTimeFrom->format('Y-m-d').'T'.$this->shippingDateTimeFrom->format('H:i:s').'</post:ShippingDateTimeFrom>' . "\r\n";
        }

        if($this->shippingDateTimeTo) {
            $xml .= '<post:ShippingDateTimeFrom>'.$this->shippingDateTimeTo->format('Y-m-d').'T'.$this->shippingDateTimeTo->format('H:i:s').'</post:ShippingDateTimeFrom>' . "\r\n";
        }

        return rtrim($xml, "/\r|\n/");
    }
}
