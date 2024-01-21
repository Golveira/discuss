<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Replies\ThreadReply;

test('create reply form is not displayed for guests', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->assertDontSeeHtml('id="create-child-form"');
});

test('users can reply to a reply', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->set('childBody', 'Nested reply')
        ->call('createChild')
        ->assertSee('Nested reply');
});

test('users cannot reply to a reply if the thread is closed', function () {
    $user = User::factory()->create();
    $closedThread = Thread::factory()->closed()->create();
    $reply = Reply::factory()->for($closedThread)->create();

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['thread' => $closedThread, 'reply' => $reply])
        ->set('childBody', 'Nested reply')
        ->call('createChild')
        ->assertForbidden();
});

test('guests cannot reply to a reply', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->set('childBody', 'Nested reply')
        ->call('createChild')
        ->assertForbidden();
});

test('users can edit they own reply', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create([
        'user_id' => $user->id,
        'thread_id' => $thread->id
    ]);

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->set('body', 'Updated reply')
        ->call('update')
        ->assertSee('Updated reply');

    $this->assertSame('Updated reply', $reply->fresh()->body);
});

test('admins can edit any reply', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($admin)
        ->test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->set('body', 'Updated reply')
        ->call('update')
        ->assertSee('Updated reply');

    $this->assertSame('Updated reply', $reply->fresh()->body);
});

test('users cannot edit a reply they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->set('body', 'Updated reply')
        ->call('update')
        ->assertForbidden();
});

test('users can delete they own reply', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create([
        'user_id' => $user->id,
        'thread_id' => $thread->id
    ]);

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->call('delete');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});

test('admins can delete any reply', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($admin)
        ->test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->call('delete');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});

test('users cannot delete a reply they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->call('delete')
        ->assertForbidden();
});
