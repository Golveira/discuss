<?php

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Pages\ProfileShow;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $this->get(route('profile.show', $user->username))
        ->assertOk()
        ->assertSeeLivewire(ProfileShow::class);
});

test('profile page shows user information', function () {
    $user = User::factory()->create();

    Livewire::test(ProfileShow::class, ['user' => $user])
        ->assertSee($user->name)
        ->assertSee($user->username);
});

test('profile page shows user threads', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create(['user_id' => $user->id]);

    Livewire::test(ProfileShow::class, ['user' => $user])
        ->assertSet('selectedTab', 'threads')
        ->assertSee($thread->title);
});

test('profile page shows user replies', function () {
    $user = User::factory()->create();
    $reply = Reply::factory()->create(['user_id' => $user->id]);

    Livewire::test(ProfileShow::class, ['user' => $user])
        ->set('selectedTab', 'replies')
        ->assertSee($reply->body);
});

test('users can see edit button on their own profile', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ProfileShow::class, ['user' => $user])
        ->assertSee('Edit profile');
});

test('users cannot see edit button on other users profile', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ProfileShow::class, ['user' => $otherUser])
        ->assertDontSee('Edit profile');
});

test('admin can ban a user', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    Livewire::actingAs($admin)
        ->test(ProfileShow::class, ['user' => $user])
        ->call('ban')
        ->assertSee('Unban');

    $this->assertTrue($user->fresh()->isBanned());
});

test('admin can unban a user', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    Livewire::actingAs($admin)
        ->test(ProfileShow::class, ['user' => $user])
        ->call('unban')
        ->assertSee('Ban');

    $this->assertFalse($user->fresh()->isBanned());
});

test('user cannot ban another user', function () {
    $user = User::factory()->create();
    $anotherUser = User::factory()->create();

    Livewire::actingAs($user)
        ->test(ProfileShow::class, ['user' => $anotherUser])
        ->call('ban')
        ->assertForbidden();
});

test('admin cannot ban another admin', function () {
    $admin = User::factory()->admin()->create();
    $anotherAdmin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(ProfileShow::class, ['user' => $anotherAdmin])
        ->call('ban')
        ->assertForbidden();
});
