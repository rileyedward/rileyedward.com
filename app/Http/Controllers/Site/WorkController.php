<?php

namespace App\Http\Controllers\Site;

use App\Enums\ProjectKind;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WorkController extends Controller
{
    /**
     * List visible projects, optionally filtered by kind.
     */
    public function index(Request $request): Response
    {
        $kind = ProjectKind::tryFrom($request->string('kind')->toString());

        return Inertia::render('public/Work', [
            'projects' => ProjectResource::collection(
                Project::query()
                    ->visible()
                    ->when($kind, fn ($query) => $query->where('kind', $kind))
                    ->ordered()
                    ->get(),
            ),
            'kind' => $kind?->value,
        ]);
    }

    /**
     * Show a single visible project.
     */
    public function show(Project $project): Response
    {
        abort_unless($project->is_visible, 404);

        return $this->renderProject($project);
    }

    /**
     * Render the project page with links to its neighbours in public order.
     */
    public static function renderProject(Project $project): Response
    {
        $siblings = Project::query()->visible()->ordered()->get(['id', 'title', 'slug', 'kind']);
        $position = $siblings->search(fn (Project $sibling): bool => $sibling->is($project));

        $neighbour = fn (?Project $sibling): ?array => $sibling
            ? ['title' => $sibling->title, 'slug' => $sibling->slug]
            : null;

        return Inertia::render('public/Project', [
            'project' => (new ProjectResource($project))->withBody(),
            'previous' => $position === false ? null : $neighbour($siblings->get($position - 1)),
            'next' => $position === false ? null : $neighbour($siblings->get($position + 1)),
        ]);
    }
}
