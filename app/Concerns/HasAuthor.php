<?php

namespace App\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAuthor
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isAuthoredBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $this->user_id === $user->id;
    }
}
