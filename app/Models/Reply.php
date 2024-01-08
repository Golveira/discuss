<?php

namespace App\Models;

use App\Concerns\HasLikes;
use App\Concerns\HasAuthor;
use App\Concerns\HasBody;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory, HasAuthor, HasLikes, HasBody;

    protected $fillable = [
        'user_id',
        'thread_id',
        'body',
    ];

    protected $with = ['author', 'likes'];

    protected $withCount = ['likes'];

    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class);
    }

    public function dateForHumans(): Attribute
    {
        return Attribute::make(function ($value) {
            return $this->created_at->diffForHumans();
        });
    }
}
