<?php

namespace V1nk0\LaravelPostat\Entities;

use Carbon\Carbon;
use V1nk0\LaravelPostat\Enums\EventTypeCode;
use V1nk0\LaravelPostat\Enums\ReasonCode;
use V1nk0\LaravelPostat\Enums\TrackingState;

class ParcelEvent
{
    public function __construct(
        public Carbon $timestamp,
        public ReasonCode $reasonCode,
        public EventTypeCode $typeCode,
        public TrackingState $trackingState,
        public ?string $country = null,
        public ?string $location = null,
        public ?string $postalCode = null,
        public ?string $consigneeName = null,
        public ?string $remark = null,
        public ?string $branchKey = null,
        public ?string $depository = null,
        public ?Carbon $endOfStorageDate = null,
        public ?string $pickupCode = null,
        public ?int $amount = null,
        public ?string $pickupLink = null,
    ){}
}
