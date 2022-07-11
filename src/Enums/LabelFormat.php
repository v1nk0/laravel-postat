<?php

namespace V1nk0\PostatPlc\Enums;

enum LabelFormat
{
    case FORMAT_100x150;
    case FORMAT_100x200;

    public function id(): string
    {
        return match($this) {
            LabelFormat::FORMAT_100x150 => '100x150',
            LabelFormat::FORMAT_100x200 => '100x200',
        };
    }

    public function description(): string
    {
        return match($this) {
            LabelFormat::FORMAT_100x150 => '100x150mm (short labels)',
            LabelFormat::FORMAT_100x200 => '100x200mm (long labels)  -> Default value',
        };
    }
}
