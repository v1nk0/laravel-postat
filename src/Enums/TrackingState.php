<?php

namespace V1nk0\LaravelPostat\Enums;

enum TrackingState: string
{
    case AN = 'AN';
    case AV = 'AV';
    case EB = 'EB';
    case IV = 'IV';
    case IZ = 'IZ';
    case RE = 'RE';
    case RU = 'RU';
    case ZU = 'ZU';

    public function description(): string
    {
        // @todo: make translatable
        return match($this) {
            self::AN => 'AN - ??', // AN - ??
            self::AV => 'Elektronische Auftragsdaten wurden vom Versender übermittelt', // The sender has provided electronic shipment information
            self::EB => 'EB - Abholbereit?', // EB - Ready for pickup?
            self::IV => 'Sendung in Verteilung', // Item distributed
            self::IZ => 'Sendung in Zustellung', // Item is out for delivery
            self::RE => 'Retour', // Return
            self::RU => 'Verzögerung', // Delay
            self::ZU => 'Sendung zugestellt', // Item delivered
        };
    }

    public function delivered(): bool
    {
        return ($this === self::ZU);
    }

    public function failed(): bool
    {
        return ($this === self::RE);
    }

    public function pending(): bool
    {
        return (!$this->delivered() && !$this->failed());
    }

    public function completed(): bool
    {
        return !$this->pending();
    }
}
