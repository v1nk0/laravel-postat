<?php

namespace V1nk0\PostatPlc\Requests;

use SimpleXMLElement;
use V1nk0\PostatPlc\Entities\PickupTimeWindow;
use V1nk0\PostatPlc\Request;
use V1nk0\PostatPlc\Data\AddressRow;
use V1nk0\PostatPlc\Response;
use V1nk0\PostatPlc\Responses\GetAvailableTimeWindowsForPickupOrderResponse;

class GetAvailableTimeWindowsForPickupOrder extends Request
{
    public string $action = 'GetAvailableTimeWindowsForPickupOrder';

    public function __construct(protected AddressRow $address)
    {
        parent::__construct();
    }

    public function getBody(): string
    {
        $body = '<post:clientID>{{CLIENT_ID}}</post:clientID>' . "\r\n";
        $body .= '<post:orgUnitID>{{ORG_UNIT_ID}}</post:orgUnitID>' . "\r\n";
        $body .= '<post:orgUnitGuid>{{ORG_UNIT_GUID}}</post:orgUnitGuid>' . "\r\n";
        $body .= '<post:pickupAddressRow>' . "\r\n";
        $body .= $this->address->toXml() . "\r\n";
        $body .= '</post:pickupAddressRow>' . "\r\n";

        return rtrim($body, "/\r|\n/");
    }

    /**
     * @param SimpleXMLElement $response
     * @return GetAvailableTimeWindowsForPickupOrderResponse
     */
    public function returnResponse(SimpleXMLElement $response): Response
    {
        $windows = [];

        foreach($response->GetAvailableTimeWindowsForPickupOrderResult->PickupDateTimeWindowRow as $window) {
            $windows[] = new PickupTimeWindow($window->Date, $window->TimeFrom, $window->TimeTo);
        }

        return new GetAvailableTimeWindowsForPickupOrderResponse($windows);
    }
}
