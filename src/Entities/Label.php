<?php

namespace V1nk0\LaravelPostat\Entities;

use V1nk0\LaravelPostat\Enums\Encoding;
use V1nk0\LaravelPostat\Enums\LabelFormat;
use V1nk0\LaravelPostat\Enums\PaperLayout;
use V1nk0\LaravelPostat\Enums\PrinterLanguage;

class Label
{
    public function __construct(
        public PrinterLanguage $printerLanguage,
        public LabelFormat $labelFormat,
        public PaperLayout $paperLayout,
        public Encoding $encoding,
        public ?string $base64 = null,
    ){}

    public function content(bool $decode = true): ?string
    {
        if($decode) {
            return ($this->base64) ? base64_decode($this->base64) : null;
        }

        return $this->base64;
    }
}
