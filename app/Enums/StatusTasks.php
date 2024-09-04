<?php

namespace App\Enums;

enum StatusTasks: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Inactive = 'inactive';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
