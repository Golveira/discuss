<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id');
        $threads = Thread::all()->random(100);

        foreach ($threads as $thread) {
            Reply::factory()
                ->count(5)
                ->create([
                    'user_id' => $userIds->random(),
                    'thread_id' => $thread->id,
                ]);
        }
    }
}
