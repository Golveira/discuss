<?php

namespace App\Concerns;

use App\Models\Reply;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
