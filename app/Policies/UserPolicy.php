<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function ban(User $user, User $target): bool
    {
        return $user->isAdmin() && !$target->isAdmin();
    }
}
