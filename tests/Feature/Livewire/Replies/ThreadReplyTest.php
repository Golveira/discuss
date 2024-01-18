<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Replies\ThreadReply;

test('guests cannot see reply actions', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->assertDontSeeHtml('id="reply-actions"');
});

test('users can see reply actions if they own the reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['reply' => $reply])
        ->assertSeeHtml('id="reply-actions"');
});

test('admins can see reply actions of any reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($admin)
        ->test(ThreadReply::class, ['reply' => $reply])
        ->assertSeeHtml('id="reply-actions"');
});

test('users cannot see reply actions if they do not own the reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['reply' => $reply])
        ->assertDontSeeHtml('id="reply-actions"');
});

test('guests cannot see create reply form', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->assertDontSeeHtml('id="create-child-form"');
});

test('users can reply to a reply', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['thread' => $thread, 'reply' => $reply])
        ->set('childBody', 'Nested reply')
        ->call('createChild')
        ->assertSee('Nested reply');
});

test('users can edit they own reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['reply' => $reply])
        ->set('body', 'Updated reply')
        ->call('update')
        ->assertSee('Updated reply');

    $this->assertDatabaseHas('replies', ['body' => 'Updated reply']);
});

test('admins can edit any reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($admin)
        ->test(ThreadReply::class, ['reply' => $reply])
        ->set('body', 'Updated reply')
        ->call('update')
        ->assertSee('Updated reply');

    $this->assertDatabaseHas('replies', ['body' => 'Updated reply']);
});

test('users cannot edit a reply they do not own', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['reply' => $reply])
        ->set('body', 'Updated reply')
        ->call('update')
        ->assertForbidden();
});

test('users can delete they own reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['reply' => $reply])
        ->call('delete');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});

test('admins can delete any reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($admin)
        ->test(ThreadReply::class, ['reply' => $reply])
        ->call('delete');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});

test('users cannot delete a reply they do not own', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadReply::class, ['reply' => $reply])
        ->call('delete')
        ->assertForbidden();
});
