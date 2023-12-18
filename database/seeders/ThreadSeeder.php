<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $channelIds = Channel::pluck('id');
        $users = User::all();

        foreach ($users as $user) {
            Thread::factory()
                ->count(2)
                ->create([
                    'user_id' => $user->id,
                    'channel_id' => $channelIds->random(),
                ]);
        }
    }
}
