<?php

namespace V1nk0\PostatPlc\Enums;

enum Product: string
{
    case RETURN_PARCEL = 'RETURN_PARCEL';
    case RETURN_PARCEL_INTERNATIONAL = 'RETURN_PARCEL_INTERNATIONAL';
    case PREMIUM_LIGHT = 'PREMIUM_LIGHT';
    case PARCEL_PREMIUM_SELECT_AUSTRIA = 'PARCEL_PREMIUM_SELECT_AUSTRIA';
    case SMALL_PARCEL = 'SMALL_PARCEL';
    case NEXT_DAY = 'NEXT_DAY';
    case PARCEL_AUSTRIA = 'PARCEL_AUSTRIA';
    case PARCEL_PREMIUM_INTERNATIONAL = 'PARCEL_PREMIUM_INTERNATIONAL';
    case COMBI_FREIGHT_AUSTRIA = 'COMBI_FREIGHT_AUSTRIA';
    case COMBI_FREIGHT_INTERNATIONAL = 'COMBI_FREIGHT_INTERNATIONAL';
    case PARCEL_PREMIUM_AUSTRIA = 'PARCEL_PREMUIUM_AUSTRIA';
    case POST_EXPRESS_AUSTRIA = 'POST_EXPRESS_AUSTRIA';
    case POST_EXPRESS_INTERNATIONAL = 'POST_EXPRESS_INTERNATIONAL';
    case M_SMALL_PARCEL = 'M_SMALL_PARCEL';
    case PARCEL_PLUS_INTERNATIONAL_OUTBOUND = 'PARCEL_PLUS_INTERNATIONAL_OUTBOUND';
    case PARCEL_PLUS_INTERNATIONAL = 'PARCEL_PLUS_INTERNATIONAL';
    case SMALL_PARCEL_2000 = 'SMALL_PARCEL_2000';
    case SMALL_PARCEL_2000_PLUS = 'SMALL_PARCEL_2000_PLUS';

    public function id(): int|string
    {
        return match($this) {
            Product::RETURN_PARCEL => 28,
            Product::RETURN_PARCEL_INTERNATIONAL => 63,
            Product::PREMIUM_LIGHT => 14,
            Product::PARCEL_PREMIUM_SELECT_AUSTRIA => 30,
            Product::SMALL_PARCEL => 12,
            Product::NEXT_DAY => 65,
            Product::PARCEL_AUSTRIA => 10,
            Product::PARCEL_PREMIUM_INTERNATIONAL => 45,
            Product::COMBI_FREIGHT_AUSTRIA => 47,
            Product::COMBI_FREIGHT_INTERNATIONAL => 49,
            Product::PARCEL_PREMIUM_AUSTRIA => 31,
            Product::POST_EXPRESS_AUSTRIA => '01',
            Product::POST_EXPRESS_INTERNATIONAL => 46,
            Product::M_SMALL_PARCEL => 78,
            Product::PARCEL_PLUS_INTERNATIONAL_OUTBOUND => 70,
            Product::PARCEL_PLUS_INTERNATIONAL => 69,
            Product::SMALL_PARCEL_2000 => 96,
            Product::SMALL_PARCEL_2000_PLUS => 16,
        };
    }

    public function description(): string
    {
        return match($this) {
            Product::RETURN_PARCEL => 'Retourpaket',
            Product::RETURN_PARCEL_INTERNATIONAL => 'Retourpaket International',
            Product::PREMIUM_LIGHT => 'Premium light',
            Product::PARCEL_PREMIUM_SELECT_AUSTRIA => 'Premium Select',
            Product::SMALL_PARCEL => 'Kleinpaket',
            Product::NEXT_DAY => 'Next Day',
            Product::PARCEL_AUSTRIA => 'Paket Österreich',
            Product::PARCEL_PREMIUM_INTERNATIONAL => 'Paket Premium International',
            Product::COMBI_FREIGHT_AUSTRIA => 'Combi-freight Österreich',
            Product::COMBI_FREIGHT_INTERNATIONAL => 'Combi-freight International',
            Product::PARCEL_PREMIUM_AUSTRIA => 'Paket Premium Österreich B2B',
            Product::POST_EXPRESS_AUSTRIA => 'Post Express Österreich',
            Product::POST_EXPRESS_INTERNATIONAL => 'Post Express International',
            Product::M_SMALL_PARCEL => 'Päckchen M mit Sendungsverfolgung',
            Product::PARCEL_PLUS_INTERNATIONAL_OUTBOUND => 'Paket Plus Int. Outbound',
            Product::PARCEL_PLUS_INTERNATIONAL => 'Paket Light Int. non boxable Outbound',
            Product::SMALL_PARCEL_2000 => 'Kleinpaket 2000',
            Product::SMALL_PARCEL_2000_PLUS => 'Kleinpaket 2000 Plus',
        };
    }
}
