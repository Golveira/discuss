<?php

use App\Models\User;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Threads\ThreadShow;

test('component is displayed on the page', function () {
    $thread = Thread::factory()->create();

    $this->get(route('threads.show', $thread->id))
        ->assertSuccessful()
        ->assertSeeLivewire(ThreadShow::class);
});

test('a single thread is displayed', function () {
    $thread = Thread::factory()->create();

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->assertSee($thread->title);
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

// test('a user can subscribe to a thread', function () {
//     $user = User::factory()->create();
//     $thread = Thread::factory()->create();

//     Livewire::actingAs($user)
//         ->test(ThreadShow::class, ['thread' => $thread])
//         ->assertSee('Subscribe')
//         ->call('subscribe')
//         ->assertSee('Unsubscribe');

//     $this->assertTrue($thread->hasSubscriber($user));
// });

// test('a user can unsubscribe from a thread', function () {
//     $user = User::factory()->create();
//     $thread = Thread::factory()->create();

//     $thread->subscribe($user);

//     Livewire::actingAs($user)
//         ->test(ThreadShow::class, ['thread' => $thread])
//         ->assertSee('Unsubscribe')
//         ->call('unsubscribe')
//         ->assertSee('Subscribe');

//     $this->assertFalse($thread->hasSubscriber($user));
// });

// test('a guest cannot subscribe to a thread', function () {
//     $thread = Thread::factory()->create();

//     Livewire::test(ThreadShow::class, ['thread' => $thread])
//         ->assertDontSee('Subscribe')
//         ->assertDontSee('Unsubscribe');
// });

test('admin can pin a thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($admin)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('Pin thread')
        ->call('pinThread')
        ->assertSee('Unpin thread');

    $this->assertTrue($thread->fresh()->isPinned());
});

test('admin can unpin a thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->pinned()->create();

    Livewire::actingAs($admin)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('Unpin thread')
        ->call('unpinThread')
        ->assertSee('Pin thread');

    $this->assertFalse($thread->fresh()->isPinned());
});

test('users cannot pin a thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('pinThread')
        ->assertForbidden();
});

test('guests cannot pin a thread', function () {
    $thread = Thread::factory()->create();

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->call('pinThread')
        ->assertForbidden();
});

test('admin can close a thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($admin)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('Close thread')
        ->call('closeThread')
        ->assertSee('Open thread');

    $this->assertTrue($thread->fresh()->isClosed());
});

test('admin can open a thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->closed()->create();

    Livewire::actingAs($admin)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('Open thread')
        ->call('openThread')
        ->assertSee('Close thread');

    $this->assertFalse($thread->fresh()->isClosed());
});

test('users cannot close a thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('closeThread')
        ->assertForbidden();
});

test('guests cannot close a thread', function () {
    $thread = Thread::factory()->create();

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->call('closeThread')
        ->assertForbidden();
});
