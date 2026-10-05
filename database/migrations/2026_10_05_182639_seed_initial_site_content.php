<?php

use Database\Seeders\ProjectSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Seed the site settings and projects on first migrate so a fresh
     * environment has content right away. The admin user is created
     * separately with `php artisan app:create-admin`.
     *
     * Skipped while running tests so each test starts from empty tables.
     */
    public function up(): void
    {
        if (app()->runningUnitTests()) {
            return;
        }

        foreach ([SettingSeeder::class, ProjectSeeder::class] as $seeder) {
            Artisan::call('db:seed', ['--class' => $seeder, '--force' => true]);
        }
    }

    /**
     * Seeded content is left in place; the table migrations own removal.
     */
    public function down(): void
    {
        //
    }
};
