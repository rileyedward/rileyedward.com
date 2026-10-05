<?php

namespace Tests\Feature\Site;

use App\Models\Project;
use App\Support\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Date;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_public_page_renders()
    {
        $project = Project::factory()->create();

        $this->get(route('home'))->assertOk()->assertInertia(fn (Assert $page) => $page->component('public/Home'));
        $this->get(route('work.index'))->assertOk()->assertInertia(fn (Assert $page) => $page->component('public/Work'));
        $this->get(route('work.show', $project))->assertOk()->assertInertia(fn (Assert $page) => $page->component('public/Project'));
        $this->get(route('about'))->assertOk()->assertInertia(fn (Assert $page) => $page->component('public/About'));
        $this->get(route('contact.create'))->assertOk()->assertInertia(fn (Assert $page) => $page->component('public/Contact'));
    }

    public function test_home_shows_only_visible_featured_projects_with_client_work_first_then_sort_order()
    {
        $personalFirst = Project::factory()->featured()->create(['sort_order' => 0]);
        $client = Project::factory()->client()->featured()->create(['sort_order' => 5]);
        $personalSecond = Project::factory()->featured()->create(['sort_order' => 1]);
        Project::factory()->create(['sort_order' => 2]);
        Project::factory()->featured()->hidden()->create();

        $this->get(route('home'))->assertInertia(fn (Assert $page) => $page
            ->has('featuredProjects', 3)
            ->where('featuredProjects.0.id', $client->id)
            ->where('featuredProjects.1.id', $personalFirst->id)
            ->where('featuredProjects.2.id', $personalSecond->id)
        );
    }

    public function test_work_lists_visible_projects_and_filters_by_kind()
    {
        $client = Project::factory()->client()->create();
        $personal = Project::factory()->create();
        Project::factory()->hidden()->create();

        $this->get(route('work.index'))->assertInertia(fn (Assert $page) => $page
            ->has('projects', 2)
            ->where('kind', null)
        );

        $this->get(route('work.index', ['kind' => 'client']))->assertInertia(fn (Assert $page) => $page
            ->has('projects', 1)
            ->where('projects.0.id', $client->id)
            ->where('kind', 'client')
        );

        $this->get(route('work.index', ['kind' => 'personal']))->assertInertia(fn (Assert $page) => $page
            ->has('projects', 1)
            ->where('projects.0.id', $personal->id)
        );

        $this->get(route('work.index', ['kind' => 'bogus']))->assertInertia(fn (Assert $page) => $page
            ->has('projects', 2)
            ->where('kind', null)
        );
    }

    public function test_hidden_projects_return_404_even_by_slug()
    {
        $hidden = Project::factory()->hidden()->create();

        $this->get(route('work.show', $hidden))->assertNotFound();
        $this->get('/work/does-not-exist')->assertNotFound();
    }

    public function test_project_page_links_to_visible_neighbours_and_renders_markdown()
    {
        $first = Project::factory()->create(['sort_order' => 0]);
        $middle = Project::factory()->create([
            'sort_order' => 1,
            'body' => "## What I built\n\nA thing.\n\n<script>alert('x')</script>\n\n[bad](javascript:alert(1))",
        ]);
        Project::factory()->hidden()->create(['sort_order' => 2]);
        $last = Project::factory()->create(['sort_order' => 3]);

        $this->get(route('work.show', $middle))->assertInertia(fn (Assert $page) => $page
            ->where('previous.slug', $first->slug)
            ->where('next.slug', $last->slug)
            ->where('project.bodyHtml', fn (string $html) => str_contains($html, '<h2>What I built</h2>')
                && ! str_contains($html, '<script>')
                && ! str_contains($html, 'javascript:'))
        );

        $this->get(route('work.show', $first))->assertInertia(fn (Assert $page) => $page
            ->where('previous', null)
            ->where('next.slug', $middle->slug)
        );
    }

    public function test_site_settings_are_shared_with_years_of_experience()
    {
        Date::setTestNow('2026-10-05');
        app(SiteSettings::class)->update([
            'availability' => 'Taking new projects for November',
            'github_url' => 'https://github.com/rileyedward',
            'career_start_year' => '2021',
        ]);

        $this->get(route('about'))->assertInertia(fn (Assert $page) => $page
            ->where('site.availability', 'Taking new projects for November')
            ->where('site.githubUrl', 'https://github.com/rileyedward')
            ->where('site.yearsOfExperience', 5)
        );
    }
}
