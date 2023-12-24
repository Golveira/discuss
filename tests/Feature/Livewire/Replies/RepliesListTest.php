<?php

use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Replies\RepliesList;
use App\Models\Reply;
use App\Models\User;

test('thread replies are displayed', function () {
    $thread = Thread::factory()->create();
    Reply::factory()->create(['thread_id' => $thread->id, 'body' => 'First reply']);
    Reply::factory()->create(['thread_id' => $thread->id, 'body' => 'Second reply']);

    Livewire::test(RepliesList::class, ['thread' => $thread->fresh()])
        ->assertSee('First reply')
        ->assertSee('Second reply');
});

test('test user can create a reply', function () {
    $thread = Thread::factory()->create();
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(RepliesList::class, ['thread' => $thread])
        ->set('body', 'This is a reply')
        ->call('create')
        ->assertSee('This is a reply');

    $this->assertDatabaseHas('replies', [
        'user_id' => $user->id,
        'thread_id' => $thread->id,
        'body' => 'This is a reply',
    ]);
});

test('a reply requires a body', function () {
    $thread = Thread::factory()->create();

    Livewire::actingAs(User::factory()->create())
        ->test(RepliesList::class, ['thread' => $thread])
        ->call('create')
        ->assertHasErrors(['body']);
});

test('guests cannot see reply form', function () {
    $thread = Thread::factory()->create();

    Livewire::test(RepliesList::class, ['thread' => $thread])
        ->assertSee('Sign in to participate')
        ->assertDontSee('Post reply');
});
