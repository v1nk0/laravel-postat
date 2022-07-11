<?php

namespace V1nk0\LaravelPostat\Responses;

use V1nk0\LaravelPostat\Entities\Collo;
use V1nk0\LaravelPostat\Entities\Label;
use V1nk0\LaravelPostat\Response;

class ImportShipmentResponse extends Response
{
    /**
     * @param Collo[] $colli
     * @param Label|null $label
     */
    public function __construct(
        public array $colli,
        public ?Label $label = null,
    ){}

    public function firstCollo(): ?Collo
    {
        return (isset($this->colli[0])) ? $this->colli[0] : null;
    }

    public function primaryNumber(): ?string
    {
        $firstCollo = $this->firstCollo();

        if(!$firstCollo) {
            return null;
        }

        $firstCode = $firstCollo->getFirstCode();

        if(!$firstCode) {
            return null;
        }

        return $firstCode->code;
    }
}
