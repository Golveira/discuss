<?php

namespace App\Listeners;

use App\Events\ReplyWasCreated;
use App\Notifications\NewReplyNotification;

class NotifyThreadSubscribers
{
    public function handle(ReplyWasCreated $event): void
    {
        $subscriptions = $event->reply->thread
            ->subscriptions()
            ->where('user_id', '!=', $event->reply->user_id)
            ->with('user')
            ->get();

        foreach ($subscriptions as $subscription) {
            $subscription->user->notify(new NewReplyNotification($event->reply));
        }
    }
}
