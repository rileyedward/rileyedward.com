<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
{
    /**
     * Include the rendered markdown body (detail pages only).
     */
    private bool $withBody = false;

    public function withBody(): static
    {
        $this->withBody = true;

        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'kind' => $this->kind->value,
            'kindLabel' => $this->kind->label(),
            'summary' => $this->summary,
            'role' => $this->role,
            'stack' => $this->stack,
            'status' => $this->status->value,
            'statusLabel' => $this->status->label(),
            'liveUrl' => $this->live_url,
            'repoUrl' => $this->repo_url,
            'coverImageUrl' => $this->cover_image_url,
            'isVisible' => $this->is_visible,
            'isFeatured' => $this->is_featured,
            'bodyHtml' => $this->when($this->withBody, fn (): string => $this->bodyHtml()),
        ];
    }
}
