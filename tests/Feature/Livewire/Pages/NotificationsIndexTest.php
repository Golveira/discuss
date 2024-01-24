<?php

use App\Models\User;
use App\Models\Thread;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Notifications\NewReplyNotification;
use App\Livewire\Pages\NotificationsIndex;

test('guests cannot see notifications page', function () {
    $this->get(route('notifications.index'))
        ->assertRedirect(route('login'));
});

test('users can see notifications page', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    $notification = $user->notifications()->create([
        'id' => Str::random(),
        'type' => NewReplyNotification::class,
        'data' => [
            "title" => $thread->title,
            'message' => "A new reply was added to",
            'link' => route('threads.show', $thread),
        ],
    ]);

    Livewire::actingAs($user)
        ->test(NotificationsIndex::class)
        ->assertSee($notification->data['message'])
        ->assertSee($notification->data['title']);
});

test('users can mark notifications as read', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    $notification = $user->notifications()->create([
        'id' => Str::random(),
        'type' => NewReplyNotification::class,
        'data' => [
            "title" => $thread->title,
            'message' => "A new reply was added to",
            'link' => route('threads.show', $thread),
        ],
    ]);

    Livewire::actingAs($user)
        ->test(NotificationsIndex::class)
        ->assertSee($notification->data['message'])
        ->call('markAsRead', $notification->id)
        ->assertDontSee($notification->data['message']);

    $this->assertTrue($user->notifications->first()->read());
});

test('users can mark all notifications as read', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    $notification = $user->notifications()->create([
        'id' => Str::random(),
        'type' => NewReplyNotification::class,
        'data' => [
            "title" => $thread->title,
            'message' => "A new reply was added to",
            'link' => route('threads.show', $thread),
        ],
    ]);

    Livewire::actingAs($user)
        ->test(NotificationsIndex::class)
        ->assertSee($notification->data['message'])
        ->call('markAllAsRead')
        ->assertDontSee($notification->data['message']);

    $this->assertTrue($user->notifications->first()->read());
});

test('users cannot mark other users notifications as read', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();
    $thread = Thread::factory()->create();

    $notification = $otherUser->notifications()->create([
        'id' => Str::random(),
        'type' => NewReplyNotification::class,
        'data' => [
            "title" => $thread->title,
            'message' => "A new reply was added to",
            'link' => route('threads.show', $thread),
        ],
    ]);

    Livewire::actingAs($user)
        ->test(NotificationsIndex::class)
        ->call('markAsRead', $notification->id)
        ->assertForbidden();
});
