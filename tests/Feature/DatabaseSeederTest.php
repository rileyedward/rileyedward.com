<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Setting;
use Database\Seeders\AdminSeeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeding_creates_the_local_admin_and_valid_projects()
    {
        $this->seed(DatabaseSeeder::class);

        $this->post(route('login.store'), [
            'email' => 'admin@test.com',
            'password' => 'password',
        ])->assertRedirect(route('dashboard', absolute: false));

        $this->assertSame(15, Project::query()->count());
        $this->assertTrue(Project::query()->get()->every(fn (Project $project): bool => mb_strlen($project->summary) <= 160));
        $this->get(route('work.show', 'portal-atlas'))->assertOk();
    }

    public function test_the_admin_seeder_is_skipped_in_production()
    {
        $this->app->detectEnvironment(fn (): string => 'production');

        $this->app->make(AdminSeeder::class)->run();

        $this->assertDatabaseMissing('users', ['email' => 'admin@test.com']);
    }

    public function test_the_content_migration_seeds_settings_and_projects_but_not_an_admin()
    {
        $migration = require database_path('migrations/2026_10_05_182639_seed_initial_site_content.php');

        $this->app['env'] = 'local';
        $migration->up();
        $this->app['env'] = 'testing';

        $this->assertSame(15, Project::query()->count());
        $this->assertSame(5, Setting::query()->count());
        $this->assertDatabaseCount('users', 0);
    }
}
