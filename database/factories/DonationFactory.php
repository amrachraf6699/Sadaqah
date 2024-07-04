<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'campaign_id' => $this->faker->numberBetween(1, 100),
            'payment_method_id' => $this->faker->numberBetween(1, 3),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'message' => null,
        ];
    }

    public function withMessage()
    {
        return $this->state(function (array $attributes) {
            return [
                'message' => $this->faker->sentence,
            ];
        });
    }
}
