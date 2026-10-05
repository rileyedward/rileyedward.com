<?php

namespace App\Models;

use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $business_name
 * @property string|null $phone
 * @property string $message
 * @property Carbon|null $read_at
 * @property Carbon|null $archived_at
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['name', 'email', 'business_name', 'phone', 'message', 'read_at', 'archived_at', 'ip_address', 'user_agent'])]
class ContactMessage extends Model
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'archived_at' => 'datetime',
        ];
    }

    /**
     * Messages that have not been opened yet.
     *
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function unread(Builder $query): void
    {
        $query->whereNull('read_at');
    }

    /**
     * Messages still in the inbox (not archived).
     *
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function inInbox(Builder $query): void
    {
        $query->whereNull('archived_at');
    }

    /**
     * Archived messages.
     *
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function archived(Builder $query): void
    {
        $query->whereNotNull('archived_at');
    }

    /**
     * Case-insensitive search over sender details and message text.
     *
     * @param  Builder<self>  $query
     */
    #[Scope]
    protected function search(Builder $query, ?string $term): void
    {
        if (blank($term)) {
            return;
        }

        $like = '%'.mb_strtolower($term).'%';

        $query->where(function (Builder $query) use ($like): void {
            foreach (['name', 'email', 'business_name', 'message'] as $column) {
                $query->orWhereRaw("lower({$column}) like ?", [$like]);
            }
        });
    }
}
