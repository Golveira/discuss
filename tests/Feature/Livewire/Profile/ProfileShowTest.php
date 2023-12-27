<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Profile\ProfileShow;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $this->get(route('profile.show', $user->username))
        ->assertOk()
        ->assertSeeLivewire(ProfileShow::class);
});

test('profile page shows user information', function () {
    $user = User::factory()->create([
        'username' => 'johndoe',
        'created_at' => '2022-12-01',
    ]);

    Livewire::test(ProfileShow::class, ['user' => $user])
        ->assertSee('johndoe')
        ->assertSee('Joined Dec 2022');
});

test('profile page shows user threads', function () {
    $user = User::factory()->create();
    Thread::factory()->create([
        'user_id' => $user->id,
        'title' => 'My first thread',
    ]);

    Livewire::test(ProfileShow::class, ['user' => $user])
        ->assertSet('selectedTab', 'threads')
        ->assertSee('My first thread');
});

test('profile page shows user replies', function () {
    $user = User::factory()->create();
    Reply::factory()->create([
        'user_id' => $user->id,
        'body' => 'My first reply',
    ]);

    Livewire::test(ProfileShow::class, ['user' => $user])
        ->set('selectedTab', 'replies')
        ->assertSee('My first reply');
});
