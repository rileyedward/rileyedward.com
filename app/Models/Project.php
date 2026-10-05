<?php

namespace App\Models;

use App\Enums\ProjectKind;
use App\Enums\ProjectStatus;
use App\Support\Markdown;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property ProjectKind $kind
 * @property string $summary
 * @property string|null $body
 * @property string|null $role
 * @property list<string> $stack
 * @property ProjectStatus $status
 * @property string|null $live_url
 * @property string|null $repo_url
 * @property string|null $cover_image_path
 * @property bool $is_visible
 * @property bool $is_featured
 * @property int $sort_order
 * @property-read string|null $cover_image_url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable([
    'title', 'slug', 'kind', 'summary', 'body', 'role', 'stack', 'status',
    'live_url', 'repo_url', 'cover_image_path', 'is_visible', 'is_featured', 'sort_order',
])]
class Project extends Model
{
    /** @use HasFactory<ProjectFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'kind' => ProjectKind::class,
            'status' => ProjectStatus::class,
            'stack' => 'array',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Only projects switched on for the public site.
     *
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function visible(Builder $query): void
    {
        $query->where('is_visible', true);
    }

    /**
     * Public ordering: client work first, then the manual admin order.
     *
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderByRaw('case when kind = ? then 0 else 1 end', [ProjectKind::Client->value])
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /**
     * The URL of the uploaded cover screenshot, if any.
     *
     * @return Attribute<string|null, never>
     */
    protected function coverImageUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->cover_image_path
            ? Storage::disk(config('site.media_disk'))->url($this->cover_image_path)
            : null);
    }

    /**
     * The markdown body rendered to sanitized HTML.
     */
    public function bodyHtml(): string
    {
        return Markdown::render($this->body ?? '');
    }
}
