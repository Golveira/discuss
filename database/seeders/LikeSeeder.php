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
        $threads = Thread::all()->random(100);
        $replies = Reply::all()->random(200);

        // Create likes for random threads
        foreach ($threads as $thread) {
            Like::factory()
                ->count(rand(1, 10))
                ->for($thread, 'likeable')
                ->create();
        }

        // Create likes for random replies
        foreach ($replies as $reply) {
            Like::factory()
                ->count(rand(1, 10))
                ->for($reply, 'likeable')
                ->create();
        }
    }
}
