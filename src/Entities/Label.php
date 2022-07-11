<?php

namespace V1nk0\PostatPlc\Entities;

use V1nk0\PostatPlc\Enums\Encoding;
use V1nk0\PostatPlc\Enums\LabelFormat;
use V1nk0\PostatPlc\Enums\PaperLayout;
use V1nk0\PostatPlc\Enums\PrinterLanguage;

class Label
{
    public function __construct(
        public PrinterLanguage $printerLanguage,
        public LabelFormat $labelFormat,
        public PaperLayout $paperLayout,
        public Encoding $encoding,
        public ?string $base64 = null,
    ){}

    public function content(): ?string
    {
        return ($this->base64) ? base64_decode($this->base64) : null;
    }
}
