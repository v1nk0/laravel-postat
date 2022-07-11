<?php

namespace V1nk0\PostatPlc\Data;

use Spatie\LaravelData\Data;

class ShipmentNumberList extends Data
{
    public function __construct(
        public array $numbers = [],
    ){}

    public function add(string $number)
    {
        $this->numbers[] = $number;
    }

    public function remove(string $number)
    {
        foreach($this->numbers as $k => $num)
        {
            if($number === $num) {
                unset($this->numbers[$k]);
            }
        }
    }

    public function hasEntries(): bool
    {
        return (count($this->numbers) > 0);
    }

    public function toXml(): string
    {
        $xml = '';

        foreach($this->numbers as $number) {
            $xml .= '<arr:string>' . $number . '</arr:string>' . "\r\n";
        }

        return rtrim($xml, "/\r|\n/");
    }
}
