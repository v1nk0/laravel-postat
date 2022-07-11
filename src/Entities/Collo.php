<?php

namespace V1nk0\LaravelPostat\Entities;

class Collo
{
    /**
     * @param ColloCode[] $codes
     */
    public function __construct(
        public array $codes = [],
        public ?int $height = null,
        public ?int $length = null,
        public ?int $width = null,
        public ?float $weight = null,
    ){}

    public function getFirstCode(): ?ColloCode
    {
        return (count($this->codes) > 0) ? $this->codes[0] : null;
    }

    public function addCode(ColloCode $code): void
    {
        $this->codes[] = $code;
    }
}
