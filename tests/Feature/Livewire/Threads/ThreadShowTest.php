<?php

use App\Models\User;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Threads\ThreadShow;

test('thread show page is displayed', function () {
    Thread::factory()->create(['title' => 'My First Thread']);

    $this->get(route('threads.show', 'my-first-thread'))
        ->assertSuccessful()
        ->assertSeeLivewire(ThreadShow::class);
});

test('a single thread is displayed', function () {
    $thread = Thread::factory()->create(['title' => 'My First Thread']);

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('My First Thread');
});

test('an admin can see the actions dropdown of any thread', function () {
    $user = User::factory()->admin()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('Edit')
        ->assertSee('Delete');
});

test('a user can see the actions dropdown of a thread they own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('Edit')
        ->assertSee('Delete');
});

test('a user cannot see the actions dropdown of a thread they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertDontSee('Edit')
        ->assertDontSee('Delete');
});

test('a guest cannot see the actions dropdown of any thread', function () {
    $thread = Thread::factory()->create();

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->assertDontSee('Edit')
        ->assertDontSee('Delete');
});

test('a user can delete they own thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create(['user_id' => $user->id]);

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('delete')
        ->assertRedirect(route('threads.index'));

    $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
});

test('an admin can delete any thread', function () {
    $user = User::factory()->admin()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('delete')
        ->assertRedirect(route('threads.index'));

    $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
});

test('a user cannot delete a thread they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('delete')
        ->assertForbidden();

    $this->assertDatabaseHas('threads', ['id' => $thread->id]);
});

test('a guest cannot delete a thread', function () {
    $thread = Thread::factory()->create();

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->call('delete')
        ->assertForbidden();

    $this->assertDatabaseHas('threads', ['id' => $thread->id]);
});
