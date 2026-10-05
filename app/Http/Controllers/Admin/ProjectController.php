<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectKind;
use App\Enums\ProjectStatus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\WorkController;
use App\Http\Requests\Admin\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Support\ProjectCoverStore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function __construct(private ProjectCoverStore $covers) {}

    /**
     * List every project in manual order.
     */
    public function index(): Response
    {
        return Inertia::render('admin/projects/Index', [
            'projects' => ProjectResource::collection(
                Project::query()->orderBy('sort_order')->orderBy('id')->get(),
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/projects/Form', [
            'project' => null,
            ...$this->formOptions(),
        ]);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $project = new Project([
            ...$request->projectAttributes(),
            'sort_order' => (int) Project::query()->max('sort_order') + 1,
        ]);

        if ($request->hasFile('cover')) {
            $project->cover_image_path = $this->covers->store($request->file('cover'));
        }

        $project->save();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Project created.']);

        return to_route('admin.projects.edit', $project);
    }

    public function edit(Project $project): Response
    {
        return Inertia::render('admin/projects/Form', [
            'project' => [
                ...(new ProjectResource($project))->resolve(),
                'body' => $project->body,
            ],
            ...$this->formOptions(),
        ]);
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $project->fill($request->projectAttributes());

        if ($request->hasFile('cover') || $request->boolean('remove_cover')) {
            $this->covers->delete($project->cover_image_path);
            $project->cover_image_path = $request->hasFile('cover')
                ? $this->covers->store($request->file('cover'))
                : null;
        }

        $project->save();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Project saved.']);

        return to_route('admin.projects.edit', $project);
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->covers->delete($project->cover_image_path);
        $project->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Project deleted.']);

        return to_route('admin.projects.index');
    }

    /**
     * Flip the Visible or Featured switch from the projects table.
     */
    public function toggle(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'field' => ['required', Rule::in(['is_visible', 'is_featured'])],
            'value' => ['required', 'boolean'],
        ]);

        $project->forceFill([$validated['field'] => (bool) $validated['value']])->save();

        return back();
    }

    /**
     * Persist a new manual order from the drag-and-drop table.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'distinct', Rule::exists(Project::class, 'id')],
        ]);

        DB::transaction(function () use ($validated): void {
            foreach ($validated['ids'] as $position => $id) {
                Project::query()->whereKey($id)->update(['sort_order' => $position]);
            }
        });

        return back();
    }

    /**
     * Render the public project page, even while the project is hidden.
     */
    public function preview(Project $project): Response
    {
        return WorkController::renderProject($project);
    }

    /**
     * @return array{kinds: list<array{value: string, label: string}>, statuses: list<array{value: string, label: string}>}
     */
    private function formOptions(): array
    {
        return [
            'kinds' => array_map(fn (ProjectKind $kind): array => ['value' => $kind->value, 'label' => $kind->label()], ProjectKind::cases()),
            'statuses' => array_map(fn (ProjectStatus $status): array => ['value' => $status->value, 'label' => $status->label()], ProjectStatus::cases()),
        ];
    }
}
