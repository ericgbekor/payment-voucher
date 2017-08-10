<?php

namespace App\Mail;

use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class reviewPV extends Mailable
{
    use Queueable, SerializesModels;


    public $reviews;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reviews)
    {
        $this->reviews = $reviews;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Vouchers Submitted for Review')
                    ->view('mail.review');
    }
}
