<?php

namespace App\Enum;

enum Secteur: string
{
    case PUBLIC = 'Public';
    case PRIVE = 'Privé';

    public static function fromString(string $value): ?self
    {
        return match ($value) {
            'Public' => self::PUBLIC,
            'Privé' => self::PRIVE,
            default => null,
        };
    }

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}