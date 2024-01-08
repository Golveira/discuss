<?php

use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Replies\RepliesList;
use App\Models\Reply;
use App\Models\User;

test('replies of a thread are displayed', function () {
    $thread = Thread::factory()->create();
    Reply::factory()->create(['thread_id' => $thread->id, 'body' => 'First reply']);
    Reply::factory()->create(['thread_id' => $thread->id, 'body' => 'Second reply']);

    Livewire::test(RepliesList::class, ['thread' => $thread->fresh()])
        ->assertSee('First reply')
        ->assertSee('Second reply');
});

test('guests cannot see reply form', function () {
    $thread = Thread::factory()->create();

    Livewire::test(RepliesList::class, ['thread' => $thread])
        ->assertDontSee('Add a Reply');
});

test('user can create a reply', function () {
    $thread = Thread::factory()->create();
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(RepliesList::class, ['thread' => $thread])
        ->set('form.body', 'This is a reply')
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
        ->assertHasErrors(['form.body']);
});

test('users can delete a reply they own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create([
        'user_id' => $user->id,
        'thread_id' => $thread->id,
        'body' => 'This is a reply'
    ]);

    Livewire::actingAs($user)
        ->test(RepliesList::class, ['thread' => $thread])
        ->assertSee('This is a reply')
        ->call('delete', $reply)
        ->assertDontSee('This is a reply');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});

test('admins can delete any reply', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create([
        'thread_id' => $thread->id,
        'body' => 'This is a reply'
    ]);

    Livewire::actingAs($admin)
        ->test(RepliesList::class, ['thread' => $thread])
        ->assertSee('This is a reply')
        ->call('delete', $reply)
        ->assertDontSee('This is a reply');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});

test('users cannot delete a reply they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create([
        'thread_id' => $thread->id,
        'body' => 'This is a reply'
    ]);

    Livewire::actingAs($user)
        ->test(RepliesList::class, ['thread' => $thread])
        ->call('delete', $reply)
        ->assertForbidden();
});
