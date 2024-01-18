<?php

namespace App\Models;

use App\Concerns\HasLikes;
use App\Concerns\HasAuthor;
use App\Concerns\HasBody;
use App\Concerns\HasReplies;
use App\Concerns\HasSubscriptions;
use App\Concerns\SortsByPopularity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Thread extends Model
{
    use HasFactory;
    use HasAuthor;
    use HasReplies;
    use HasLikes;
    use HasSubscriptions;
    use HasBody;
    use SortsByPopularity;

    protected $fillable = [
        'user_id',
        'channel_id',
        'best_reply_id',
        'title',
        'body',
        'is_closed',
        'is_pinned',
    ];

    protected $withCount = ['likes', 'replies'];

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

    public function hasBestReply(): bool
    {
        return !is_null($this->best_reply_id);
    }

    public function hasAsBestReply(Reply $reply): bool
    {
        return $this->bestReply()->is($reply);
    }

    public function markAsBestReply(Reply $reply): void
    {
        $this->update(['best_reply_id' => $reply->id]);
    }

    public function removeBestReply(): void
    {
        $this->update(['best_reply_id' => null]);
    }

    public function isPinned(): bool
    {
        return $this->is_pinned;
    }

    public function pin(): void
    {
        $this->update(['is_pinned' => true]);
    }

    public function unpin(): void
    {
        $this->update(['is_pinned' => false]);
    }

    public function isClosed(): bool
    {
        return $this->is_closed;
    }

    public function open(): void
    {
        $this->update(['is_closed' => false]);
    }

    public function close(): void
    {
        $this->update(['is_closed' => true]);
    }

    public function participants(): Collection
    {
        return $this->replyAuthors()
            ->get()
            ->prepend($this->author)
            ->unique();
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
        $query->when($filter === 'open', fn ($query) => $query);
        $query->when($filter === 'closed', fn ($query) => $query);
        $query->when($filter === 'answered', fn ($query) => $query->has('bestReply'));
        $query->when($filter === 'unanswered', fn ($query) => $query->doesntHave('bestReply'));
    }

    public function scopeSort(Builder $query, string $sort): void
    {
        $query->when($sort === 'latest_activity', fn ($query) => $query->recent());
        $query->when($sort === 'date_created', fn ($query) => $query->latest());
        $query->when($sort === 'top_day', fn ($query) => $query->popularToday());
        $query->when($sort === 'top_week', fn ($query) => $query->popularThisWeek());
        $query->when($sort === 'top_month', fn ($query) => $query->popularThisMonth());
        $query->when($sort === 'top_year', fn ($query) => $query->popularThisYear());
        $query->when($sort === 'top_all', fn ($query) => $query->popularAllTime());
    }
}
