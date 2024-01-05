<?php

use App\Models\User;
use App\Models\Reply;
use Livewire\Livewire;
use App\Livewire\Replies\ReplyCard;
use App\Models\Thread;

test('admins can see the actions dropdown of any reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($admin)
        ->test(ReplyCard::class, ['reply' => $reply])
        ->assertSeeHtml('id="reply-actions"');
});

test('users can see the actions dropdown if they own the reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(ReplyCard::class, ['reply' => $reply])
        ->assertSeeHtml('id="reply-actions"');
});

test('users cannot see the actions dropdown if they do not own the reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($user)
        ->test(ReplyCard::class, ['reply' => $reply])
        ->assertDontSeeHtml('id="reply-actions"');
});

test('guests cannot see the actions dropdown of any thread', function () {
    $reply = Reply::factory()->create();

    Livewire::test(ReplyCard::class, ['reply' => $reply])
        ->assertDontSeeHtml('id="reply-actions"');
});

test('admins can edit any reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create(['body' => 'Original reply']);

    Livewire::actingAs($admin)
        ->test(ReplyCard::class, ['reply' => $reply])
        ->set('form.body', 'Updated reply')
        ->call('update')
        ->assertSee('Updated reply');
});

test('users can edit they own reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create([
        'user_id' => $user->id,
        'body' => 'Original reply'
    ]);

    Livewire::actingAs($user)
        ->test(ReplyCard::class, ['reply' => $reply])
        ->set('form.body', 'Updated reply')
        ->call('update')
        ->assertSee('Updated reply');
});

test('users cannot edit a reply they do not own', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($user)
        ->test(ReplyCard::class, ['reply' => $reply])
        ->set('form.body', 'Updated reply')
        ->call('update')
        ->assertForbidden();
});

test('admins can see best reply button if they are not the owner of the thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($admin)
        ->test(ReplyCard::class, ['thread' => $thread, 'reply' => $reply])
        ->assertSee('Mark as Answer');
});

test('users can see best reply button if they are the owner of the thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create(['user_id' => $user->id]);
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($user)
        ->test(ReplyCard::class, ['thread' => $thread, 'reply' => $reply])
        ->assertSee('Mark as Answer');
});

test('users cannot see best reply button if they are not the owner of the thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($user)
        ->test(ReplyCard::class, ['thread' => $thread, 'reply' => $reply])
        ->assertDontSee('Mark as Answer');
});

test('guests cannot see best reply button', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::test(ReplyCard::class, ['thread' => $thread, 'reply' => $reply])
        ->assertDontSee('Mark as Answer');
});

test('admins can mark a reply as best reply for any thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($admin)
        ->test(ReplyCard::class, ['thread' => $thread, 'reply' => $reply])
        ->call('markAsBestReply');

    $thread->refresh();

    $this->assertTrue($thread->hasAsBestReply($reply));
});

test('users can mark a reply as best reply for a thread they own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create(['user_id' => $user->id]);
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($user)
        ->test(ReplyCard::class, ['thread' => $thread, 'reply' => $reply])
        ->call('markAsBestReply');

    $thread->refresh();

    $this->assertTrue($thread->hasAsBestReply($reply));
});

test('users cannot mark a reply as best reply for a thread they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);

    Livewire::actingAs($user)
        ->test(ReplyCard::class, ['thread' => $thread, 'reply' => $reply])
        ->call('markAsBestReply')
        ->assertForbidden();
});

test('users can remove best reply for a thread they own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create(['user_id' => $user->id]);
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);
    $thread->markAsBestReply($reply);

    Livewire::actingAs($user)
        ->test(ReplyCard::class, ['thread' => $thread, 'reply' => $reply])
        ->call('removeBestReply');

    $thread->refresh();

    $this->assertFalse($thread->hasAsBestReply($reply));
});

test('admins can remove best reply for any thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['thread_id' => $thread->id]);
    $thread->markAsBestReply($reply);

    Livewire::actingAs($admin)
        ->test(ReplyCard::class, ['thread' => $thread, 'reply' => $reply])
        ->call('removeBestReply');

    $thread->refresh();

    $this->assertFalse($thread->hasAsBestReply($reply));
});
