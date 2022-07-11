<?php

namespace V1nk0\PostatPlc\Data;

use Spatie\LaravelData\Data;

class AddressRow extends Data
{
    public function __construct(
        public string $name1,
        public string $address_line1,
        public string $postal_code,
        public string $city,
        public string $country_id = 'AT',
        public ?string $name2 = null,
        public ?string $name3 = null,
        public ?string $name4 = null,
        public ?string $address2 = null,
        public ?string $address_line2 = null,
        public ?string $house_number = null,
        public ?string $tel1 = null,
        public ?string $tel2 = null,
        public ?string $fax = null,
        public ?string $email = null,
        public ?string $homepage = null,
        public ?string $vat_id = null,
        public ?string $eori_number = null,
        public ?string $personal_tax_number = null,
        public ?string $third_party_id = null,
    ){}

    public function hasName1(): bool
    {
        return (bool)$this->name1;
    }

    public function getName1(): ?string
    {
        return ($this->name1) ? $this->sanitize($this->name1) : null;
    }

    public function hasName2(): bool
    {
        return (bool)$this->name2;
    }

    public function getName2(): ?string
    {
        return ($this->name2) ? $this->sanitize($this->name2) : null;
    }

    public function hasName3(): bool
    {
        return (bool)$this->name3;
    }

    public function getName3(): ?string {
        return ($this->name3) ? $this->sanitize($this->name3) : null;
    }

    public function hasName4(): bool
    {
        return (bool)$this->name4;
    }

    public function getName4(): ?string
    {
        return ($this->name4) ? $this->sanitize($this->name4) : null;
    }

    public function hasAddressLine1(): bool
    {
        return (bool)$this->address_line1;
    }

    public function getAddressLine1(): ?string
    {
        return ($this->address_line1) ? $this->sanitize($this->address_line1) : null;
    }

    public function hasAddressLine2(): bool
    {
        return (bool)$this->address_line2;
    }

    public function getAddressLine2(): ?string
    {
        return ($this->address_line2) ? $this->sanitize($this->address_line2) : null;
    }

    private function sanitize($input): string
    {
        return str_replace('&', '&amp;', $input);
    }

    public function toXml(): string
    {
        $xml = '<post:AddressLine1>'.$this->getAddressLine1().'</post:AddressLine1>'."\r\n";

        if($this->hasAddressLine2()) {
            $xml .= '<post:AddressLine2>'.$this->getAddressLine2().'</post:AddressLine2>'."\r\n";
        }

        $xml .= '<post:City>'.$this->city.'</post:City>'."\r\n";

        $xml .= '<post:CountryID>'.$this->country_id.'</post:CountryID>'."\r\n";

        if($this->eori_number) {
            $xml .= '<post:EORINumber>'.$this->eori_number.'</post:EORINumber>'."\r\n";
        }

        if($this->email) {
            $xml .= '<post:Email>'.$this->email.'</post:Email>'."\r\n";
        }

        if($this->fax) {
            $xml .= '<post:Fax>'.$this->fax.'</post:Fax>'."\r\n";
        }

        if($this->homepage) {
            $xml .= '<post:Homepage>'.$this->homepage.'</post:Homepage>'."\r\n";
        }

        if($this->house_number) {
            $xml .= '<post:HouseNumber>'.$this->house_number.'</post:HouseNumber>'."\r\n";
        }

        $xml .= '<post:Name1>'.$this->getName1().'</post:Name1>'."\r\n";

        if($this->hasName2()) {
            $xml .= '<post:Name2>'.$this->getName2().'</post:Name2>'."\r\n";
        }

        if($this->hasName3()) {
            $xml .= '<post:Name3>'.$this->getName3().'</post:Name3>'."\r\n";
        }

        if($this->hasName4()) {
            $xml .= '<post:Name4>'.$this->getName4().'</post:Name4>'."\r\n";
        }

        if($this->personal_tax_number) {
            $xml .= '<post:PersonalTaxNumber>'.$this->personal_tax_number.'</post:PersonalTaxNumber>'."\r\n";
        }

        $xml .= '<post:PostalCode>'.$this->postal_code.'</post:PostalCode>'."\r\n";

        if($this->tel1) {
            $xml .= '<post:Tel1>'.$this->tel1.'</post:Tel1>'."\r\n";
        }

        if($this->tel2) {
            $xml .= '<post:Tel2>'.$this->tel2.'</post:Tel2>'."\r\n";
        }

        if($this->third_party_id) {
            $xml .= '<post:ThirdPartyID>'.$this->third_party_id.'</post:ThirdPartyID>'."\r\n";
        }

        return rtrim($xml, "/\r|\n/");
    }
}
