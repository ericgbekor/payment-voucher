<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class approvePV extends Mailable
{
    use Queueable, SerializesModels;

    public $approve;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($approve)
    {
        $this->approve = $approve;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Vouchers Submitted for Approval')
                    ->view('mail.approve');
    }
}
