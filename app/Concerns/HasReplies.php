<?php

namespace App\Concerns;

use App\Models\User;
use App\Models\Reply;
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

    public function addReply(string $body, ?int $parent_id = null): Reply
    {
        return $this->replies()->create([
            'user_id' => auth()->id(),
            'parent_id' => $parent_id,
            'body' => $body,
        ]);
    }
}
