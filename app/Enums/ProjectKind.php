<?php

namespace App\Enums;

enum ProjectKind: string
{
    case Client = 'client';
    case Personal = 'personal';

    public function label(): string
    {
        return match ($this) {
            self::Client => 'Client',
            self::Personal => 'Personal',
        };
    }
}
