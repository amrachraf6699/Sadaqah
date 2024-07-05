<?php

namespace App\Http\Controllers;

use App\Jobs\DonationJob;
use App\Models\Campaign;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CampaignsController extends Controller
{

    public function index()
    {
        $campaigns = Campaign::where('user_id', '!=', auth()->id())
        ->with('user')
        ->paginate(8);

        return view('campaigns.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        $campaign->load('user');
        $topContributors = $campaign->donations()->orderByDesc('amount')->take(4)->get();
        return view('campaigns.show', compact('campaign','topContributors'));
    }

}
