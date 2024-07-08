<?php

namespace App\Notifications;

use App\Mail\ReceiveDonationMail;
use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReceiveDonationNotification extends Notification
{
    use Queueable;

    public $campaign;
    public $user;
    public $amount;
    public $note;

    /**
     * Create a new notification instance.
     */
    public function __construct(Campaign $campaign, $user, $amount, $note)
    {
        $this->campaign = $campaign;
        $this->user = $user;
        $this->amount = $amount;
        $this->note = $note;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('You got a new donation for '. $this->campaign->title .' !')
        ->view('emails.receivedonation', [
            'campaign' => $this->campaign,
            'user' => $this->user,
            'amount' => $this->amount,
            'note' => $this->note
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'You have received a new donation of $' . $this->amount . ' for the campaign ' . $this->campaign->title,
            'details' => 'You got a new donation from ' . $this->user->name . ' for the campaign ' . $this->campaign->title . ' of $' . $this->amount . '.Please check your email for more details.'
        ];
    }
}
