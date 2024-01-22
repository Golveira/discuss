<?php

use App\Models\Reply;
use Tests\TestCase;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

it('returns the participants of the thread', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    $participants = $thread->participants();

    $this->assertCount(2, $participants);
    $this->assertTrue($participants->contains($thread->author));
    $this->assertTrue($participants->contains($reply->author));
});
