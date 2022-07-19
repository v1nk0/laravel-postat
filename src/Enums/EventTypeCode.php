<?php

namespace V1nk0\LaravelPostat\Enums;

enum EventTypeCode: string
{
    case ANA = 'ANA';
    case ANI = 'ANI';
    case AVI = 'AVI';
    case AZT = 'AZT';
    case BAU = 'BAU';
    case BEI = 'BEI';
    case CLA = 'CLA';
    case CUD = 'CUD';
    case CUS = 'CUS';
    case DAM = 'DAM';
    case DIC = 'DIC';
    case DKT = 'DKT';
    case EXP = 'EXP';
    case HIA = 'HIA';
    case IMP = 'IMP';
    case KAM = 'KAM';
    case LAA = 'LAA';
    case LAG = 'LAG';
    case NNI = 'NNI';
    case ONT = 'ONT';
    case PKI = 'PKI';
    case PUG = 'PUG';
    case PUH = 'PUH';
    case PUP = 'PUP';
    case RTS = 'RTS';
    case SIN = 'SIN';
    case TRA = 'TRA';
    case VEH = 'VEH';
    case VER = 'VER';
    case WLT = 'WLT';
    case ZSS = 'ZSS';
    case ZUH = 'ZUH';
    case ZUS = 'ZUS';

    public function description(): string
    {
        // @todo: make translatable
        return match($this) {
            self::ANA => 'Annahme',
            self::ANI => 'Annahme im Ausland',
            self::AVI => 'Aviso',
            self::AZT => 'Auf Zustelltour',
            self::BAU => 'Ausgang',
            self::BEI => 'Eingang',
            self::CLA => 'Klärung',
            self::CUD => 'Verzögerung Zollabfertigung',
            self::CUS => 'Zollabfertigung',
            self::DAM => 'Schadensbearbeitung',
            self::DIC => 'Dachidentcode',
            self::DKT => 'Datenkorrektur',
            self::EXP => 'Export',
            self::HIA => 'Hinterlegung',
            self::IMP => 'Import',
            self::KAM => 'Kein Abschluß möglich',
            self::LAA, => 'Lagerausgang',
            self::LAG => 'Lager',
            self::NNI => 'Nachnahme Info',
            self::ONT => 'Direktauftrag on Tour',
            self::PKI => 'Proaktive Kundeninfo',
            self::PUG => 'Übergabe an Partner',
            self::PUH => 'Abholhindernis',
            self::PUP => 'Abholung',
            self::RTS => 'Rücksendung',
            self::SIN => 'Sendungsinformation',
            self::TRA => 'Transport',
            self::VEH => 'Verteilhindernis',
            self::VER => 'Verteilung',
            self::WLT => 'Weiterleitung',
            self::ZSS => 'Zustellstorno',
            self::ZUH => 'Zustellhindernis',
            self::ZUS => 'Zustellung',
        };
    }

    public function delivered(): bool
    {
        return ($this === self::ZUS);
    }

    public function failed(): bool
    {
        return ($this === self::RTS || $this === self::KAM || self::ZSS);
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
