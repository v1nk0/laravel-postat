<?php

namespace V1nk0\LaravelPostat\Responses;

use V1nk0\LaravelPostat\Response;

class ImportPickupOrderBusinessResponse extends Response
{
    public function __construct(
        public ?string $number = null
    ){}
}
