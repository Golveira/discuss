<?php

use App\Livewire\Threads\ThreadShow;
use App\Models\Thread;
use Livewire\Livewire;

test('thread show page is displayed', function () {
    Thread::factory()->create(['title' => 'My First Thread']);

    $this->get("/discuss/my-first-thread")
        ->assertSuccessful()
        ->assertSeeLivewire(ThreadShow::class);
});

test('a single thread is displayed', function () {
    $thread = Thread::factory()->create(['title' => 'My First Thread']);

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('My First Thread');
});
