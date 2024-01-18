<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class ReplyPolicy
{
    public function before(User $user): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    public function create(User $user): bool
    {
        return Auth::check();
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
