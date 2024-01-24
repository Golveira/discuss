<?php

use App\Models\User;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Pages\Threads\ThreadShow;

test('thread is displayed', function () {
    $thread = Thread::factory()->create();

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->assertSee($thread->title)
        ->assertSee($thread->body);
});

test('users can delete they own threads', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->for($user, 'author')->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('delete')
        ->assertRedirect(route('threads.index'));

    $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
});

test('admins can delete any thread', function () {
    $user = User::factory()->admin()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('delete')
        ->assertRedirect(route('threads.index'));

    $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
});

test('users cannot delete a thread they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('delete')
        ->assertForbidden();

    $this->assertDatabaseHas('threads', ['id' => $thread->id]);
});

test('guests cannot delete a thread', function () {
    $thread = Thread::factory()->create();

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->call('delete')
        ->assertForbidden();

    $this->assertDatabaseHas('threads', ['id' => $thread->id]);
});

test('a user can subscribe to a thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('Subscribe')
        ->call('subscribe')
        ->assertSee('Unsubscribe');

    $this->assertTrue($thread->hasSubscriber($user));
});

test('a user can unsubscribe from a thread', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    $thread->subscribe($user);

    Livewire::actingAs($user)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('Unsubscribe')
        ->call('unsubscribe')
        ->assertSee('Subscribe');

    $this->assertFalse($thread->hasSubscriber($user));
});

test('a guest cannot subscribe to a thread', function () {
    $thread = Thread::factory()->create();

    Livewire::test(ThreadShow::class, ['thread' => $thread])
        ->assertDontSee('Subscribe')
        ->assertDontSee('Unsubscribe');
});

test('admins can pin a thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($admin)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->assertSee('Pin thread')
        ->call('pinThread')
        ->assertSee('Unpin thread');

    $this->assertTrue($thread->fresh()->isPinned());
});

test('admins can unpin a thread', function () {
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

test('admins can close a thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($admin)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('closeThread');

    $this->assertTrue($thread->fresh()->isClosed());
});

test('admins can open a thread', function () {
    $admin = User::factory()->admin()->create();
    $thread = Thread::factory()->closed()->create();

    Livewire::actingAs($admin)
        ->test(ThreadShow::class, ['thread' => $thread])
        ->call('openThread');

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
