<?php

namespace Database\Factories;

use App\Enums\ProjectKind;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->company();

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'kind' => ProjectKind::Personal,
            'summary' => fake()->sentence(),
            'body' => fake()->paragraphs(2, true),
            'role' => 'Design and full-stack build',
            'stack' => ['Laravel', 'Vue'],
            'status' => ProjectStatus::Live,
            'live_url' => null,
            'repo_url' => null,
            'cover_image_path' => null,
            'is_visible' => true,
            'is_featured' => false,
            'sort_order' => 0,
        ];
    }

    /**
     * A client project.
     */
    public function client(): static
    {
        return $this->state(fn (): array => ['kind' => ProjectKind::Client]);
    }

    /**
     * A project hidden from the public site.
     */
    public function hidden(): static
    {
        return $this->state(fn (): array => ['is_visible' => false]);
    }

    /**
     * A project shown on the home page.
     */
    public function featured(): static
    {
        return $this->state(fn (): array => ['is_featured' => true]);
    }
}
