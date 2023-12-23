<?php

use Tests\TestCase;
use App\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

it('generates an unique slug after creation', function () {
    $threadOne = Thread::factory()->create(['title' => 'My First Thread']);
    $threadTwo = Thread::factory()->create(['title' => 'My First Thread']);

    expect($threadOne->slug)->toBe('my-first-thread');
    expect($threadTwo->slug)->toBe('my-first-thread-2');
});
