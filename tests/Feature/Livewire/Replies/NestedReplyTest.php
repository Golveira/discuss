<?php

use App\Models\User;
use App\Models\Reply;
use Livewire\Livewire;
use App\Livewire\Replies\NestedReply;

test('guests cannot see nested reply actions', function () {
    $reply = Reply::factory()->create();

    Livewire::test(NestedReply::class, ['reply' => $reply])
        ->assertDontSeeHtml('id="reply-actions"');
});

test('users can see nested reply actions if they own the reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(NestedReply::class, ['reply' => $reply])
        ->assertSeeHtml('id="reply-actions"');
});

test('admins can see nested reply actions of any reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($admin)
        ->test(NestedReply::class, ['reply' => $reply])
        ->assertSeeHtml('id="reply-actions"');
});

test('users cannot see nested reply actions if they do not own the reply', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($user)
        ->test(NestedReply::class, ['reply' => $reply])
        ->assertDontSeeHtml('id="reply-actions"');
});

test('users can edit a nested reply they own', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(NestedReply::class, ['reply' => $reply])
        ->set('body', 'Updated reply')
        ->call('update');

    $this->assertDatabaseHas('replies', ['body' => 'Updated reply']);
});

test('users cannot edit a nested reply they do not own', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($user)
        ->test(NestedReply::class, ['reply' => $reply])
        ->set('body', 'Updated reply')
        ->call('update')
        ->assertForbidden();
});

test('admins can edit any nested reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($admin)
        ->test(NestedReply::class, ['reply' => $reply])
        ->set('body', 'Updated reply')
        ->call('update');

    $this->assertDatabaseHas('replies', ['body' => 'Updated reply']);
});

test('users can delete a nested reply they own', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(NestedReply::class, ['reply' => $reply])
        ->call('delete');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});

test('users cannot delete a nested reply they do not own', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($user)
        ->test(NestedReply::class, ['reply' => $reply])
        ->call('delete')
        ->assertForbidden();
});

test('admins can delete any nested reply', function () {
    $admin = User::factory()->admin()->create();
    $reply = Reply::factory()->create();

    Livewire::actingAs($admin)
        ->test(NestedReply::class, ['reply' => $reply])
        ->call('delete');

    $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
});
