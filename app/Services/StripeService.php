<?php

namespace App\Services;

use App\Jobs\DonationJob;
use Stripe\StripeClient;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeService
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function createCheckoutSession($campaign, $amount, $message)
    {
        $session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Donate to ' . $campaign->title,
                        ],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/stripe/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('payment.cancel'),
            'metadata' => [
                'campaign_id' => $campaign->id,
                'message' => $message ?? '',
            ],
        ]);

        return $session->url;
    }

    public function handleSuccess($session_id)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {

            $session = Session::retrieve($session_id);

            if ($session->expired) {
                return redirect('/')->withErrors('The payment session has expired. Please try donating again.');
            }

            $user = auth()->user();

            DonationJob::dispatch($session, $user);

            return redirect(route('thank-you'));

        } catch (\Exception $e) {
            return redirect('/')->withErrors('An error occurred: ' . $e->getMessage());
        }
    }
}


// Stripe::setApiKey(config('services.stripe.secret'));

//             $session = Session::create([
//                 'payment_method_types' => ['card'],
//                 'line_items' => [
//                     [
//                         'price_data' => [
//                             'currency' => 'usd',
//                             'product_data' => [
//                                 'name' => 'Donate to ' . $campaign->title,
//                             ],
//                             'unit_amount' => $data['amount'] * 100,
//                         ],
//                         'quantity' => 1,
//                     ],
//                 ],
//                 'mode' => 'payment',
//                 'success_url' => 'http://localhost:8000/donate/success?session_id={CHECKOUT_SESSION_ID}',
//                 'cancel_url' => route('donate.cancel'),
//                 'metadata' => [
//                     'campaign_id' => $campaign->id,
//                     'message' => $data['message'] ?? '',
//                 ],
//             ]);

//             return redirect($session->url, 303);
