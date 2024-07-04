<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }


    public function Stripe()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Stripe',
            ];
        });
    }

    public function Paypal()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Paypal',
            ];
        });
    }

    public function EWallet()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'E-Wallet',
            ];
        });
    }
}
