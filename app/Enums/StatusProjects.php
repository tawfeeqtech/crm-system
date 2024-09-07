<?php

namespace App\Enums;

enum StatusProjects: string
{
    case Open = 'Open';
    case Close = 'Close';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return [
            ['label' => 'Open', 'value' => self::Open->value],
            ['label' => 'Close', 'value' => self::Close->value],
        ];
    }
}
