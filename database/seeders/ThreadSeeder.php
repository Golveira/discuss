<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    public function run(): void
    {
        // Create 2 threads for each user
        $users = User::all();
        foreach ($users as $user) {
            Thread::factory()
                ->count(2)
                ->for($user, 'author')
                ->state(new Sequence(function () {
                    return [
                        'category_id' => Category::inRandomOrder()->first(),
                        'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                    ];
                }))
                ->create();
        }

        // Pin 4 random threads
        $threads = Thread::all()->random(4);
        foreach ($threads as $thread) {
            $thread->pin();
        }

        // Close 10 random threads
        $threads = Thread::all()->random(10);
        foreach ($threads as $thread) {
            $thread->close();
        }
    }
}
