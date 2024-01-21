<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\ReplyItem;

test('create reply form is not displayed for guests', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->assertDontSeeHtml('id="create-child-form"');
});

test('users can reply to a reply', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::actingAs($user)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->set('replyForm.body', 'Nested reply')
        ->call('postReply')
        ->assertSee('Nested reply');
});

test('users cannot reply to a reply if the thread is closed', function () {
    $user = User::factory()->create();
    $closedThread = Thread::factory()->closed()->create();
    $reply = Reply::factory()->for($closedThread)->create();

    Livewire::actingAs($user)
        ->test(ReplyItem::class, ['thread' => $closedThread, 'reply' => $reply])
        ->set('replyForm.body', 'Nested reply')
        ->call('postReply')
        ->assertForbidden();
});

test('guests cannot reply to a reply', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->set('replyForm.body', 'Nested reply')
        ->call('postReply')
        ->assertForbidden();
});

test('users can edit they own reply', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create([
        'user_id' => $user->id,
        'thread_id' => $thread->id,
        'body' => 'Original reply'
    ]);

    Livewire::actingAs($user)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->set('editForm.body', 'Updated reply')
        ->call('editReply')
        ->assertSee('Updated reply');

    $this->assertSame('Updated reply', $reply->fresh()->body);
});

test('admins can edit any reply', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create([
        'thread_id' => $thread->id,
        'body' => 'Original reply'
    ]);

    Livewire::actingAs($admin)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->set('editForm.body', 'Updated reply')
        ->call('editReply')
        ->assertSee('Updated reply');

    $this->assertSame('Updated reply', $reply->fresh()->body);
});

test('users cannot edit a reply they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($user)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->set('editForm.body', 'Updated reply')
        ->call('editReply')
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
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->call('deleteReply');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});

test('admins can delete any reply', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($admin)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->call('deleteReply');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});

test('users cannot delete a reply they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($user)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->call('deleteReply')
        ->assertForbidden();
});

test('users can mark a reply as answer if they own the thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->for($user, 'author')->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::actingAs($user)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->call('markAsAnswer');

    $this->assertTrue($thread->refresh()->hasAsBestReply($reply));
});

test('admins can mark any reply as answer', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::actingAs($admin)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->call('markAsAnswer');

    $this->assertTrue($thread->refresh()->hasAsBestReply($reply));
});

test('guests cannot mark any reply as answer', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->call('markAsAnswer')
        ->assertForbidden();

    $this->assertFalse($thread->refresh()->hasBestReply());
});

test('users cannot mark a reply as answer if they do not own the thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->for($thread)->create();

    Livewire::actingAs($user)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->call('markAsAnswer')
        ->assertForbidden();

    $this->assertFalse($thread->refresh()->hasBestReply());
});

test('users can unmark a reply as answer if they own the thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->for($user, 'author')->create();
    $reply = Reply::factory()->for($thread)->create();

    $thread->markAsBestReply($reply);
    $this->assertTrue($thread->refresh()->hasAsBestReply($reply));

    Livewire::actingAs($user)
        ->test(ReplyItem::class, ['thread' => $thread, 'reply' => $reply])
        ->call('unmarkAsAnswer');

    $this->assertFalse($thread->refresh()->hasAsBestReply($reply));
});
