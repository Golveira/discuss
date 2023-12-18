<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $channels = [
            ['name' => 'Announcements', 'slug' => 'announcements'],
            ['name' => 'General', 'slug' => 'general'],
            ['name' => 'Help', 'slug' => 'help'],
            ['name' => 'Showcase', 'slug' => 'showcase'],
            ['name' => 'Feedback', 'slug' => 'feedback'],
        ];

        foreach ($channels as $channel) {
            Channel::create($channel);
        }
    }
}
