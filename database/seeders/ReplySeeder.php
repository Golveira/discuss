<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $threads = Thread::all()->random(100);

        foreach ($threads as $thread) {
            Reply::factory()
                ->count(rand(1, 10))
                ->for($thread, 'thread')
                ->state(new Sequence(function () use ($users) {
                    return [
                        'user_id' =>  $users->random()->id,
                        'created_at' => fake()->dateTimeBetween('-2 days', 'now'),
                    ];
                }))
                ->create();
        }

        foreach ($threads->random(20) as $thread) {
            $reply = $thread->replies->random();

            $thread->markAsBestReply($reply);
        }
    }
}
