<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        // Create likes for random threads
        $threads = Thread::all()->random(100);
        foreach ($threads as $thread) {
            Like::factory()
                ->count(rand(1, 10))
                ->for($thread, 'likeable')
                ->create();
        }

        // Create likes for random replies
        $replies = Reply::all()->random(200);
        foreach ($replies as $reply) {
            Like::factory()
                ->count(rand(1, 10))
                ->for($reply, 'likeable')
                ->create();
        }
    }
}
