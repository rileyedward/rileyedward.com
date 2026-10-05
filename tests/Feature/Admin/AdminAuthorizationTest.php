<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as RouteFacade;
use Tests\TestCase;

class AdminAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_admin_route_redirects_guests_to_login()
    {
        $adminRoutes = collect(RouteFacade::getRoutes()->getRoutes())
            ->filter(fn (Route $route): bool => str_starts_with($route->uri(), 'admin'));

        $this->assertGreaterThan(15, $adminRoutes->count());

        foreach ($adminRoutes as $route) {
            $uri = preg_replace('/\{[^}]+\}/', '1', $route->uri());
            $method = collect($route->methods())->reject(fn (string $method): bool => $method === 'HEAD')->first();

            $this->call($method, '/'.$uri)
                ->assertRedirect(route('login'));
        }
    }

    public function test_login_page_is_not_linked_from_public_pages()
    {
        $this->get(route('home'))->assertDontSee('/login', false);
    }
}
