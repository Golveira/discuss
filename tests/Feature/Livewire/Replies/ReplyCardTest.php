<?php

use App\Models\User;
use App\Models\Reply;
use Livewire\Livewire;
use App\Livewire\Replies\ReplyCard;

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

test('admins can see the actions dropdown of any reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($admin)
        ->test(ReplyCard::class, ['reply' => $reply])
        ->assertSeeHtml('id="reply-actions"');
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

test('admins can edit any reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create(['body' => 'Original reply']);

    Livewire::actingAs($admin)
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
