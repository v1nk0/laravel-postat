<?php

namespace V1nk0\LaravelPostat\Contracts;

use SimpleXMLElement;
use V1nk0\LaravelPostat\Exceptions\PlcException;
use V1nk0\LaravelPostat\Response;

interface RequestContract
{
    /** @throws PlcException */
    public function getBody(): string;

    public function returnResponse(SimpleXMLElement $response): Response;
}
