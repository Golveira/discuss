<?php

use App\Models\Reply;
use Tests\TestCase;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

it('generates an unique slug after thread creation', function () {
    $threadOne = Thread::factory()->create(['title' => 'My First Thread']);
    $threadTwo = Thread::factory()->create(['title' => 'My First Thread']);

    expect($threadOne->slug)->toBe('my-first-thread');
    expect($threadTwo->slug)->toBe('my-first-thread-2');
});

it('returns the usernames of the participants of the thread', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    $this->assertTrue($thread->participantUsernames()->contains($thread->author->username));
    $this->assertTrue($thread->participantUsernames()->contains($reply->author->username));
});
