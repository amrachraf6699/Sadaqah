<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonateRequest;
use App\Models\Campaign;
use App\Services\StripeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function donate(DonateRequest $request)
    {
        $campaign = Campaign::findOrFail($request->campaign_id);

        $checkoutUrl = $this->stripeService->createCheckoutSession($campaign, $request->amount, $request->message ?? null);

        return redirect($checkoutUrl, 303);
    }


    public function handleStripeSuccess(Request $request)
    {
        return $this->stripeService->handleSuccess($request->query('session_id'));
    }

    public function handleCancel()
    {
        return view('cancel');
    }

}
