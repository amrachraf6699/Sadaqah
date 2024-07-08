<?php

namespace App\Jobs;

use App\Mail\DonationMail;
use App\Models\Campaign;
use App\Models\Donation;
use App\Notifications\DonationNotification;
use App\Notifications\ReceiveDonationNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\DB;

class DonationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $campaign;
    public $session;
    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct(Session $session, $user)
    {
        $this->campaign = Campaign::find($session->metadata->campaign_id);
        $this->session = $session;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $amount = $this->session->amount_total / 100;

        $message = $this->session->metadata->message ?? null;

        DB::beginTransaction();

        try {
            $this->campaign->increment('current_amount', $amount);

            $this->campaign->user->increment('balance', $amount);

            Donation::create([
                'user_id' => $this->user->id,
                'campaign_id' => $this->campaign->id,
                'amount' => $amount,
                'message' => $message,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            throw $e;
        }

        $this->campaign->user->notify(new ReceiveDonationNotification($this->campaign, $this->user, $amount , $message));

        $this->user->notify(new DonationNotification($this->campaign, $this->user, $amount));

    }
}
