<?php

namespace App\Models;

use App\Concerns\HasSlug;
use App\Concerns\HasLikes;
use App\Concerns\HasAuthor;
use Illuminate\Support\Str;
use App\Concerns\HasReplies;
use App\Concerns\HasSubscriptions;
use App\Concerns\SortsByPopularity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    use HasFactory;
    use HasAuthor;
    use HasReplies;
    use HasLikes;
    use HasSubscriptions;
    use HasSlug;
    use SortsByPopularity;

    protected $fillable = [
        'user_id',
        'channel_id',
        'best_reply_id',
        'title',
        'body',
        'slug',
    ];

    protected $with = ['author', 'channel'];

    protected $withCount = ['replies', 'likes'];

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function bestReply(): BelongsTo
    {
        return $this->belongsTo(Reply::class, 'best_reply_id');
    }

    public function dateForHumans(): Attribute
    {
        return Attribute::make(function ($value) {
            return $this->created_at->diffForHumans();
        });
    }

    public function bodyExcerpt(): Attribute
    {
        return Attribute::make(function ($value) {
            return Str::limit($this->body, 400);
        });
    }

    public function path(): Attribute
    {
        return Attribute::make(function ($value) {
            return route('threads.show', $this->slug);
        });
    }

    public function scopeRecent($query)
    {
        $query->orderBy('updated_at', 'desc');
    }

    public function scopeSearch(Builder $query, string $search): void
    {
        $query->when($search, function ($query, $search) {
            $query->where('title', 'LIKE', "%{$search}%")->orWhere('body', 'LIKE', "%{$search}%");
        });
    }

    public function scopeFilter(Builder $query, string $filter): void
    {
        $query->when($filter === 'all', fn ($query) => $query);
        $query->when($filter === 'resolved', fn ($query) => $query->has('bestReply'));
        $query->when($filter === 'unresolved', fn ($query) => $query->doesntHave('bestReply'));
    }

    public function scopeSort(Builder $query, string $filter): void
    {
        $query->when($filter === 'recent', fn ($query) => $query->recent());
        $query->when($filter === 'popular_all', fn ($query) => $query->popular());
        $query->when($filter === 'popular_week', fn ($query) => $query->popularThisWeek());
    }

    public function markAsBestReply(Reply $reply): void
    {
        $this->update(['best_reply_id' => $reply->id]);
    }
}
