<?php

namespace App\Listeners;

use App\Events\ReplyWasCreated;
use App\Notifications\NewReplyNotification;

class NotifyThreadSubscribers
{
    public function handle(ReplyWasCreated $event): void
    {
        $event->reply->thread
            ->subscribedUsers()
            ->where('id', '!==', $event->reply->user_id)
            ->each
            ->notify(new NewReplyNotification($event->reply));
    }
}
