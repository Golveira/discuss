<?php

use App\Models\User;
use Livewire\Livewire;
use App\Models\Channel;
use App\Livewire\Threads\ThreadCreate;

test('create thread page is displayed for authenticated users', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('threads.create'))
        ->assertSuccessful()
        ->assertSeeLivewire(ThreadCreate::class);
});

test('create thread page is not displayed for guests', function () {
    $this->get(route('threads.create'))
        ->assertRedirect('/login');
});

test('users can create a thread', function () {
    $user = User::factory()->create();
    $channel = Channel::factory()->create();

    Livewire::actingAs($user)->test(ThreadCreate::class)
        ->set('form.title', 'My First Thread')
        ->set('form.channel_id', $channel->id)
        ->set('form.body', 'This is my first thread')
        ->call('save')
        ->assertRedirect(route('threads.show', 'my-first-thread'));

    $this->assertDatabaseHas('threads', [
        'title' => 'My First Thread',
        'slug' => 'my-first-thread',
        'body' => 'This is my first thread',
        'channel_id' => $channel->id,
    ]);
});

test('a thread requires a title', function () {
    $user = User::factory()->create();
    $channel = Channel::factory()->create();

    Livewire::actingAs($user)->test(ThreadCreate::class)
        ->set('form.title', '')
        ->set('form.channel_id', $channel->id)
        ->set('form.body', 'This is my first thread')
        ->call('save')
        ->assertHasErrors('form.title');
});

test('a thread requires a channel', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)->test(ThreadCreate::class)
        ->set('form.title', 'My First Thread')
        ->set('form.channel_id', '')
        ->set('form.body', 'This is my first thread')
        ->call('save')
        ->assertHasErrors('form.channel_id');
});

test('a thread requires a body', function () {
    $user = User::factory()->create();
    $channel = Channel::factory()->create();

    Livewire::actingAs($user)->test(ThreadCreate::class)
        ->set('form.title', 'My First Thread')
        ->set('form.channel_id', $channel->id)
        ->set('form.body', '')
        ->call('save')
        ->assertHasErrors('form.body');
});
