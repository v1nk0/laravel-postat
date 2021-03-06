<?php

namespace V1nk0\LaravelPostat\Enums;

enum Encoding: string
{
    case UTF8 = 'UTF8';
    case WINDOWS1252 = 'WINDOWS1252';

    public function code(): string
    {
        return match($this) {
            Encoding::UTF8 => 'UTF-8',
            Encoding::WINDOWS1252 => 'WINDOWS-1252',
        };
    }

    public function description(): string
    {
        return match($this) {
            Encoding::UTF8 => 'UTF-8',
            Encoding::WINDOWS1252 => 'WINDOWS-1252',
        };
    }
}
