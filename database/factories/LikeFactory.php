<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
        ];
    }

    public function reply(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'likeable_id' => Reply::factory(),
                'likeable_type' => 'App\Models\Reply',
            ];
        });
    }

    public function thread(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'likeable_id' => Thread::factory(),
                'likeable_type' => 'App\Models\Thread',
            ];
        });
    }
}
