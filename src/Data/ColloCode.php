<?php

namespace V1nk0\PostatPlc\Data;

use Spatie\LaravelData\Data;

class ColloCode extends Data
{
    public function __construct(
        public string $code,
        public int $numberTypeId,
    ){}

    public function toXml(): string
    {
        $xml = '<post:Code>'.$this->code.'</post:Code>' . "\r\n";
        $xml .= '<post:NumberTypeID>'.$this->numberTypeId.'</post:NumberTypeID>' . "\r\n";

        return rtrim($xml, "/\r|\n/");
    }
}
