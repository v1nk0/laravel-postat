<?php

namespace V1nk0\PostatPlc\Responses;

use V1nk0\PostatPlc\Entities\PickupTimeWindow;
use V1nk0\PostatPlc\Response;

class GetAvailableTimeWindowsForPickupOrderResponse extends Response
{
    /**
     * @param PickupTimeWindow[] $windows
     */
    public function __construct(
        public array $windows
    ){}
}
