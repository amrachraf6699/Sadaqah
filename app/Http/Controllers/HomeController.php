<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $campaigns = Campaign::where('user_id' , '!=' , auth()->id())->
            latest()->
            take(8)->
            with('user')
            ->get();
        return view('welcome', compact('campaigns'));
    }
}
