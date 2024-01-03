<?php

use App\Models\User;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use App\Livewire\Settings\Settings;
use Illuminate\Support\Facades\Hash;
use App\Livewire\Settings\DeleteAccount;
use App\Livewire\Settings\UpdateProfile;
use App\Livewire\Settings\UpdatePassword;
use Illuminate\Support\Facades\Storage;

test('settings page is displayed', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/settings');

    $response
        ->assertOk()
        ->assertSeeLivewire(Settings::class);
});

test('profile can be updated', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Livewire::test(UpdateProfile::class)
        ->set('avatar', UploadedFile::fake()->image('avatar.jpg'))
        ->set('name', 'Test User')
        ->set('username', 'testuser')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation');

    $component
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $user->refresh();

    $this->assertNotNull($user->avatar_path);
    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);

    Storage::disk('public')->assertExists($user->avatar_path);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Livewire::test(UpdateProfile::class)
        ->set('name', 'Test User')
        ->set('username', 'testuser')
        ->set('email', $user->email)
        ->call('updateProfileInformation');

    $component
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Livewire::test(DeleteAccount::class)
        ->call('deleteUser');

    $component
        ->assertHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('password can be updated', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Livewire::test(UpdatePassword::class)
        ->set('current_password', 'password')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('updatePassword');

    $component
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Livewire::test(UpdatePassword::class)
        ->set('current_password', 'wrong-password')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('updatePassword');

    $component
        ->assertHasErrors(['current_password'])
        ->assertNoRedirect();
});
