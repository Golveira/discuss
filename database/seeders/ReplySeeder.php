<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ReplySeeder extends Seeder
{
    public function run(): void
    {
        $threads = Thread::all()->random(100);

        // Create replies for random threads
        foreach ($threads as $thread) {
            Reply::factory()
                ->count(rand(1, 20))
                ->for($thread, 'thread')
                ->state(new Sequence(function () {
                    return ['user_id' => User::inRandomOrder()->first()];
                }))
                ->create();
        }

        // Give random threads a best reply
        foreach ($threads->random(20) as $thread) {
            $reply = $thread->replies->random();

            $thread->markAsBestReply($reply);
        }

        $replies = Reply::all()->random(100);

        // Create nested replies for random replies
        foreach ($replies as $reply) {
            Reply::factory()
                ->count(rand(1, 5))
                ->state(new Sequence(function () {
                    return ['user_id' => User::inRandomOrder()->first()];
                }))
                ->create([
                    'parent_id' => $reply->id,
                    'thread_id' => $reply->thread_id,
                ]);
        }
    }
}
