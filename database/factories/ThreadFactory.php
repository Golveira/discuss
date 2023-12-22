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
            'slug' => Str::slug($title),
            'body' => fake()->paragraph(),
        ];
    }

    public function hasRandomTimeStamps($startDate = '-1 month', $endDate = 'now'): static
    {
        $createdAt = fake()->dateTimeBetween($startDate, $endDate);

        return $this->state([
            'created_at' => $createdAt,
            'updated_at' => fake()->dateTimeBetween($createdAt, $endDate),
        ]);
    }

    public function hasExistingChannel(): static
    {
        $channel = Channel::inRandomOrder()->first();

        return $this->state([
            'channel_id' => $channel->id,
        ]);
    }

    public function withRandomReplies(): self
    {
        return $this->afterCreating(function (Thread $thread) {
            Reply::factory()
                ->count(rand(0, 10))
                ->for($thread)
                ->create();
        });
    }

    public function withRandomLikes($count = 10): self
    {
        return $this->afterCreating(function (Thread $thread) {
            Like::factory()
                ->count(rand(0, 10))
                ->for($thread, 'likeable')
                ->create();
        });
    }
}
