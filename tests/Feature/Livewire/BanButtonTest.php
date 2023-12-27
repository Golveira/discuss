<?php

use App\Livewire\BanButton;
use App\Models\User;
use Livewire\Livewire;

test('admin can see ban button', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    $this->actingAs($admin)
        ->get(route('profile.show', $user))
        ->assertSeeLivewire(BanButton::class);
});

test('user cannot see ban button', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('profile.show', $user))
        ->assertDontSeeLivewire(BanButton::class);
});

test('admin can ban a user', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    Livewire::actingAs($admin)
        ->test(BanButton::class, ['user' => $user])
        ->assertSee('Ban')
        ->call('ban')
        ->assertSee('Unban');

    $this->assertTrue($user->fresh()->isBanned());
});

test('admin can unban a user', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->banned()->create();

    Livewire::actingAs($admin)
        ->test(BanButton::class, ['user' => $user])
        ->assertSee('Unban')
        ->call('unban')
        ->assertSee('Ban');

    $this->assertFalse($user->fresh()->isBanned());
});

test('user cannot ban another user', function () {
    $user = User::factory()->create();
    $anotherUser = User::factory()->create();

    Livewire::actingAs($user)
        ->test(BanButton::class, ['user' => $anotherUser])
        ->call('ban')
        ->assertForbidden();
});

test('admin cannot ban another admin', function () {
    $admin = User::factory()->admin()->create();
    $anotherAdmin = User::factory()->admin()->create();

    Livewire::actingAs($admin)
        ->test(BanButton::class, ['user' => $anotherAdmin])
        ->call('ban')
        ->assertForbidden();
});
