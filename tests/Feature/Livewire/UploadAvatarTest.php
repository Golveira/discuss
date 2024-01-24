<?php

use App\Livewire\UploadAvatar;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

test('avatar can be uploaded', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('avatar.jpg');

    Livewire::actingAs($user)
        ->test(UploadAvatar::class)
        ->set('avatar', $file)
        ->assertHasNoErrors();

    $user->refresh();

    $this->assertNotNull($user->avatar_path);
    Storage::disk('public')->assertExists($user->avatar_path);
});

test('avatar cannot be uploaded if the file is not an image', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $file = UploadedFile::fake()->create('avatar.txt');

    Livewire::actingAs($user)
        ->test(UploadAvatar::class)
        ->set('avatar', $file)
        ->assertHasErrors('avatar');
});

test('avatar cannot be uploaded if the image is too large', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('avatar.jpg')->size(2049);

    Livewire::actingAs($user)
        ->test(UploadAvatar::class)
        ->set('avatar', $file)
        ->assertHasErrors('avatar');
});
