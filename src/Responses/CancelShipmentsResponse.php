<?php

namespace V1nk0\PostatPlc\Responses;

use V1nk0\PostatPlc\Entities\CancelShipmentResult;
use V1nk0\PostatPlc\Response;

class CancelShipmentsResponse extends Response
{
    /**
     * @param CancelShipmentResult[] $shipments
     */
    public function __construct(
        public array $shipments,
    ){}
}
