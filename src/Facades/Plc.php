<?php

namespace V1nk0\PostatPlc\Facades;

use Illuminate\Support\Facades\Facade;
use V1nk0\PostatPlc\Data\AddressRow;
use V1nk0\PostatPlc\Data\CancelShipmentRow;
use V1nk0\PostatPlc\Data\PickupOrderRow;
use V1nk0\PostatPlc\Data\ShipmentRow;
use V1nk0\PostatPlc\Responses\CancelPickupOrderResponse;
use V1nk0\PostatPlc\Responses\CancelShipmentsResponse;
use V1nk0\PostatPlc\Responses\GetAvailableTimeWindowsForPickupOrderResponse;
use V1nk0\PostatPlc\Responses\ImportPickupOrderBusinessResponse;
use V1nk0\PostatPlc\Responses\ImportShipmentResponse;

/**
 * @method static CancelPickupOrderResponse cancelPickupOrder(string $pickupOrderNumber)
 * @method static CancelShipmentsResponse cancelShipments(CancelShipmentRow[]|CancelShipmentRow $cancelShipmentRow_s)
 * @method static GetAvailableTimeWindowsForPickupOrderResponse getAvailableTimeWindowsForPickupOrder(AddressRow $address)
 * @method static ImportPickupOrderBusinessResponse importPickupOrderBusiness(PickupOrderRow $pickupOrderRow)
 * @method static ImportShipmentResponse importShipment(ShipmentRow $shipment)
 */

class Plc extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'plc';
    }
}
