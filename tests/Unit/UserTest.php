<?php

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;

it('can be banned', function () {
    $user = User::factory()->create();

    $user->ban();

    expect($user->fresh()->isBanned())->toBeTrue();
});

it('can be unbanned', function () {
    $user = User::factory()->create();

    $user->ban();
    $user->unban();

    expect($user->fresh()->isBanned())->toBeFalse();
});

it('can order users by most solutions', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    createSolutionForUser($user1, $user2);

    $users = User::orderByMostSolutions()->get();

    expect($users->first()->id)->toEqual($user1->id);
    expect($users->last()->id)->toEqual($user2->id);
});

function createSolutionForUser(User $replyAuthor, User $threadAuthor): void
{
    $thread = Thread::factory()->create(['user_id' => $threadAuthor->id]);
    $reply = Reply::factory()->create(['user_id' => $replyAuthor->id, 'thread_id' => $thread->id]);
    $thread->markAsBestReply($reply);
}
