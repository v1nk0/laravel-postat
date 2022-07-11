<?php

namespace V1nk0\LaravelPostat\Entities;

class ColloCode
{
    public function __construct(
        public string $code,
        public ?int $numberTypeId = null,
        public ?string $carrierThirdPartyId = null,
    ){}
}
