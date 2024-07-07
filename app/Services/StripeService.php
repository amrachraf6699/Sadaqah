<?php

namespace App\Services;

use App\Jobs\DonationJob;
use App\Models\Campaign;
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
            'success_url' => route('user.stripe.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('user.payment.cancel'),
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

            $campaign  = Campaign::findOrFail($session->metadata->campaign_id);

            // session()->put('amount', $session->amount_total / 100);
            // session()->put('campaign', $campaign);

            return redirect(route('thank-you',['campaign' => $campaign, 'amount' => $session->amount_total / 100]));

        } catch (\Exception $e) {
            return redirect('/')->withErrors('An error occurred: ' . $e->getMessage());
        }
    }
}
