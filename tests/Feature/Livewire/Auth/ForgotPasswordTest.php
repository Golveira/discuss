<?php

use App\Livewire\Auth\ForgotPassword;
use Livewire\Livewire;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

test('forgot password screen can be rendered', function () {
    $response = $this->get('/forgot-password');

    $response
        ->assertSeeLivewire(ForgotPassword::class)
        ->assertStatus(200);
});

test('reset password link can be requested', function () {
    Notification::fake();

    $user = User::factory()->create();

    Livewire::test(ForgotPassword::class)
        ->set('email', $user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($user, ResetPassword::class);
});
