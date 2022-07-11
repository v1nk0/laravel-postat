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
        return 'plc';
    }
}
