<?php

namespace V1nk0\LaravelPostat\Data;

use Spatie\LaravelData\Data;

class FeatureRow extends Data
{
    public function __construct(
        public string|int $thirdPartyId,
        public ?string $value1 = null,
        public ?string $value2 = null,
        public ?string $value3 = null,
        public ?string $value4 = null,
    ){}

    public function getThirdPartyId(): ?string
    {
        return $this->thirdPartyId;
    }

    public function hasValue1(): bool
    {
        return (bool)$this->value1;
    }

    public function getValue1(): ?string
    {
        return ($this->value1) ? $this->sanitize($this->valu1) : null;
    }

    public function hasValue2(): bool
    {
        return (bool)$this->value2;
    }

    public function getValue2(): ?string
    {
        return ($this->value2) ? $this->sanitize($this->name2) : null;
    }

    public function hasValue3(): bool
    {
        return (bool)$this->value3;
    }

    public function getValue3(): ?string
    {
        return ($this->value3) ? $this->sanitize($this->name3) : null;
    }

    public function hasValue4(): bool
    {
        return (bool)$this->value4;
    }

    public function getValue4(): ?string
    {
        return ($this->value4) ? $this->sanitize($this->name4) : null;
    }

    private function sanitize($input): string
    {
        return str_replace('&', '&amp;', $input);
    }

    public function toXml(): string
    {
        $xml = '<post:ThirdPartyID>'.$this->getThirdPartyId().'</post:ThirdPartyID>'."\r\n";

        if($this->hasValue1()) {
            $xml .= '<post:Value1>'.$this->getValue1().'</post:Value1>'."\r\n";
        }

        if($this->hasValue2()) {
            $xml .= '<post:Value2>'.$this->getValue2().'</post:Value2>'."\r\n";
        }

        if($this->hasValue3()) {
            $xml .= '<post:Value3>'.$this->getValue3().'</post:Value3>'."\r\n";
        }

        if($this->hasValue4()) {
            $xml .= '<post:Value4>'.$this->getValue4().'</post:Value4>'."\r\n";
        }

        return rtrim($xml, "/\r|\n/");
    }
}
