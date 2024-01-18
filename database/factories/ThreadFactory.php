<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use App\Models\Like;
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
            'body' => fake()->paragraph(),
            'is_closed' => false,
            'is_pinned' => false,
        ];
    }

    public function closed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_closed' => true,
            ];
        });
    }

    public function pinned(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_pinned' => true,
            ];
        });
    }
}
