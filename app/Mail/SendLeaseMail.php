<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLeaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $pdf)
    {
        $this->pdf = $pdf;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        return $this->subject('Tenancy Agreement')
            ->markdown('emails.tenancy')->attachData(base64_decode($this->pdf), 'Tenancy-AGreement.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
