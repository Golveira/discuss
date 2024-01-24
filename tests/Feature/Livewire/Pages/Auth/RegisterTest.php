<?php

use App\Livewire\Pages\Auth\Register;
use App\Providers\RouteServiceProvider;
use Livewire\Livewire;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response
        ->assertOk()
        ->assertSeeLivewire(Register::class);
});

test('new users can register', function () {
    $component = Livewire::test(Register::class)
        ->set('name', 'Test User')
        ->set('username', 'testuser')
        ->set('email', 'test@example.com')
        ->set('password', 'password');

    $component->call('register');

    $component->assertRedirect(RouteServiceProvider::HOME);

    $this->assertAuthenticated();
});
