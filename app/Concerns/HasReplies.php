<?php

namespace App\Concerns;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

trait HasReplies
{
    public static function bootHasReplies(): void
    {
        static::deleting(function ($model) {
            $model->replies->each->delete();
        });
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function replyAuthors(): HasManyThrough
    {
        return $this->hasManyThrough(
            User::class,
            Reply::class,
            'thread_id',
            'id',
            'id',
            'user_id'
        );
    }
}
