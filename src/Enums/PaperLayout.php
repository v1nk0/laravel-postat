<?php

namespace V1nk0\PostatPlc\Enums;

enum PaperLayout: string
{
    case A5inA4 = 'A5inA4';
    case A5 = 'A5';
    case A4 = 'A4';

    public function id(): string
    {
        return match($this) {
            PaperLayout::A5inA4 => '2xA5inA4',
            PaperLayout::A5 => 'A5',
            PaperLayout::A4 => 'A4',
        };
    }

    public function description(): string
    {
        return match($this) {
            PaperLayout::A5inA4 => '2 x A5 in A4  -> Default value',
            PaperLayout::A5 => 'A5',
            PaperLayout::A4 => 'A4',
        };
    }
}
