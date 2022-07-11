<?php

namespace V1nk0\PostatPlc\Requests;

use SimpleXMLElement;
use V1nk0\PostatPlc\Request;
use V1nk0\PostatPlc\Response;
use V1nk0\PostatPlc\Responses\CancelPickupOrderResponse;

class CancelPickupOrder extends Request
{
    public string $action = 'CancelPickupOrder';

    public function __construct(
        protected string $pickupOrderNumber,
        protected ?string $client_id = null,
        protected ?string $org_unit_guid = null,
        protected ?string $org_unit_id = null,
        protected ?string $env = null,
    ){
        parent::__construct($client_id, $org_unit_guid, $org_unit_id, $env);
    }

    public function getBody(): string
    {
        $body = '<post:clientID>{{CLIENT_ID}}</post:clientID>' . "\r\n";
        $body .= '<post:orgUnitID>{{ORG_UNIT_ID}}</post:orgUnitID>' . "\r\n";
        $body .= '<post:orgUnitGuid>{{ORG_UNIT_GUID}}</post:orgUnitGuid>' . "\r\n";
        $body .= '<post:pickupOrderNumber>'.$this->pickupOrderNumber.'</post:pickupOrderNumber>' . "\r\n";

        return rtrim($body, "/\r|\n/");
    }

    /**
     * @param SimpleXMLElement $response
     * @return CancelPickupOrderResponse
     */
    public function returnResponse(SimpleXMLElement $response): Response
    {
        return new CancelPickupOrderResponse(true);
    }
}
