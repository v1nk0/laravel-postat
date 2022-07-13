<?php

namespace V1nk0\LaravelPostat\Requests;

use SimpleXMLElement;
use V1nk0\LaravelPostat\Credentials;
use V1nk0\LaravelPostat\Environment;
use V1nk0\LaravelPostat\Request;
use V1nk0\LaravelPostat\Response;
use V1nk0\LaravelPostat\Responses\CancelPickupOrderResponse;

class CancelPickupOrder extends Request
{
    public string $action = 'CancelPickupOrder';

    public function __construct(
        protected string $pickupOrderNumber,
        protected Credentials $credentials,
        protected Environment $environment
    ){
        parent::__construct($this->credentials, $environment);
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
