<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\LikeSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ReplySeeder;
use Database\Seeders\ThreadSeeder;
use Database\Seeders\ChannelSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ChannelSeeder::class,
            UserSeeder::class,
            ThreadSeeder::class,
            ReplySeeder::class,
            LikeSeeder::class,
        ]);
    }
}
