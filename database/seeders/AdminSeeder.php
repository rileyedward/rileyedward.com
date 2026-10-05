<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed a local admin login (admin@test.com / password).
     * Skipped in production; use `php artisan app:create-admin` there.
     */
    public function run(): void
    {
        if (app()->isProduction()) {
            return;
        }

        User::query()->updateOrCreate(['email' => 'admin@test.com'], [
            'name' => 'Admin',
            'password' => 'password',
        ]);
    }
}
