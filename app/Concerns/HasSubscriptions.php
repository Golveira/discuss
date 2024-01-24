<?php

namespace App\Concerns;

use App\Models\ThreadSubscription;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

trait HasSubscriptions
{
    public function subscriptions(): HasMany
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function subscribedUsers(): Collection
    {
        return User::whereHas('subscriptions', function (Builder $query) {
            $query->where('thread_id', $this->id);
        })->get();
    }

    public function subscribe(User $user): void
    {
        $this->subscriptions()->create([
            'user_id' => $user->id
        ]);
    }

    public function unsubscribe(User $user): void
    {
        $this->subscriptions()
            ->where('user_id', $user->id)
            ->delete();
    }

    public function hasSubscriber(User $user): bool
    {
        return $this->subscriptions()
            ->where('user_id', $user->id)
            ->exists();
    }
}
