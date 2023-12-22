<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()
            ->count(100)
            ->create()
            ->each(function (User $user) {
                Thread::factory()
                    ->count(2)
                    ->for($user, 'author')
                    ->state(new Sequence(function () {
                        return [
                            'channel_id' => Channel::inRandomOrder()->first(),
                            'created_at' => fake()->dateTimeBetween('-2 week', '-3 days'),
                            'updated_at' => fake()->dateTimeBetween('-3 days', 'now'),
                        ];
                    }))
                    ->create();
            });
    }
}
