<?php

namespace App\Models;

use App\Concerns\HasBody;
use App\Concerns\HasLikes;
use App\Concerns\HasAuthor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory, HasAuthor, HasLikes, HasBody;

    protected $fillable = [
        'user_id',
        'thread_id',
        'parent_id',
        'body',
    ];

    protected $withCount = ['likes'];

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Reply::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Reply::class, 'parent_id');
    }

    public function dateForHumans(): Attribute
    {
        return Attribute::make(function ($value) {
            return $this->created_at->diffForHumans();
        });
    }

    public function isParent(): bool
    {
        return is_null($this->parent_id);
    }

    public function hasChildren(): bool
    {
        return $this->isParent() && $this->children->isNotEmpty();
    }

    public function isFromSameAuthor(int $author_id): bool
    {
        return $this->user_id === $author_id;
    }

    public function scopeParentReply(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    public function scopeChildReply(Builder $query): Builder
    {
        return $query->whereNotNull('parent_id');
    }
}
