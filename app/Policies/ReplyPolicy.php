<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\User;

class ReplyPolicy
{
    public function before(User $user): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    public function update(User $user, Reply $reply): bool
    {
        return $reply->author()->is($user);
    }

    public function delete(User $user, Reply $reply): bool
    {
        return $reply->author()->is($user);
    }
}
