<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(5)->create();
        User::factory()->count(25)->withBalance()->create();
        User::factory()->count(3)->admin()->create();
        Campaign::factory()->count(25)->create();
        Campaign::factory()->count(75)->withAmount()->create();
        PaymentMethod::factory()->Stripe()->create();
        PaymentMethod::factory()->Paypal()->create();
        PaymentMethod::factory()->EWallet()->create();
        Donation::factory()->count(100)->create();
        Donation::factory()->count(400)->withMessage()->create();
        Withdraw::factory()->count(100)->create();
    }
}
