<?php

namespace V1nk0\LaravelPostat\Entities;

use Carbon\Carbon;

class ParcelDetail
{
    /**
     * @param string $customerIdentCode
     * @param string $productName
     * @param string|null $customerShipmentNumber
     * @param string|null $shipmentReferenceNumber
     * @param string|null $costCenterReferenceNumber
     * @param string|null $alternativeReferenceNumber
     * @param Carbon|null $deliveryDay
     * @param string|null $deliveryTimeFrameFrom
     * @param string|null $deliveryTimeFrameTo
     * @param array|null $sapOrderNumber
     * @param array|null $sapInvoiceNumber
     * @param Parcel[] $parcels
     */
    public function __construct(
        public string $customerIdentCode,
        public string $productName,
        public ?string $customerShipmentNumber = null,
        public ?string $shipmentReferenceNumber = null,
        public ?string $costCenterReferenceNumber = null,
        public ?string $alternativeReferenceNumber = null,
        public ?Carbon $deliveryDay = null,
        public ?string $deliveryTimeFrameFrom = null,
        public ?string $deliveryTimeFrameTo = null,
        public ?array $sapOrderNumber = null,
        public ?array $sapInvoiceNumber = null,
        public array $parcels = [],
    ){}

    public function addParcel(Parcel $parcel)
    {
        $this->parcels = $parcel;
    }

    public function getFirstParcel(): ?Parcel
    {
        if(count($this->parcels) < 1) {
            return null;
        }

        $parcels = $this->parcels;
        return reset($parcels);
    }
}
