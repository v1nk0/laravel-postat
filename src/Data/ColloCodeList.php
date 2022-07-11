<?php

namespace V1nk0\LaravelPostat\Data;

use Exception;
use Spatie\LaravelData\Data;

class ColloCodeList extends Data
{
    public array $colloCodes = [];

    /** @throws Exception */
    public function __construct(mixed $colloCode_s = null)
    {
        if($colloCode_s) {
            if(is_integer($colloCode_s) || is_string($colloCode_s)) {
                $this->add($colloCode_s);
            }
            elseif(is_array($colloCode_s)) {
                foreach($colloCode_s as $colloCode) {
                    $this->add($colloCode);
                }
            }
            else {
                throw new Exception('Invalid data-type' . gettype($colloCode_s));
            }
        }
    }

    public function add(string|int $colloCode)
    {
        $this->colloCodes[$colloCode] = $colloCode;
    }

    public function remove(string|int $colloCode)
    {
        unset($this->colloCodes[$colloCode]);
    }

    public function toXml(): string
    {
        $xml = '';

        foreach($this->colloCodes as $colloCode) {
            $xml .= '   <arr:string>'.$colloCode.'</arr:string>'."\r\n";
        }

        return rtrim($xml, "/\r|\n/");
    }
}
