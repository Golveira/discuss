<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    public function before(User $user): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    public function update(User $user, Thread $thread): bool
    {
        return $thread->author()->is($user);
    }

    public function delete(User $user, Thread $thread): bool
    {
        return $thread->author()->is($user);
    }
}
