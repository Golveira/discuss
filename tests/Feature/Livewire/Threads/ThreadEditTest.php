<?php

use App\Models\User;
use App\Models\Thread;
use Livewire\Livewire;
use App\Models\Channel;
use App\Livewire\Threads\ThreadEdit;

test('edit thread page is not displayed for guests', function () {
    $thread = Thread::factory()->create();

    $this->get(route('threads.edit', $thread))
        ->assertRedirect('/login');
});

test('a user cannot edit a thread they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadEdit::class, ['thread' => $thread])
        ->assertForbidden();
});

test('a user can edit their own threads', function () {
    $user = User::factory()->create();
    $channel = Channel::factory()->create();
    $thread = Thread::factory()->create([
        'user_id' => $user->id,
        'title' => 'Old title',
        'body' => 'Old body',
    ]);

    Livewire::actingAs($user)
        ->test(ThreadEdit::class, ['thread' => $thread])
        ->set('form.title', 'New title')
        ->set('form.channel_id', $channel->id)
        ->set('form.body', 'New body')
        ->call('save')
        ->assertRedirect(route('threads.show', 'new-title'));

    $thread->refresh();

    $this->assertSame('New title', $thread->title);
    $this->assertSame('New body', $thread->body);
    $this->assertSame($channel->id, $thread->channel_id);
});
