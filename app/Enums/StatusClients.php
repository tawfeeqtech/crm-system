<?php

namespace App\Enums;

enum StatusClients: string
{
    case Active = 'active';
    case Inactive = 'inactive';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return [
            // self::Active->value => 'Active',
            // self::Inactive->value => 'Inactive',
            ['label' => 'Active', 'value' => self::Active->value],
            ['label' => 'Inactive', 'value' => self::Inactive->value],
        ];
    }
}
