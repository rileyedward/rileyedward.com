<?php

namespace App\Http\Requests\Admin;

use App\Enums\ProjectKind;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    /**
     * Fill in the slug from the title and normalise checkbox values.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->string('slug')->trim()->toString() ?: $this->string('title')->toString()),
            'stack' => array_values(array_filter(array_map(
                fn (mixed $item): string => trim((string) $item),
                (array) $this->input('stack', []),
            ))),
            'is_visible' => $this->boolean('is_visible'),
            'is_featured' => $this->boolean('is_featured'),
            'remove_cover' => $this->boolean('remove_cover'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var Project|null $project */
        $project = $this->route('project');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique(Project::class)->ignore($project)],
            'kind' => ['required', Rule::enum(ProjectKind::class)],
            'summary' => ['required', 'string', 'max:160'],
            'body' => ['nullable', 'string', 'max:50000'],
            'role' => ['nullable', 'string', 'max:255'],
            'stack' => ['array', 'max:20'],
            'stack.*' => ['string', 'max:40', 'distinct:ignore_case'],
            'status' => ['required', Rule::enum(ProjectStatus::class)],
            'live_url' => ['nullable', 'url:http,https', 'max:255'],
            'repo_url' => ['nullable', 'url:http,https', 'max:255'],
            'is_visible' => ['boolean'],
            'is_featured' => ['boolean'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'remove_cover' => ['boolean'],
        ];
    }

    /**
     * The validated column values (upload fields excluded).
     *
     * @return array<string, mixed>
     */
    public function projectAttributes(): array
    {
        return $this->safe()->except(['cover', 'remove_cover']);
    }
}
