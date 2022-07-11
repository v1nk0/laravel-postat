<?php

namespace V1nk0\LaravelPostat\Entities;

class CancelShipmentResult
{
    public function __construct(
        public bool $success = false,
        public ?string $number = null,
        public ?string $errorCode = null,
        public ?string $errorMessage = null,
    ){}
}
