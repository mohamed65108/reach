<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdsRemainders extends Mailable
{
    use Queueable, SerializesModels;

    protected $advertiser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($advertiser)
    {
        $this->advertiser = $advertiser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.adsRemainders')
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject("Ads Remainder Notification")
            ->with('advertiser', $this->advertiser);
    }
}
