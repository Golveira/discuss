<?php

use App\Models\Like;
use App\Models\Reply;
use App\Models\Thread;
use Livewire\Livewire;
use App\Livewire\Pages\Threads\ThreadIndex;

test('threads are displayed', function () {
    $firstThread = Thread::factory()->create();
    $secondThread = Thread::factory()->create();

    Livewire::test(ThreadIndex::class)
        ->assertSee($firstThread->title)
        ->assertSee($secondThread->title);
});

test('threads can be sorted by latest activity', function () {
    $notRecentThread = Thread::factory()->create(['updated_at' => now()->subDays(2)]);
    $recentThread = Thread::factory()->create(['updated_at' => now()->subDays(1)]);

    Livewire::test(ThreadIndex::class)
        ->set('sort', 'latest_activity')
        ->assertSeeInOrder([
            $recentThread->title,
            $notRecentThread->title
        ]);
});

test('threads can be sorted by creation date in desc order', function () {
    $oldThread = Thread::factory()->create(['created_at' => now()->subDays(2)]);
    $newThread = Thread::factory()->create(['created_at' => now()->subDays(1)]);

    Livewire::test(ThreadIndex::class)
        ->set('sort', 'date_created')
        ->assertSeeInOrder([
            $newThread->title,
            $oldThread->title
        ]);
});

test('threads can be sorted by top in the past day', function () {
    $mostPopularToday = Thread::factory()
        ->hasReplies(2)
        ->hasLikes(1)
        ->create();

    $secondMostPopularToday =  Thread::factory()
        ->hasReplies(1)
        ->hasLikes(1)
        ->create();

    $mostPopularYesterday = Thread::factory()
        ->hasReplies(2)
        ->hasLikes(1)
        ->create(['created_at' => now()->subHours(25)]);

    Livewire::test(ThreadIndex::class)
        ->set('sort', 'top_day')
        ->assertSeeInOrder([
            $mostPopularToday->title,
            $secondMostPopularToday->title,
        ])
        ->assertDontSee($mostPopularYesterday->title);
});

test('threads can be sorted by top in the past week', function () {
    $mostPopularThisWeek = Thread::factory()
        ->hasReplies(2)
        ->hasLikes(1)
        ->create(['created_at' => now()->subDays(5)]);

    $secondMostPopularThisWeek =  Thread::factory()
        ->hasReplies(1)
        ->hasLikes(1)
        ->create(['created_at' => now()->subDays(4)]);

    $mostPopularLastWeek = Thread::factory()
        ->hasReplies(2)
        ->hasLikes(1)
        ->create(['created_at' => now()->subDays(8)]);

    Livewire::test(ThreadIndex::class)
        ->set('sort', 'top_week')
        ->assertSeeInOrder([
            $mostPopularThisWeek->title,
            $secondMostPopularThisWeek->title,
        ])
        ->assertDontSee($mostPopularLastWeek->title);
});

test('threads can be sorted by top in the past month', function () {
    $mostPopularThisMonth = Thread::factory()
        ->hasReplies(2)
        ->hasLikes(1)
        ->create(['created_at' => now()->subDays(29)]);

    $secondMostPopularThisMonth =  Thread::factory()
        ->hasReplies(1)
        ->hasLikes(1)
        ->create(['created_at' => now()->subDays(28)]);

    $mostPopularLastMonth = Thread::factory()
        ->hasReplies(2)
        ->hasLikes(1)
        ->create(['created_at' => now()->subDays(32)]);

    Livewire::test(ThreadIndex::class)
        ->set('sort', 'top_month')
        ->assertSeeInOrder([
            $mostPopularThisMonth->title,
            $secondMostPopularThisMonth->title,
        ])
        ->assertDontSee($mostPopularLastMonth->title);
});

test('threads can be sorted by top in the past year', function () {
    $mostPopularThisYear = Thread::factory()
        ->hasReplies(2)
        ->hasLikes(1)
        ->create(['created_at' => now()->subMonths(11)]);

    $secondMostPopularThisYear =  Thread::factory()
        ->hasReplies(1)
        ->hasLikes(1)
        ->create(['created_at' => now()->subMonths(10)]);

    $mostPopularLastYear = Thread::factory()
        ->hasReplies(2)
        ->hasLikes(1)
        ->create(['created_at' => now()->subMonths(13)]);

    Livewire::test(ThreadIndex::class)
        ->set('sort', 'top_year')
        ->assertSeeInOrder([
            $mostPopularThisYear->title,
            $secondMostPopularThisYear->title,
        ])
        ->assertDontSee($mostPopularLastYear->title);
});

test('threads can be sorted by top all time', function () {
    $mostPopularToday = Thread::factory()
        ->hasReplies(3)
        ->hasLikes(0)
        ->create();

    $mostPopularThisWeek = Thread::factory()
        ->hasReplies(3)
        ->hasLikes(1)
        ->create(['created_at' => now()->subDays(6)]);

    $MostPopularThisMonth =  Thread::factory()
        ->hasReplies(4)
        ->hasLikes(0)
        ->create(['created_at' => now()->subDays(30)]);

    $mostPopularThisYear = Thread::factory()
        ->hasReplies(4)
        ->hasLikes(1)
        ->create(['created_at' => now()->subMonths(11)]);

    Livewire::test(ThreadIndex::class)
        ->set('sort', 'top_all')
        ->assertSeeInOrder([
            $mostPopularThisYear->title,
            $MostPopularThisMonth->title,
            $mostPopularThisWeek->title,
            $mostPopularToday->title,
        ]);
});

test('threads can be searched', function () {
    Thread::factory()->create([
        'title' => 'First thread title',
        'body' => 'First thread body'
    ]);

    Thread::factory()->create([
        'title' => 'Second thread title is short',
        'body' => 'The second thread body'
    ]);

    Thread::factory()->create([
        'title' => 'Third thread title',
        'body' => 'Third thread body is short'
    ]);

    Livewire::test(ThreadIndex::class)
        ->set('query', 'short')
        ->assertSee('Second thread title is short')
        ->assertSee('Third thread title');
});
