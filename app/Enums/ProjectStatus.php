<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Live = 'live';
    case InProgress = 'in_progress';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Live => 'Live',
            self::InProgress => 'In progress',
            self::Archived => 'Archived',
        };
    }
}
