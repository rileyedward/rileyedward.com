<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_and_password_reset_are_disabled()
    {
        $this->get('/register')->assertNotFound();
        $this->post('/register', [
            'name' => 'Intruder',
            'email' => 'intruder@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertNotFound();
        $this->get('/forgot-password')->assertNotFound();

        $this->assertDatabaseCount('users', 0);
    }

    public function test_create_admin_command_creates_a_user_who_can_log_in()
    {
        $this->artisan('app:create-admin', [
            '--name' => 'Riley Edward',
            '--email' => 'riley@example.com',
            '--password' => 'secret-password',
        ])->assertSuccessful();

        $this->post(route('login.store'), [
            'email' => 'riley@example.com',
            'password' => 'secret-password',
        ])->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticatedAs(User::query()->where('email', 'riley@example.com')->sole());
    }

    public function test_create_admin_command_rejects_invalid_input()
    {
        User::factory()->create(['email' => 'taken@example.com']);

        $this->artisan('app:create-admin', [
            '--name' => 'Riley Edward',
            '--email' => 'taken@example.com',
            '--password' => 'secret-password',
        ])->assertFailed();

        $this->artisan('app:create-admin', [
            '--name' => 'Riley Edward',
            '--email' => 'not-an-email',
            '--password' => 'secret-password',
        ])->assertFailed();

        $this->assertDatabaseCount('users', 1);
    }
}
