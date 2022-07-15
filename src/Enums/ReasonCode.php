<?php

namespace V1nk0\LaravelPostat\Enums;

enum ReasonCode: string
{
    case AR = 'AR';
    case AT = 'AT';
    case BC = 'BC';
    case BF = 'BF';
    case BN = 'BN';
    case BS = 'BS';
    case EAW = 'EAW';
    case EBE = 'EBE';
    case EZ = 'EZ';
    case HO = 'HO';
    case NZ = 'NZ';
    case RS = 'RS';
    case SE = 'SE';
    case SF = 'SF';
    case TV = 'TV';
    case UPB = 'UPB';
    case XX = 'XX';
    case ZA = 'ZA';
    case ZAW = 'ZAW';
    case ZB = 'ZB';
    case ZE = 'ZE';
    case ZK = 'ZK';
    case ZM = 'ZM';
    case ZP = 'ZP';

    public function description(): string
    {
        // @todo: make translatable
        return match($this) {
            self::AR => 'Retour - Annahme verweigert', // Item refused by consignee - return
            self::AT => 'Sendung in Zustellung', // Item is out for delivery
            self::BC => 'Anschriftsproblem', // Address incorrect / incomplete
            self::BF => 'Verzögerung - Schadensprotokoll erstellt', // Delay - damage report compiled
            self::BN => 'Empfänger nicht angetroffen - benachrichtigt', // Consignee not available at time of delivery - carded
            self::BS => 'Verzögerung wegen Beschädigung - Inhaltsprüfung', // Delay due to damage - content checked
            self::EAW => 'Sendung in Abholstation eingelangt', // Item arrived at Pick-Up Station
            self::EBE => 'e-Benachrichtigung versendet', // e-Notification sent
            self::EZ, self::XX => 'Sendung in Verteilung', // Item distributed
            self::HO => 'Sendung in Post-Geschäftsstelle abholbereit', // Item ready for pick up at postal service point
            self::NZ => 'Sendung wird nochmals zugestellt', // Item will be delivered again
            self::RS => 'Retour - Sendung konnte nicht zugestellt werden', // Item could not be delivered - return
            self::SE => 'Elektronische Auftragsdaten wurden vom Versender übermittelt', // The sender has provided electronic shipment information
            self::SF => 'Zustellhindernis – nochmaliger Zustellversuch', // Item could not be delivered – further delivery attempt
            self::TV => 'Zustellung nach Terminvereinbarung', // Item will be delivered on appointment
            self::UPB => 'Sendung in Post-Empfangsbox eingelangt', // Item arrived at Post Pick-Up Box
            self::ZA => 'Sendung zugestellt', // Item delivered
            self::ZAW => 'Sendung von Abholstation abgeholt', // Item picked up at Pick-Up Station
            self::ZB => 'Sendung an Übernahmsberechtigten übergeben', // Item delivered to authorized representative
            self::ZE => 'Sendung an Ersatzabgabestelle zugestellt', // Item delivered to alternative address
            self::ZK => 'Sendung an Angestellten/Kollegen übergeben', // Item delivered to employee/colleague
            self::ZM => 'Sendung an Mitbewohner/in zugestellt', // Item delivered to flat mate
            self::ZP => 'Sendung an Empfänger übergeben', // Item delivered to consignee
        };
    }

    public function delivered(): bool
    {
        return (str_starts_with($this->value, 'Z'));
    }

    public function failed(): bool
    {
        return ($this === self::AR || $this === self::RS);
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
