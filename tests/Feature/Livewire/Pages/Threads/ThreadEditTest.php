<?php

use App\Livewire\Pages\Threads\ThreadEdit;
use App\Models\category;
use App\Models\Thread;
use App\Models\User;
use Livewire\Livewire;

test('edit thread page is not displayed for guests', function () {
    $thread = Thread::factory()->create();

    $this->get(route('threads.edit', $thread->id))
        ->assertRedirect('/login');
});

test('users cannot edit a thread they do not own', function () {
    $user = User::factory()->create();
    $thread = Thread::factory()->create();

    Livewire::actingAs($user)
        ->test(ThreadEdit::class, ['thread' => $thread])
        ->assertForbidden();
});

test('users can edit their own threads', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $thread = Thread::factory()->create([
        'user_id' => $user->id,
        'title' => 'Old title',
        'body' => 'Old body',
    ]);

    Livewire::actingAs($user)
        ->test(ThreadEdit::class, ['thread' => $thread])
        ->set('form.title', 'New title')
        ->set('form.body', 'New body')
        ->set('form.category_id', $category->id)
        ->call('save')
        ->assertRedirect(route('threads.show', $thread->id));

    $thread->refresh();

    $this->assertSame('New title', $thread->title);
    $this->assertSame('New body', $thread->body);
    $this->assertSame($category->id, $thread->category_id);
});

test('admin can edit any thread', function () {
    $admin = User::factory()->admin()->create();
    $category = Category::factory()->create();
    $thread = Thread::factory()->create([
        'title' => 'Old title',
        'body' => 'Old body',
    ]);

    Livewire::actingAs($admin)
        ->test(ThreadEdit::class, ['thread' => $thread])
        ->set('form.title', 'New title')
        ->set('form.body', 'New body')
        ->set('form.category_id', $category->id)
        ->call('save')
        ->assertRedirect(route('threads.show', $thread->id));

    $thread->refresh();

    $this->assertSame('New title', $thread->title);
    $this->assertSame('New body', $thread->body);
    $this->assertSame($category->id, $thread->category_id);
});
