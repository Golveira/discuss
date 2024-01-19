<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'best_reply_id' => null,
            'title' => fake()->sentence(),
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
