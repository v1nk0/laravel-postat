<?php

namespace V1nk0\PostatPlc\Entities;

class CancelShipmentResult
{
    public function __construct(
        public bool $success = false,
        public ?string $number = null,
        public ?string $errorCode = null,
        public ?string $errorMessage = null,
    ){}
}
