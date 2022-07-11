<?php

namespace V1nk0\PostatPlc\Data;

use Spatie\LaravelData\Data;

class ColloArticleRow extends Data
{
    public function __construct(
        public string $articleName,
        public int $quantity,
        public string $unitId,
        public int $HsTariffNumber,
        public string $countryOfOriginId,
        public int $valueOfGoodsPerUnit,
        public string $currencyId,
        public int $consumerUnitNetWeight,
        public int $customsOptionID,
        public ?string $articleNumber = null,
    ){}

    public function toXml(): string
    {
        $xml = '<post:ArticleName>'.$this->articleName.'</post:ArticleName>'."\r\n";

        if($this->articleNumber) {
            $xml .= '<post:ArticleNumber>'.$this->articleNumber.'</post:ArticleNumber>'."\r\n";
        }

        $xml .= '<post:ConsumerUnitNetWeight>'.$this->consumerUnitNetWeight.'</post:ConsumerUnitNetWeight>' . "\r\n";

        $xml .= '<post:CountryOfOriginID>'.$this->countryOfOriginId.'</post:CountryOfOriginID>' . "\r\n";

        $xml .= '<post:CurrencyID>'.$this->currencyId.'</post:CurrencyID>' . "\r\n";

        $xml .= '<post:CustomsOptionID>'.$this->customsOptionID.'</post:CustomsOptionID>';

        $xml .= '<post:HSTariffNumber>'.$this->HsTariffNumber.'</post:HSTariffNumber>' . "\r\n";

        $xml .= '<post:Quantity>'.$this->quantity.'</post:Quantity>' . "\r\n";

        $xml .= '<post:UnitID>'.$this->unitId.'</post:UnitID>' . "\r\n";

        $xml .= '<post:ValueOfGoodsPerUnit>'.$this->valueOfGoodsPerUnit.'</post:ValueOfGoodsPerUnit>' . "\r\n";

        return rtrim($xml, "/\r|\n/");
    }
}
