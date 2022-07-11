<?php

return [
    'client' => [
        'id' => env('POSTAT_PLC_CLIENT_ID'),
    ],
    'org_unit' => [
        'id' => env('POSTAT_PLC_ORG_UNIT_ID'),
        'guid' => env('POSTAT_PLC_ORG_UNIT_GUID'),
    ],
    'env' => env('POSTAT_PLC_ENV', 'TEST'),
];
