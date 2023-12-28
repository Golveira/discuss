<?php

namespace App\Concerns;

use App\Models\ThreadSubscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasSubscriptions
{
    public function subscriptions(): HasMany
    {
        return $this->hasMany(ThreadSubscription::class);
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
