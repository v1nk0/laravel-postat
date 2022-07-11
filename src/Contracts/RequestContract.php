<?php

namespace V1nk0\PostatPlc\Contracts;

use SimpleXMLElement;
use V1nk0\PostatPlc\Exceptions\PlcException;
use V1nk0\PostatPlc\Response;

interface RequestContract
{
    /** @throws PlcException */
    public function getBody(): string;

    public function returnResponse(SimpleXMLElement $response): Response;
}
