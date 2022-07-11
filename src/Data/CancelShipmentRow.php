<?php

namespace V1nk0\PostatPlc\Data;

use Spatie\LaravelData\Data;

class CancelShipmentRow extends Data
{
    public function __construct(
        public string|int $number,
        public ?ColloCodeList $colloCodeList = null,
    ){}

    public function toXml(): string
    {
        $xml = '<post:ClientID>{{CLIENT_ID}}</post:ClientID>' . "\r\n";

        $xml .= '<post:ColloCodeList>' . "\r\n";

        if($this->colloCodeList && count($this->colloCodeList->colloCodes) > 0) {
            foreach($this->colloCodeList->colloCodes as $colloCode) {
                $xml .= '   <arr:string>'.$colloCode.'</arr:string>' . "\r\n";
            }
        }
        else {
            $xml .= '   <arr:string>'.$this->number.'</arr:string>' . "\r\n";
        }

        $xml .= '</post:ColloCodeList>' . "\r\n";

        $xml .= '<post:Number>'.$this->number.'</post:Number>' . "\r\n";

        $xml .= '<post:OrgUnitGuid>{{ORG_UNIT_GUID}}</post:OrgUnitGuid>' . "\r\n";

        $xml .= '<post:OrgUnitID>{{ORG_UNIT_ID}}</post:OrgUnitID>' . "\r\n";

        return rtrim($xml, "/\r|\n/");
    }
}
