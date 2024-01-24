<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\RepliesList;
use App\Notifications\NewReplyNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;

test('replies of a thread are displayed', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::test(RepliesList::class, ['thread' => $thread->fresh()])
        ->assertSee($reply->body);
});

test('guests cannot see reply form', function () {
    $thread = Thread::factory()->create();

    Livewire::test(RepliesList::class, ['thread' => $thread])
        ->assertDontSeeHtml('id="create-reply-form"');
});

test('a reply requires a body', function () {
    $thread = Thread::factory()->create();

    Livewire::actingAs(User::factory()->create())
        ->test(RepliesList::class, ['thread' => $thread])
        ->call('create')
        ->assertHasErrors(['replyForm.body']);
});

test('users can reply to a thread', function () {
    $thread = Thread::factory()->create();
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(RepliesList::class, ['thread' => $thread])
        ->set('replyForm.body', 'This is a reply')
        ->call('create')
        ->assertSee('This is a reply');

    $this->assertDatabaseHas('replies', [
        'user_id' => $user->id,
        'thread_id' => $thread->id,
        'body' => 'This is a reply',
    ]);
});

test('users cannot reply to a thread if the thread is closed', function () {
    $user = User::factory()->create();
    $closedThread = Thread::factory()->closed()->create();

    Livewire::actingAs($user)
        ->test(RepliesList::class, ['thread' => $closedThread])
        ->set('replyForm.body', 'This is a reply')
        ->call('create')
        ->assertForbidden();
});

test('guests cannot reply to a thread', function () {
    $thread = Thread::factory()->create();

    Livewire::test(RepliesList::class, ['thread' => $thread])
        ->set('replyForm.body', 'This is a reply')
        ->call('create')
        ->assertForbidden();
});

test('users are notified when a new reply is created', function () {
    Notification::fake();

    $thread = Thread::factory()->create();
    $user = User::factory()->create();
    $thread->subscribe($user);

    Livewire::actingAs(User::factory()->create())
        ->test(RepliesList::class, ['thread' => $thread])
        ->set('replyForm.body', 'This is a reply')
        ->call('create')
        ->assertSee('This is a reply');

    Notification::assertSentTo([$user], NewReplyNotification::class);
});
