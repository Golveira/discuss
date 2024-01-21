<?php

use App\Models\User;
use App\Models\Thread;
use App\Livewire\LikeButton;
use Livewire\Livewire;

test('users can like a thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(LikeButton::class, ['likeable' => $thread])
        ->call('toggleLike');

    $thread->refresh();

    $this->assertTrue($thread->isLikedBy($user));
});

test('users can unlike a thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    $component = Livewire::actingAs($user)
        ->test(LikeButton::class, ['likeable' => $thread]);

    $component->call('toggleLike');
    $this->assertTrue($thread->refresh()->isLikedBy($user));

    $component->call('toggleLike');
    $this->assertFalse($thread->refresh()->isLikedBy($user));
});

test('guests cannot like a thread', function () {
    $thread = Thread::factory()->create();

    Livewire::test(LikeButton::class, ['likeable' => $thread])
        ->call('toggleLike');

    $thread->refresh();

    $this->assertTrue($thread->likes->isEmpty());
});
