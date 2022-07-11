<?php

namespace V1nk0\PostatPlc\Data;

use Spatie\LaravelData\Data;

class ColloRow extends Data
{
    /**
     * @param float|null $weight
     * @param int|null $length
     * @param int|null $width
     * @param int|null $height
     * @param ColloCode[] $colloCodeList
     * @param ColloArticleRow[] $colloArticleList
     */

    public function __construct(
        public ?float $weight = null,
        public ?int $length = null,
        public ?int $width = null,
        public ?int $height = null,
        public array $colloCodeList = [],
        public array $colloArticleList = [],
    ){}

    public function toXml(): string
    {
        $xml = '';

        if(count($this->colloCodeList) > 0) {
            $xml .= '    <post:ColloCodeList>' . "\r\n";
                foreach($this->colloCodeList as $colloCode) {
                    $xml .= '       <post:ColloCodeRow>' . "\r\n";
                    $xml .= '           '.$colloCode->toXml() . "\r\n";
                    $xml .= '       </post:ColloCodeRow>' . "\r\n";
                }
            $xml .= '    </post:ColloCodeList>' . "\r\n";
        }

        if(count($this->colloArticleList) > 0) {
            $xml .= '    <post:ColloArticleList>' . "\r\n";
            foreach($this->colloArticleList as $colloArticleRow) {
                $xml .= '       <post:ColloArticleRow>' . "\r\n";
                $xml .= '           '.$colloArticleRow->toXml() . "\r\n";
                $xml .= '       </post:ColloArticleRow>' . "\r\n";
            }
            $xml .= '    </post:ColloArticleList>' . "\r\n";
        }

        if($this->height) {
            $xml .= '   <post:Height>'.$this->height.'</post:Height>' . "\r\n";
        }

        if($this->length) {
            $xml .= '   <post:Length>'.$this->length.'</post:Length>' . "\r\n";
        }

        if($this->weight) {
            $xml .= '   <post:Weight>'.$this->weight.'</post:Weight>' . "\r\n";
        }

        if($this->width) {
            $xml .= '   <post:Width>'.$this->width.'</post:Width>' . "\r\n";
        }

        return rtrim($xml, "/\r|\n/");
    }
}
