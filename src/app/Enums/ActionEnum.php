<?php

namespace App\Enums;

enum ActionEnum: string
{
    case CREATE = 'create';
    case UPDATE = 'update';
    case RESTORE = 'restore';
    case SOFT_DELETE = 'soft_delete';
    case FORCE_DELETE = 'force_delete';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function map(string $value): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        return null;
    }
}
