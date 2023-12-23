<?php

use App\Livewire\Threads\ThreadsShow;
use App\Models\Thread;
use Livewire\Livewire;

test('component renders on the page', function () {
    Thread::factory()->create(['slug' => 'my-first-thread']);

    $this->get("/discuss/my-first-thread")
        ->assertSuccessful()
        ->assertSeeLivewire(ThreadsShow::class);
});

test('a single thread is displayed', function () {
    $thread = Thread::factory()->create(['title' => 'My First Thread']);

    Livewire::test(ThreadsShow::class, ['thread' => $thread])
        ->assertSee('My First Thread');
});
