<?php

namespace V1nk0\LaravelPostat\Data;

use Spatie\LaravelData\Data;
use V1nk0\LaravelPostat\Enums\PickupLocationType;
use V1nk0\LaravelPostat\Enums\SecurePickupLocationType;

class PickupOrderRow extends Data
{
    public function __construct(
        public AddressRow $pickupAddress,
        public PickupDateTimeWindowRow $pickupDateTimeWindow,
        public ShipmentNumberList $shipmentNumberList,
        public PickupLocationType $pickupLocationType,
        public string $contactPersonName,
        public int $numberOfPackages = 1,
        public ?SecurePickupLocationType $securePickupLocationType = null,
        public ?string $otherSecurePickupLocation = null,
        public ?string $contactPersonTel = null,
        public ?string $contactPersonEmail = null,
        public ?string $reference1 = null,
        public ?string $reference2 = null,
    ){}

    public function toXml(): string
    {
        $xml = '<post:AcceptTermsAndConditions>1</post:AcceptTermsAndConditions>'."\r\n";

        if($this->contactPersonEmail) {
            $xml .= '<post:ContactPersonEmail>'.$this->contactPersonEmail.'</post:ContactPersonEmail>' . "\r\n";
        }

        $xml .= '<post:ContactPersonName>'.$this->contactPersonName.'</post:ContactPersonName>' . "\r\n";

        if($this->contactPersonTel) {
            $xml .= '<post:ContactPersonTel>'.$this->contactPersonTel.'</post:ContactPersonTel>' . "\r\n";
        }

        $xml .= '<post:NumberOfPackages>'.$this->numberOfPackages.'</post:NumberOfPackages>' . "\r\n";

        if($this->otherSecurePickupLocation) {
            $xml .= '<post:OtherSecurePickupLocation>'.$this->otherSecurePickupLocation.'</post:OtherSecurePickupLocation>' . "\r\n";
        }

        $xml .= '<post:PickupAddress>' . "\r\n";
        $xml .= '   '.$this->pickupAddress->toXml()."\r\n";
        $xml .= '</post:PickupAddress>' . "\r\n";

        $xml .= '<post:PickupDateTimeWindow>' . "\r\n";
        $xml .= '   '.$this->pickupDateTimeWindow->toXml() . "\r\n";
        $xml .= '</post:PickupDateTimeWindow>' . "\r\n";

        $xml .= '<post:PickupLocationType>'.$this->pickupLocationType->name.'</post:PickupLocationType>' . "\r\n";

        if($this->reference1) {
            $xml .= '<post:Reference1>'.$this->reference1.'</post:Reference1>' . "\r\n";
        }

        if($this->reference2) {
            $xml .= '<post:Reference2>'.$this->reference2.'</post:Reference2>' . "\r\n";
        }

        if($this->securePickupLocationType) {
            $xml .= '<post:SecurePickupLocationTypeID>'.$this->securePickupLocationType->code().'</post:SecurePickupLocationTypeID>' . "\r\n";
        }

        if($this->shipmentNumberList->hasEntries()) {
            $xml .= '<post:ShipmentNumberList>'."\r\n";
            $xml .= '   '.$this->shipmentNumberList->toXml() . "\r\n";
            $xml .= '</post:ShipmentNumberList>'."\r\n";
        }

        return rtrim($xml, "/\r|\n/");
    }
}
