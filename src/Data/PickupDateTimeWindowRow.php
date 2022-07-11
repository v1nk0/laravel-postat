<?php

namespace V1nk0\PostatPlc\Data;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class PickupDateTimeWindowRow extends Data
{
    public function __construct(
        public Carbon $date,
        public string $timeFrom,
        public string $timeTo,
    ){}

    public function toXml(): string
    {
        $xml = '<post:Date>'.$this->date->format('Y-m-d').'T00:00:00</post:Date>'."\r\n";
        $xml .= '<post:TimeFrom>'.$this->timeFrom.'</post:TimeFrom>'."\r\n";
        $xml .= '<post:TimeTo>'.$this->timeTo.'</post:TimeTo>'."\r\n";

        return rtrim($xml, "/\r|\n/");
    }
}
