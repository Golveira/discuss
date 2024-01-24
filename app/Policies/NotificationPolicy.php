<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy
{
    public function markAsRead(User $user, DatabaseNotification $notification): bool
    {
        return $notification->notifiable->is($user);
    }
}
