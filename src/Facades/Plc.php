<?php

namespace V1nk0\LaravelPostat\Facades;

use Illuminate\Support\Facades\Facade;
use V1nk0\LaravelPostat\Data\AddressRow;
use V1nk0\LaravelPostat\Data\CancelShipmentRow;
use V1nk0\LaravelPostat\Data\PickupOrderRow;
use V1nk0\LaravelPostat\Data\ShipmentRow;
use V1nk0\LaravelPostat\Responses\CancelPickupOrderResponse;
use V1nk0\LaravelPostat\Responses\CancelShipmentsResponse;
use V1nk0\LaravelPostat\Responses\GetAvailableTimeWindowsForPickupOrderResponse;
use V1nk0\LaravelPostat\Responses\ImportPickupOrderBusinessResponse;
use V1nk0\LaravelPostat\Responses\ImportShipmentResponse;

/**
 * @method static CancelPickupOrderResponse cancelPickupOrder(string $pickupOrderNumber, string $plc_client_id = null, string $plc_org_unit_guid = null, string $plc_org_unit_id = null, string $plc_env = null)
 * @method static CancelShipmentsResponse cancelShipments(CancelShipmentRow[]|CancelShipmentRow $cancelShipmentRow_s, string $plc_client_id = null, string $plc_org_unit_guid = null, string $plc_org_unit_id = null, string $plc_env = null)
 * @method static GetAvailableTimeWindowsForPickupOrderResponse getAvailableTimeWindowsForPickupOrder(AddressRow $address, string $plc_client_id = null, string $plc_org_unit_guid = null, string $plc_org_unit_id = null, string $plc_env = null)
 * @method static ImportPickupOrderBusinessResponse importPickupOrderBusiness(PickupOrderRow $pickupOrderRow, string $plc_client_id = null, string $plc_org_unit_guid = null, string $plc_org_unit_id = null, string $plc_env = null)
 * @method static ImportShipmentResponse importShipment(ShipmentRow $shipment, string $plc_client_id = null, string $plc_org_unit_guid = null, string $plc_org_unit_id = null, string $plc_env = null)
 */

class Plc extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'postat.plc';
    }
}
