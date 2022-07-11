<?php

namespace V1nk0\LaravelPostat\Responses;

use V1nk0\LaravelPostat\Response;

class CancelPickupOrderResponse extends Response
{
    public function __construct(
        public bool $success = true,
    ){}
}
