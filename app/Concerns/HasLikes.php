<?php

namespace App\Concerns;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLikes
{
    public static function bootHasLikes(): void
    {
        static::deleting(function ($model) {
            $model->likes->each->delete();
        });
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function toggleLike(User $user): void
    {
        if ($this->isLikedBy($user)) {
            $this->likes()->where('user_id', $user->id)->delete();
            return;
        }

        $this->likes()->create(['user_id' => $user->id]);
    }

    public function isLikedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->likes->contains('user_id', $user->id);
    }
}
