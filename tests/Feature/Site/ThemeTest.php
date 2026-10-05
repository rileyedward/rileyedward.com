<?php

namespace Tests\Feature\Site;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThemeTest extends TestCase
{
    use RefreshDatabase;

    public function test_first_visit_renders_the_default_accent_and_system_mode()
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('data-accent="sky"', false)
            ->assertDontSee('class="dark"', false);
    }

    public function test_saved_accent_and_mode_cookies_are_rendered_server_side()
    {
        $this->withUnencryptedCookies(['accent' => 'emerald', 'appearance' => 'dark'])
            ->get(route('home'))
            ->assertOk()
            ->assertSee('data-accent="emerald"', false)
            ->assertSee('class="dark"', false);
    }

    public function test_unknown_cookie_values_fall_back_to_defaults()
    {
        $this->withUnencryptedCookies(['accent' => '"><script>', 'appearance' => "'};alert(1);//"])
            ->get(route('home'))
            ->assertOk()
            ->assertSee('data-accent="sky"', false)
            ->assertDontSee('"><script>', false)
            ->assertDontSee('alert(1)', false);
    }
}
