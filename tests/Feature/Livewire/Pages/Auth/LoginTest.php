<?php

use App\Livewire\Layout\Navigation;
use App\Livewire\Pages\Auth\Login;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Livewire\Livewire;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response
        ->assertOk()
        ->assertSeeLivewire(Login::class);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $component = Livewire::test(Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'password');

    $component->call('login');

    $component
        ->assertHasNoErrors()
        ->assertRedirect(RouteServiceProvider::HOME);

    $this->assertAuthenticated();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $component = Livewire::test(Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'wrong-password');

    $component->call('login');

    $component
        ->assertHasErrors()
        ->assertNoRedirect();

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Livewire::test(Navigation::class);

    $component->call('logout');

    $component
        ->assertHasNoErrors()
        ->assertRedirect(RouteServiceProvider::HOME);

    $this->assertGuest();
});
