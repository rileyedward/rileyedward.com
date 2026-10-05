<?php

namespace Tests\Feature\Admin;

use App\Enums\ProjectKind;
use App\Enums\ProjectStatus;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProjectAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        $this->actingAs(User::factory()->create());
    }

    /**
     * @return array<string, mixed>
     */
    private function validProject(array $overrides = []): array
    {
        return [
            'title' => 'Brookside Bakery',
            'slug' => '',
            'kind' => ProjectKind::Client->value,
            'summary' => 'Online ordering for a neighbourhood bakery.',
            'body' => "## What I built\n\nOrdering.",
            'role' => 'Full-stack build',
            'stack' => ['Laravel', 'Vue', ' '],
            'status' => ProjectStatus::Live->value,
            'live_url' => 'https://example.com',
            'repo_url' => '',
            'is_visible' => '1',
            'is_featured' => '0',
            ...$overrides,
        ];
    }

    public function test_dashboard_shows_counts_and_newest_messages()
    {
        ContactMessage::factory()->count(6)->create();
        ContactMessage::factory()->read()->create();
        Project::factory()->count(2)->create();
        Project::factory()->hidden()->create();

        $this->get(route('dashboard'))->assertInertia(fn (Assert $page) => $page
            ->component('admin/Dashboard')
            ->where('unreadCount', 6)
            ->has('latestMessages', 5)
            ->where('visibleProjectCount', 2)
            ->where('hiddenProjectCount', 1)
        );
    }

    public function test_creating_a_project_generates_a_slug_and_appends_to_the_order()
    {
        Project::factory()->create(['sort_order' => 4]);

        $this->post(route('admin.projects.store'), $this->validProject())
            ->assertSessionHasNoErrors();

        $project = Project::query()->where('slug', 'brookside-bakery')->sole();
        $this->assertSame(['Laravel', 'Vue'], $project->stack);
        $this->assertTrue($project->is_visible);
        $this->assertFalse($project->is_featured);
        $this->assertNull($project->repo_url);
        $this->assertSame(5, $project->sort_order);

        $this->get(route('work.show', $project))->assertOk();
    }

    public function test_project_validation()
    {
        Project::factory()->create(['slug' => 'taken']);

        $this->post(route('admin.projects.store'), $this->validProject([
            'title' => '',
            'slug' => 'taken',
            'kind' => 'nope',
            'summary' => str_repeat('a', 161),
            'live_url' => 'javascript:alert(1)',
        ]))->assertSessionHasErrors(['title', 'slug', 'kind', 'summary', 'live_url']);
    }

    public function test_toggling_visible_changes_the_public_site_immediately()
    {
        $project = Project::factory()->create();

        $this->patch(route('admin.projects.toggle', $project), ['field' => 'is_visible', 'value' => false])->assertRedirect();
        $this->get(route('work.show', $project))->assertNotFound();

        $this->patch(route('admin.projects.toggle', $project), ['field' => 'is_visible', 'value' => true])->assertRedirect();
        $this->get(route('work.show', $project))->assertOk();

        $this->patch(route('admin.projects.toggle', $project), ['field' => 'is_featured', 'value' => true]);
        $this->assertTrue($project->fresh()->is_featured);

        $this->patch(route('admin.projects.toggle', $project), ['field' => 'title', 'value' => true])
            ->assertSessionHasErrors('field');
    }

    public function test_reorder_writes_sort_order()
    {
        [$a, $b, $c] = Project::factory()->count(3)->sequence(
            ['sort_order' => 0], ['sort_order' => 1], ['sort_order' => 2],
        )->create();

        $this->post(route('admin.projects.reorder'), ['ids' => [$c->id, $a->id, $b->id]])->assertRedirect();

        $this->assertSame(0, $c->fresh()->sort_order);
        $this->assertSame(1, $a->fresh()->sort_order);
        $this->assertSame(2, $b->fresh()->sort_order);
    }

    public function test_cover_image_upload_replace_and_remove()
    {
        $project = Project::factory()->create();

        $this->put(route('admin.projects.update', $project), $this->validProject([
            'title' => $project->title,
            'slug' => $project->slug,
            'cover' => UploadedFile::fake()->image('shot.png', 2400, 1500),
        ]))->assertSessionHasNoErrors();

        $first = $project->fresh()->cover_image_path;
        $this->assertStringEndsWith('.webp', $first);
        Storage::disk('public')->assertExists($first);
        [$width] = getimagesizefromstring(Storage::disk('public')->get($first));
        $this->assertSame(1600, $width);

        $this->put(route('admin.projects.update', $project), $this->validProject([
            'title' => $project->title,
            'slug' => $project->slug,
            'cover' => UploadedFile::fake()->image('new.jpg', 800, 600),
        ]))->assertSessionHasNoErrors();

        $second = $project->fresh()->cover_image_path;
        $this->assertNotSame($first, $second);
        Storage::disk('public')->assertMissing($first);
        Storage::disk('public')->assertExists($second);

        $this->put(route('admin.projects.update', $project), $this->validProject([
            'title' => $project->title,
            'slug' => $project->slug,
            'remove_cover' => '1',
        ]))->assertSessionHasNoErrors();

        $this->assertNull($project->fresh()->cover_image_path);
        Storage::disk('public')->assertMissing($second);
    }

    public function test_saving_without_a_new_file_keeps_the_existing_cover()
    {
        Storage::disk('public')->put('projects/existing.webp', 'image');
        $project = Project::factory()->create(['cover_image_path' => 'projects/existing.webp']);

        $this->put(route('admin.projects.update', $project), $this->validProject([
            'title' => 'Renamed',
            'slug' => $project->slug,
        ]))->assertSessionHasNoErrors();

        $this->assertSame('projects/existing.webp', $project->fresh()->cover_image_path);
        $this->assertSame('Renamed', $project->fresh()->title);
    }

    public function test_deleting_a_project_removes_its_cover()
    {
        Storage::disk('public')->put('projects/existing.webp', 'image');
        $project = Project::factory()->create(['cover_image_path' => 'projects/existing.webp']);

        $this->delete(route('admin.projects.destroy', $project))->assertRedirect(route('admin.projects.index'));

        $this->assertModelMissing($project);
        Storage::disk('public')->assertMissing('projects/existing.webp');
    }

    public function test_hidden_projects_can_be_previewed_only_while_logged_in()
    {
        $project = Project::factory()->hidden()->create();

        $this->get(route('admin.projects.preview', $project))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('public/Project')->where('project.id', $project->id));

        auth()->logout();

        $this->get(route('admin.projects.preview', $project))->assertRedirect(route('login'));
    }

    public function test_markdown_preview_renders_sanitized_html()
    {
        $this->postJson(route('admin.markdown-preview'), ['markdown' => '**hi** <script>x</script>'])
            ->assertOk()
            ->assertJsonPath('html', "<p><strong>hi</strong> x</p>\n");
    }

    public function test_admin_pages_render()
    {
        $project = Project::factory()->create();

        $this->get(route('admin.projects.index'))->assertInertia(fn (Assert $page) => $page->component('admin/projects/Index')->has('projects', 1));
        $this->get(route('admin.projects.create'))->assertInertia(fn (Assert $page) => $page->component('admin/projects/Form')->where('project', null));
        $this->get(route('admin.projects.edit', $project))->assertInertia(fn (Assert $page) => $page
            ->component('admin/projects/Form')
            ->where('project.id', $project->id)
            ->where('project.body', $project->body)
        );
    }
}
