<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    public function run(): void
    {
        // Create replies for random threads
        $threads = Thread::all()->random(100);
        foreach ($threads as $thread) {
            Reply::factory()
                ->count(rand(1, 20))
                ->for($thread, 'thread')
                ->state(new Sequence(function () {
                    return ['user_id' => User::inRandomOrder()->first()];
                }))
                ->create();

            $thread->participants()->each(fn ($user) => $thread->subscribe($user));
        }

        // Give random threads a best reply
        foreach ($threads->random(20) as $thread) {
            $reply = $thread->replies->random();

            $thread->markAsBestReply($reply);
        }

        // Create nested replies for random replies
        $replies = Reply::all()->random(100);
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
