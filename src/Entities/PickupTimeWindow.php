<?php

namespace V1nk0\PostatPlc\Entities;

use Illuminate\Support\Carbon;

class PickupTimeWindow
{
    public Carbon $date;

    public string $timeFrom;

    public string $timeTo;

    public function __construct(mixed $date, string $timeFrom, string $timeTo)
    {
        $this->date = Carbon::parse($date);

        $this->timeFrom = $timeFrom;

        $this->timeTo = $timeTo;
    }
}
