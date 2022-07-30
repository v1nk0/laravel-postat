<?php

namespace V1nk0\LaravelPostat;

use V1nk0\LaravelPostat\Data\AddressRow;
use V1nk0\LaravelPostat\Data\CancelShipmentRow;
use V1nk0\LaravelPostat\Data\PickupOrderRow;
use V1nk0\LaravelPostat\Data\ShipmentRow;
use V1nk0\LaravelPostat\Exceptions\PlcException;
use V1nk0\LaravelPostat\Requests\CancelPickupOrder;
use V1nk0\LaravelPostat\Requests\CancelShipments;
use V1nk0\LaravelPostat\Requests\GetAvailableTimeWindowsForPickupOrder;
use V1nk0\LaravelPostat\Requests\ImportPickupOrderBusiness;
use V1nk0\LaravelPostat\Requests\ImportShipment;
use V1nk0\LaravelPostat\Responses\CancelPickupOrderResponse;
use V1nk0\LaravelPostat\Responses\CancelShipmentsResponse;
use V1nk0\LaravelPostat\Responses\GetAvailableTimeWindowsForPickupOrderResponse;
use V1nk0\LaravelPostat\Responses\ImportPickupOrderBusinessResponse;
use V1nk0\LaravelPostat\Responses\ImportShipmentResponse;

class Plc
{
    protected Credentials $credentials;

    protected Environment $environment;

    public function __construct()
    {
        $this->credentials = new Credentials(
            config('services.postat.plc.client_id'),
            config('services.postat.plc.org_unit_guid'),
            config('services.postat.plc.org_unit_id')
        );

        $this->environment = $environment ?? Environment::tryFrom(config('services.postat.plc.env'));
    }

    /**
     * @param string $pickupOrderNumber
     * @return CancelPickupOrderResponse
     * @throws PlcException
     */
    public function cancelPickupOrder(string $pickupOrderNumber): Response
    {
        $request = new CancelPickupOrder($pickupOrderNumber, $this->credentials, $this->environment);
        return $request->submit();
    }

    /**
     * @param CancelShipmentRow[]|CancelShipmentRow $cancelShipmentRow_s
     * @return CancelShipmentsResponse
     * @throws PlcException
     */
    public function cancelShipments(array|CancelShipmentRow $cancelShipmentRow_s): Response
    {
        $request = new CancelShipments($cancelShipmentRow_s, $this->credentials, $this->environment);
        return $request->submit();
    }

    /**
     * @param AddressRow $address
     * @return GetAvailableTimeWindowsForPickupOrderResponse
     * @throws PlcException
     */
    public function getAvailableTimeWindowsForPickupOrder(AddressRow $address): Response
    {
        $request = new GetAvailableTimeWindowsForPickupOrder($address, $this->credentials, $this->environment);
        return $request->submit();
    }

    /**
     * @param PickupOrderRow $pickupOrderRow
     * @return ImportPickupOrderBusinessResponse
     * @throws PlcException
     */
    public function importPickupOrderBusiness(PickupOrderRow $pickupOrderRow): Response
    {
        $request = new ImportPickupOrderBusiness($pickupOrderRow, $this->credentials, $this->environment);
        return $request->submit();
    }

    /**
     * @param ShipmentRow $shipmentRow
     * @return ImportShipmentResponse
     * @throws PlcException
     */
    public function importShipment(ShipmentRow $shipmentRow): Response
    {
        $request = new ImportShipment($shipmentRow, $this->credentials, $this->environment);
        return $request->submit();
    }

    /** Overwrite Client ID */
    public function setClientId(int $clientId)
    {
        $this->credentials->setClientId($clientId);
    }

    /** Overwrite Organisation Unit GUID */
    public function setOrgUnitGuid(string $orgUnitGuid)
    {
        $this->credentials->setOrgUnitGuid($orgUnitGuid);
    }

    /** Overwrite Organisation Unit ID */
    public function setOrgUnitId(int $orgUnitId)
    {
        $this->credentials->setOrgUnitId($orgUnitId);
    }

    /** Overwrite Environment */
    public function setEnvironment(Environment $environment)
    {
        $this->environment = $environment;
    }
}
