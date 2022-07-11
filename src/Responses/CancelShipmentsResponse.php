<?php

namespace V1nk0\LaravelPostat\Responses;

use V1nk0\LaravelPostat\Entities\CancelShipmentResult;
use V1nk0\LaravelPostat\Response;

class CancelShipmentsResponse extends Response
{
    /**
     * @param CancelShipmentResult[] $shipments
     */
    public function __construct(
        public array $shipments,
    ){}
}
