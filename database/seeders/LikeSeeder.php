<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $threads = Thread::all()->random(100);
        $replies = Reply::all()->random(200);

        foreach ($threads as $thread) {
            Like::factory()
                ->count(5)
                ->create([
                    'likeable_id' => $thread->id,
                    'likeable_type' => 'App\Models\Thread',
                ]);
        }

        foreach ($replies as $reply) {
            Like::factory()
                ->count(5)
                ->create([
                    'likeable_id' => $reply->id,
                    'likeable_type' => 'App\Models\Reply',
                ]);
        }
    }
}
