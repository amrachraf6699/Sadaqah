<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThankYouController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $campaign = $request->query('campaign');
        $amount = $request->query('amount');
        
        return view('thank-you', compact('campaign', 'amount'));
    }
}
