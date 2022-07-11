<?php

namespace V1nk0\PostatPlc;

use V1nk0\PostatPlc\Data\AddressRow;
use V1nk0\PostatPlc\Data\CancelShipmentRow;
use V1nk0\PostatPlc\Data\ColloCodeList;
use V1nk0\PostatPlc\Data\PickupOrderRow;
use V1nk0\PostatPlc\Data\ShipmentRow;
use V1nk0\PostatPlc\Exceptions\PlcException;
use V1nk0\PostatPlc\Requests\CancelPickupOrder;
use V1nk0\PostatPlc\Requests\CancelShipments;
use V1nk0\PostatPlc\Requests\GetAvailableTimeWindowsForPickupOrder;
use V1nk0\PostatPlc\Requests\ImportPickupOrderBusiness;
use V1nk0\PostatPlc\Requests\ImportShipment;
use V1nk0\PostatPlc\Responses\CancelPickupOrderResponse;
use V1nk0\PostatPlc\Responses\CancelShipmentsResponse;
use V1nk0\PostatPlc\Responses\GetAvailableTimeWindowsForPickupOrderResponse;
use V1nk0\PostatPlc\Responses\ImportPickupOrderBusinessResponse;
use V1nk0\PostatPlc\Responses\ImportShipmentResponse;

class Plc
{
    /**
     * @param string $pickupOrderNumber
     * @return CancelPickupOrderResponse
     * @throws PlcException
     */
    public function cancelPickupOrder(string $pickupOrderNumber): Response
    {
        $request = new CancelPickupOrder($pickupOrderNumber);
        return $request->submit();
    }

    /**
     * @param CancelShipmentRow[]|CancelShipmentRow $cancelShipmentRow_s
     * @return CancelShipmentsResponse
     * @throws PlcException
     */
    public function cancelShipments(array|CancelShipmentRow $cancelShipmentRow_s): Response
    {
        $request = new CancelShipments($cancelShipmentRow_s);
        return $request->submit();
    }

    /**
     * @param AddressRow $address
     * @return GetAvailableTimeWindowsForPickupOrderResponse
     * @throws PlcException
     */
    public function getAvailableTimeWindowsForPickupOrder(AddressRow $address): Response
    {
        $request = new GetAvailableTimeWindowsForPickupOrder($address);
        return $request->submit();
    }

    /**
     * @param PickupOrderRow $pickupOrderRow
     * @return ImportPickupOrderBusinessResponse
     * @throws PlcException
     */
    public function importPickupOrderBusiness(PickupOrderRow $pickupOrderRow): Response
    {
        $request = new ImportPickupOrderBusiness($pickupOrderRow);
        return $request->submit();
    }

    /**
     * @param ShipmentRow $shipmentRow
     * @return ImportShipmentResponse
     * @throws PlcException
     */
    public function importShipment(ShipmentRow $shipmentRow): Response
    {
        $request = new ImportShipment($shipmentRow);
        return $request->submit();
    }
}
