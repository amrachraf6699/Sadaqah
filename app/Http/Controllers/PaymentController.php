<?php

namespace App\Http\Controllers;

use App\Jobs\DonationJob;
use App\Models\Campaign;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{


    protected $StripeService;

    public function __construct(StripeService $StripeService)
    {
        $this->StripeService = $StripeService;
    }


    public function donate(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:10',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'campaign_id' => 'required|exists:campaigns,id',
            'message' => 'nullable|string'
        ]);


        $campaign = Campaign::findOrFail($data['campaign_id']);

        if ($data['payment_method_id'] == 1) {
            return $this->Stripe($data, $campaign);
        } elseif ($data['payment_method_id'] == 2) {
            return $this->Paypal();
        } else { // E-Wallet
            dd('E-Wallet');
        }
    }

    public function Stripe($data, Campaign $campaign)
    {
        $amount = $data['amount'];
        $message = $data['message'] ?? '';

        $checkoutUrl = $this->StripeService->createCheckoutSession($campaign, $amount, $message);

        return redirect($checkoutUrl, 303);

    }

    public function Paypal()
    {
        dd('Paypal');
    }



    //Handling Methods
    public function handleStripeSuccess(Request $request)
    {
        return $this->StripeService->handleSuccess($request->query('session_id'));
    }

    
    public function handleCancel()
    {
        return view('cancel');
    }

}
