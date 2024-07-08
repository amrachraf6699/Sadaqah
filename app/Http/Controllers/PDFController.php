<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $amount = $request->query('amount');
        $campaign = Campaign::with([
            'user',
            'donations' => function($query) {
                $query->where('user_id', auth()->id())
                    ->latest()
                    ->limit(1);
            }
        ])->findOrFail($request->query('campaign'));

        if ($campaign->donations->isEmpty()) {
            return redirect()->route('home')->withErrors('Failed to download PDF');
        }

        $pdf = Pdf::loadView(request()->routeIs('user.download.invoice') ?
            'pdf.invoice' : 'pdf.thanks'
            , compact('campaign','amount'));

        return $pdf->download(request()->routeIs('user.download.invoice') ?
            'Sadaqah - Invoice '.now()->format('Y-m-d h:i').'.pdf'
            :$campaign->user->name.' - Thanks '.now()->format('Y-m-d h:i').'.pdf');

        return redirect()->route('campaigns.index',[
            'success' => 'PDF Downloaded Successfully!'
        ]);
    }
}
