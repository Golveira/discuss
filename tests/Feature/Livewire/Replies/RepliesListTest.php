<?php

use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Replies\RepliesList;
use App\Models\Reply;

test('thread replies are displayed', function () {
    $thread = Thread::factory()->create();
    Reply::factory()->create(['thread_id' => $thread->id, 'body' => 'First reply']);
    Reply::factory()->create(['thread_id' => $thread->id, 'body' => 'Second reply']);

    Livewire::test(RepliesList::class, ['thread' => $thread->fresh()])
        ->assertSee('Replies (2)')
        ->assertSee('First reply')
        ->assertSee('Second reply');
});
