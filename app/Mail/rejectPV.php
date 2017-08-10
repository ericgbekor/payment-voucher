<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class rejectPV extends Mailable
{
    use Queueable, SerializesModels;


    public $rejects;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rejects)
    {
        $this->rejects=$rejects;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Vouchers Rejected')
                    ->view('mail.reject');
    }
}
