<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;

it('can mark a reply as best reply', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    $thread->markAsBestReply($reply);

    expect($thread->hasAsBestReply($reply))->toBeTrue();
});

it('can unmark a reply as best reply', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    $thread->markAsBestReply($reply);
    $thread->removeBestReply();

    expect($thread->hasAsBestReply($reply))->toBeFalse();
});

it('can toggle a like', function () {
    $thread = Thread::factory()->create();
    $user = User::factory()->create();

    $thread->toggleLike($user);

    expect($thread->refresh()->isLikedBy($user))->toBeTrue();

    $thread->toggleLike($user);

    expect($thread->refresh()->isLikedBy($user))->toBeFalse();
});

it('can pin a thread', function () {
    $thread = Thread::factory()->create();

    $thread->pin();

    expect($thread->isPinned())->toBeTrue();
});

it('can unpin a thread', function () {
    $thread = Thread::factory()->create();

    $thread->pin();
    $thread->unpin();

    expect($thread->isPinned())->toBeFalse();
});

it('can close a thread', function () {
    $thread = Thread::factory()->create();

    $thread->close();

    expect($thread->isClosed())->toBeTrue();
});

it('can open a thread', function () {
    $thread = Thread::factory()->create();

    $thread->close();
    $thread->open();

    expect($thread->isClosed())->toBeFalse();
});

it('returns pinned threads', function () {
    $pinnedThread = Thread::factory()->pinned()->create();
    $unpinnedThread = Thread::factory()->create();

    $pinnedThreads = Thread::pinned()->get();

    $this->assertCount(1, $pinnedThreads);
    $this->assertTrue($pinnedThreads->contains($pinnedThread));
    $this->assertFalse($pinnedThreads->contains($unpinnedThread));
});

it('returns the participants of the thread', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    $participants = $thread->participants();

    $this->assertCount(2, $participants);
    $this->assertTrue($participants->contains($thread->author));
    $this->assertTrue($participants->contains($reply->author));
});

it('can subscribe a user', function () {
    $thread = Thread::factory()->create();
    $user = User::factory()->create();

    $thread->subscribe($user);

    $this->assertTrue($thread->hasSubscriber($user));
});

it('can unsubscribe a user', function () {
    $thread = Thread::factory()->create();
    $user = User::factory()->create();

    $thread->subscribe($user);
    $thread->unsubscribe($user);

    $this->assertFalse($thread->hasSubscriber($user));
});

it('returns the subscribed users', function () {
    $thread = Thread::factory()->create();
    $user = User::factory()->create();

    $thread->subscribe($user);
    $subscribedUsers = $thread->subscribedUsers();

    $this->assertCount(1, $subscribedUsers);
    $this->assertTrue($subscribedUsers->contains($user));
});

it('searches threads by title and body', function () {
    $thread = Thread::factory()->create(['title' => 'My thread']);
    $anotherThread = Thread::factory()->create(['body' => 'My thread']);

    $threads = Thread::search('My thread')->get();

    $this->assertCount(2, $threads);
    $this->assertTrue($threads->contains($thread));
    $this->assertTrue($threads->contains($anotherThread));
});
