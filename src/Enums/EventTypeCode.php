<?php

namespace V1nk0\LaravelPostat\Enums;

enum EventTypeCode: string
{
    case AVI = 'AVI';
    case AZT = 'AZT';
    case BEI = 'BEI';
    case DAM = 'DAM';
    case HIA = 'HIA';
    case RTS = 'RTS';
    case PKI = 'PKI';
    case PUG = 'PUG';
    case ZUH = 'ZUH';
    case ZUS = 'ZUS';

    public function description(): string
    {
        // @todo: make translatable
        return match($this) {
            self::AVI => 'Elektronische Auftragsdaten wurden vom Versender übermittelt', // The sender has provided electronic shipment information
            self::AZT => 'Sendung in Zustellung', // Item is out for delivery
            self::BEI => 'Sendung in Verteilung', // Item distributed
            self::DAM => 'Beschädigung', // Damage
            self::HIA => 'Sendung in Post-Geschäftsstelle abholbereit', // Item ready for pick up at postal service point
            self::RTS => 'Retour', // Return
            self::PKI => 'e-Benachrichtigung versendet', // e-Notification sent
            self::PUG => 'Sendung in Post-Empfangsbox eingelangt', // Item arrived at Post Pick-Up Box
            self::ZUH => 'Zustellhindernis', // Item could not be delivered
            self::ZUS => 'Sendung zugestellt', // Item delivered
        };
    }
}
