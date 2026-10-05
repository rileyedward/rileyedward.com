<?php

namespace App\Enums;

/**
 * Accent presets a visitor can pick. Each maps to a [data-accent] block in
 * resources/css/app.css that sets the hue of the shared OKLCH ladder.
 */
enum Accent: string
{
    case Sky = 'sky';
    case Blue = 'blue';
    case Indigo = 'indigo';
    case Violet = 'violet';
    case Pink = 'pink';
    case Rose = 'rose';
    case Amber = 'amber';
    case Emerald = 'emerald';

    /**
     * The accent shown to first-time visitors.
     */
    public static function default(): self
    {
        return self::Sky;
    }

    /**
     * Resolve a stored cookie value, falling back to the default for anything unknown.
     */
    public static function fromCookie(mixed $value): self
    {
        return is_string($value) ? (self::tryFrom($value) ?? self::default()) : self::default();
    }
}
