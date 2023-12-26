<?php

use App\Models\User;
use App\Models\Thread;
use App\Livewire\LikeButton;
use Livewire\Livewire;

test('users can see like button', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    $this->actingAs($user)
        ->get(route('threads.show', $thread))
        ->assertSeeLivewire(LikeButton::class);
});

test('guests cannot see like button', function () {
    $thread = Thread::factory()->create();

    $this->get(route('threads.show', $thread))
        ->assertDontSeeLivewire(LikeButton::class);
});

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
