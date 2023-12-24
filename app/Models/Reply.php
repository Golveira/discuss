<?php

namespace App\Models;

use App\Concerns\HasAuthor;
use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory, HasAuthor;

    protected $fillable = [
        'user_id',
        'thread_id',
        'body',
    ];

    protected $with = ['author', 'likes'];

    protected $withCount = ['likes'];

    protected $touches = ['thread',];

    protected $perPage = 5;

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function dateForHumans(): Attribute
    {
        return Attribute::make(function ($value) {
            return $this->created_at->diffForHumans();
        });
    }
}
