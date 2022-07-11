<?php

namespace V1nk0\PostatPlc\Entities;

class ColloCode
{
    public function __construct(
        public string $code,
        public ?int $numberTypeId = null,
        public ?string $carrierThirdPartyId = null,
    ){}
}
