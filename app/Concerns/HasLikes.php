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

    public function like(User $user): void
    {
        $this->likes()->create(['user_id' => $user->id]);
    }

    public function unlike(User $user): void
    {
        $this->likes()->where('user_id', $user->id)->delete();
    }

    public function toggleLike(User $user): void
    {
        $this->isLikedBy($user) ? $this->unlike($user) : $this->like($user);
    }

    public function isLikedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->likes->contains('user_id', $user->id);
    }
}
