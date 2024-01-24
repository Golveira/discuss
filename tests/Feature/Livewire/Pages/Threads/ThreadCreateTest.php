<?php

use App\Livewire\Pages\Threads\ThreadCreate;
use App\Models\Category;
use App\Models\User;
use Livewire\Livewire;

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
    $category = Category::factory()->create();

    Livewire::actingAs($user)->test(ThreadCreate::class)
        ->set('form.title', 'My First Thread')
        ->set('form.body', 'This is my first thread')
        ->set('form.category_id', $category->id)
        ->call('save');

    $this->assertDatabaseHas('threads', [
        'title' => 'My First Thread',
        'body' => 'This is my first thread',
        'category_id' => $category->id,
    ]);
});

test('a thread requires a title', function () {
    $user = User::factory()->create();
    $category = category::factory()->create();

    Livewire::actingAs($user)->test(ThreadCreate::class)
        ->set('form.title', '')
        ->set('form.body', 'This is my first thread')
        ->set('form.category_id', $category->id)
        ->call('save')
        ->assertHasErrors('form.title');
});

test('a thread requires a body', function () {
    $user = User::factory()->create();
    $category = category::factory()->create();

    Livewire::actingAs($user)->test(ThreadCreate::class)
        ->set('form.title', 'My First Thread')
        ->set('form.body', '')
        ->set('form.category_id', $category->id)
        ->call('save')
        ->assertHasErrors('form.body');
});

test('a thread requires a category', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)->test(ThreadCreate::class)
        ->set('form.title', 'My First Thread')
        ->set('form.body', 'This is my first thread')
        ->set('form.category_id', '')
        ->call('save')
        ->assertHasErrors('form.category_id');
});
