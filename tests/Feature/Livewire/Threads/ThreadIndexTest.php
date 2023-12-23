<?php

use App\Models\Like;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;
use App\Models\Channel;
use App\Livewire\Threads\ThreadIndex;

test('threads page is displayed', function () {
    $this->get(route('threads.index'))
        ->assertSuccessful()
        ->assertSeeLivewire(ThreadIndex::class);
});

test('threads are displayed', function () {
    Thread::factory()->create(['title' => 'First Thread']);
    Thread::factory()->create(['title' => 'Second Thread']);

    Livewire::test(ThreadIndex::class)
        ->assertSee('First Thread')
        ->assertSee('Second Thread');
});

test('threads can be sorted by recent activity', function () {
    Thread::factory()
        ->create([
            'title' => 'Recent Active Thread',
            'updated_at' => now()->subDays(1)
        ]);

    Thread::factory()
        ->create([
            'title' => 'Not Recent Active Thread',
            'updated_at' => now()->subDays(2)
        ]);

    Livewire::test(ThreadIndex::class)
        ->set('filter', 'recent')
        ->assertSeeInOrder([
            'Recent Active Thread',
            'Not Recent Active Thread',
        ]);
});

test('threads can be sorted by all time popularity', function () {
    Thread::factory()
        ->has(Reply::factory(3))
        ->has(Like::factory(3))
        ->create(['title' => 'Most Popular Thread']);

    Thread::factory()
        ->has(Reply::factory(3))
        ->has(Like::factory(2))
        ->create(['title' => 'Most Replies Thread']);

    Thread::factory()
        ->has(Reply::factory(2))
        ->has(Like::factory(3))
        ->create(['title' => 'Most Likes Thread']);

    Thread::factory()
        ->has(Reply::factory(2))
        ->has(Like::factory(2))
        ->create([
            'title' => 'Most Recent Thread',
            'updated_at' => now()->subDays(1)
        ]);

    Thread::factory()
        ->has(Reply::factory(2))
        ->has(Like::factory(2))
        ->create([
            'title' => 'Older Thread',
            'updated_at' => now()->subDays(2)
        ]);

    Livewire::test(ThreadIndex::class)
        ->set('filter', 'popular_all')
        ->assertSeeInOrder([
            'Most Popular Thread',
            'Most Replies Thread',
            'Most Likes Thread',
            'Most Recent Thread',
            'Older Thread',
        ]);
});

test('threads can be filtered by weekly popularity', function () {
    Thread::factory()
        ->has(Reply::factory(3))
        ->has(Like::factory(3))
        ->create([
            'title' => 'Old Popular Thread',
            'created_at' => now()->subDays(8)
        ]);

    Thread::factory()
        ->has(Reply::factory(3))
        ->has(Like::factory(2))
        ->create([
            'title' => 'New Popular Thread',
            'created_at' => now()->subDays(6)
        ]);

    Livewire::test(ThreadIndex::class)
        ->set('filter', 'popular_week')
        ->assertSee('New Popular Thread')
        ->assertDontSee('Old Popular Thread');
});

test('threads can be filtered by resolved', function () {
    Thread::factory()
        ->has(Reply::factory()->count(1))
        ->create([
            'title' => 'Resolved Thread',
            'best_reply_id' => Reply::factory()->create()->id,
        ]);

    Thread::factory()
        ->has(Reply::factory()->count(3))
        ->create([
            'title' => 'Unresolved Thread',
            'best_reply_id' => null,
        ]);

    Livewire::test(ThreadIndex::class)
        ->set('filter', 'resolved')
        ->assertSee('Resolved Thread')
        ->assertDontSee('Unresolved Thread');
});


test('threads can be filtered by unresolved', function () {
    Thread::factory()
        ->has(Reply::factory()->count(1))
        ->create([
            'title' => 'Resolved Thread',
            'best_reply_id' => Reply::factory()->create()->id,
        ]);

    Thread::factory()
        ->has(Reply::factory()->count(3))
        ->create([
            'title' => 'Unresolved Thread',
            'best_reply_id' => null,
        ]);

    Livewire::test(ThreadIndex::class)
        ->set('filter', 'unresolved')
        ->assertSee('Unresolved Thread')
        ->assertDontSee('Resolved Thread');
});

test('threads can be filtered by channel', function () {
    $generalChannel = Channel::factory()->create(['name' => 'General']);
    $helpChannel = Channel::factory()->create(['name' => 'Help']);

    Thread::factory()
        ->create([
            'title' => 'General Thread',
            'channel_id' => $generalChannel->id,
        ]);

    Thread::factory()
        ->create([
            'title' => 'Help Thread',
            'channel_id' => $helpChannel->id,
        ]);

    Livewire::test(ThreadIndex::class, ['channel' => $generalChannel])
        ->assertSee('General Thread')
        ->assertDontSee('Help Thread');
});

test('threads can be searched', function () {
    Thread::factory()->create([
        'title' => 'The first thread',
        'body' => 'The first thread body'
    ]);

    Thread::factory()->create([
        'title' => 'The second thread is cool',
        'body' => 'The second thread body'
    ]);

    Thread::factory()->create([
        'title' => 'The third thread',
        'body' => 'The third thread body is cool'
    ]);

    Livewire::test(ThreadIndex::class)
        ->set('query', 'cool')
        ->assertSee('The second thread is cool')
        ->assertSee('The third thread');
});
