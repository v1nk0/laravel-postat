<?php

namespace V1nk0\LaravelPostat\Data;

use Spatie\LaravelData\Data;
use V1nk0\LaravelPostat\Enums\Encoding;
use V1nk0\LaravelPostat\Enums\LabelFormat;
use V1nk0\LaravelPostat\Enums\PaperLayout;
use V1nk0\LaravelPostat\Enums\PrinterLanguage;

class PrinterRow extends Data
{
    public function __construct(
        public PrinterLanguage $printerLanguage,
        public LabelFormat $labelFormat = LabelFormat::FORMAT_100x200,
        public PaperLayout $paperLayout = PaperLayout::A5inA4,
        public Encoding $encoding = Encoding::UTF8,
    ){}

    public function toXml(): string
    {
        $xml = '<post:Encoding>'.$this->encoding->code().'</post:Encoding>' . "\r\n";
        $xml .= '<post:LabelFormatID>'.$this->labelFormat->id().'</post:LabelFormatID>' . "\r\n";
        $xml .= '<post:LanguageID>'.$this->printerLanguage->name.'</post:LanguageID>' . "\r\n";
        $xml .= '<post:PaperLayoutID>'.$this->paperLayout->id().'</post:PaperLayoutID>' . "\r\n";

        return rtrim($xml, "/\r|\n/");
    }
}
