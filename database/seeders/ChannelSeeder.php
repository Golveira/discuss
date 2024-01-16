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
            ['name' => 'Announcements', 'slug' => 'announcements', 'emoji' =>  '📢', 'description' => 'Important announcements from the team.'],
            ['name' => 'General', 'slug' => 'general', 'emoji' =>  '💬', 'description' => "Chat that doesn't fit anywhere else"],
            ['name' => 'Help', 'slug' => 'help', 'emoji' =>  '🙏', 'description' => 'Get help from the community.'],
            ['name' => 'Ideas', 'slug' => 'ideas', 'emoji' =>  '💡', 'description' => 'Share ideas for new features'],
            ['name' => 'Showcase', 'slug' => 'showcase', 'emoji' =>  '🙌', 'description' => "Show off something you've made"],
        ];

        foreach ($channels as $channel) {
            Channel::create($channel);
        }
    }
}
