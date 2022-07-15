<?php

namespace V1nk0\LaravelPostat\Facades;

use Exception;
use Illuminate\Support\Facades\Facade;
use V1nk0\LaravelPostat\Entities\ParcelDetail;

/**
 * @method static ParcelDetail|null parcelDetail(string $trackingNumber) {
 *   @throws Exception
 * }
 */

class Tracking extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'postat.tracking';
    }
}
