<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class SiteSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_saved_settings_are_live_on_the_public_site()
    {
        $this->actingAs(User::factory()->create());

        $this->put(route('site-settings.update'), [
            'availability' => 'Taking new projects for November',
            'contact_email' => 'hello@rileyedward.com',
            'github_url' => 'https://github.com/rileyedward',
            'linkedin_url' => '',
            'career_start_year' => '2021',
        ])->assertRedirect(route('site-settings.edit'));

        $this->get(route('site-settings.edit'))->assertInertia(fn (Assert $page) => $page
            ->where('settings.availability', 'Taking new projects for November')
            ->where('settings.linkedin_url', null)
        );

        auth()->logout();

        $this->get(route('home'))->assertInertia(fn (Assert $page) => $page
            ->where('site.availability', 'Taking new projects for November')
            ->where('site.contactEmail', 'hello@rileyedward.com')
            ->where('site.linkedinUrl', null)
        );
    }

    public function test_settings_are_validated()
    {
        $this->actingAs(User::factory()->create());

        $this->put(route('site-settings.update'), [
            'contact_email' => 'nope',
            'github_url' => 'not a url',
            'career_start_year' => '3000',
        ])->assertSessionHasErrors(['contact_email', 'github_url', 'career_start_year']);
    }
}
