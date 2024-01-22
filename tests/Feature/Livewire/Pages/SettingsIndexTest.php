<?php

use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Facades\Hash;
use App\Livewire\Pages\SettingsIndex;
use App\Providers\RouteServiceProvider;

test('settings page is displayed for authenticated users', function () {
    $this->actingAs(User::factory()->create());

    $this->get(route('settings.index'))
        ->assertOk()
        ->assertSeeLivewire(SettingsIndex::class);
});

test('profile can be updated', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(SettingsIndex::class)
        ->set('profileForm.name', 'John Doe')
        ->set('profileForm.username', 'johndoe')
        ->set('profileForm.email', 'johndoe@example.com')
        ->call('updateProfile')
        ->assertHasNoErrors();

    $user->refresh();

    $this->assertEquals('John Doe', $user->name);
    $this->assertEquals('johndoe', $user->username);
    $this->assertEquals('johndoe@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(SettingsIndex::class)
        ->set('profileForm.name', 'Test User')
        ->set('profileForm.username', 'testuser')
        ->set('profileForm.email', $user->email)
        ->call('updateProfile')
        ->assertHasNoErrors();

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(SettingsIndex::class)
        ->call('deleteAccount')
        ->assertHasNoErrors()
        ->assertRedirect(RouteServiceProvider::HOME);

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('password can be updated', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(SettingsIndex::class)
        ->set('passwordForm.current_password', 'password')
        ->set('passwordForm.password', 'new-password')
        ->set('passwordForm.password_confirmation', 'new-password')
        ->call('updatePassword')
        ->assertHasNoErrors();

    $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(SettingsIndex::class)
        ->set('passwordForm.current_password', 'wrong-password')
        ->set('passwordForm.password', 'new-password')
        ->set('passwordForm.password_confirmation', 'new-password')
        ->call('updatePassword')
        ->assertHasErrors(['passwordForm.current_password']);
});
