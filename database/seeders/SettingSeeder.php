<?php

namespace Database\Seeders;

use App\Support\SiteSettings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Seed starting values for the editable site settings.
     */
    public function run(SiteSettings $settings): void
    {
        $settings->update([
            'availability' => 'Taking on new projects',
            'contact_email' => null,
            'github_url' => 'https://github.com/rileyedward',
            'linkedin_url' => null,
            'career_start_year' => '2021',
        ]);
    }
}
