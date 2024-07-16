<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
            'user_id' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'image' => 'default.jpg',
            'goal_amount' => $this->faker->randomFloat(2, 100, 1000),
            'current_amount' => 0,
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function withAmount()
    {
        return $this->state(function (array $attributes){
            return [
                'current_amount' => rand(1, 1000),
            ];
        });
    }
}
