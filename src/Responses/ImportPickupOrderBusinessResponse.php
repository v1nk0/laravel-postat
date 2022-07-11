<?php

namespace V1nk0\PostatPlc\Responses;

use V1nk0\PostatPlc\Response;

class ImportPickupOrderBusinessResponse extends Response
{
    public function __construct(
        public ?string $number = null
    ){}
}
