<?php

namespace V1nk0\PostatPlc\Responses;

use V1nk0\PostatPlc\Response;

class CancelPickupOrderResponse extends Response
{
    public function __construct(
        public bool $success = true,
    ){}
}
