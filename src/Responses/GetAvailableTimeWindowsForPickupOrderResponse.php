<?php

namespace V1nk0\LaravelPostat\Responses;

use V1nk0\LaravelPostat\Entities\PickupTimeWindow;
use V1nk0\LaravelPostat\Response;

class GetAvailableTimeWindowsForPickupOrderResponse extends Response
{
    /**
     * @param PickupTimeWindow[] $windows
     */
    public function __construct(
        public array $windows
    ){}
}
