<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();

        return [
            'user_id' => User::factory(),
            'channel_id' => Channel::factory(),
            'best_reply_id' => null,
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => fake()->paragraph(),
        ];
    }
}
