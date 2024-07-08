<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Withdraw>
 */
class WithdrawFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 30),
            'payment_method_id' => rand(1, 3),
            'amount' => rand(100, 1000),
            'status' => $this->faker->randomElement(['pending', 'processing', 'paying','paid','regected']),
            'notes' => $this->faker->sentence,
        ];
    }
}
