<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;

/**
 * Site-wide values Riley edits in the admin without a deploy.
 */
class SiteSettings
{
    private const CACHE_KEY = 'site-settings';

    /**
     * Every editable key with its default value.
     *
     * @var array<string, string|null>
     */
    public const DEFAULTS = [
        'availability' => null,
        'contact_email' => null,
        'github_url' => null,
        'linkedin_url' => null,
        'career_start_year' => null,
    ];

    /**
     * @var array<string, string|null>|null
     */
    private ?array $resolved = null;

    /**
     * All settings, defaults filled in.
     *
     * @return array<string, string|null>
     */
    public function all(): array
    {
        if ($this->resolved !== null) {
            return $this->resolved;
        }

        /** @var array<string, string|null> $stored */
        $stored = Cache::rememberForever(
            self::CACHE_KEY,
            fn (): array => Setting::query()->pluck('value', 'key')->all(),
        );

        return $this->resolved = array_intersect_key([...self::DEFAULTS, ...$stored], self::DEFAULTS);
    }

    public function get(string $key): ?string
    {
        return $this->all()[$key] ?? null;
    }

    /**
     * Persist the given values and refresh the cache.
     *
     * @param  array<string, string|null>  $values
     */
    public function update(array $values): void
    {
        foreach (array_intersect_key($values, self::DEFAULTS) as $key => $value) {
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::forget(self::CACHE_KEY);
        $this->resolved = null;
    }

    /**
     * Whole years since the career start year, or null when unset.
     */
    public function yearsOfExperience(): ?int
    {
        $startYear = (int) $this->get('career_start_year');

        return $startYear > 0 ? max(Date::now()->year - $startYear, 0) : null;
    }

    /**
     * The subset of settings the public pages render.
     *
     * @return array{availability: string|null, contactEmail: string|null, githubUrl: string|null, linkedinUrl: string|null, yearsOfExperience: int|null}
     */
    public function toPublicArray(): array
    {
        return [
            'availability' => $this->get('availability'),
            'contactEmail' => $this->get('contact_email'),
            'githubUrl' => $this->get('github_url'),
            'linkedinUrl' => $this->get('linkedin_url'),
            'yearsOfExperience' => $this->yearsOfExperience(),
        ];
    }
}
