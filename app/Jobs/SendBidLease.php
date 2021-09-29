<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\SendLeaseMail;

class SendBidLease implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $pdf;
    public $user;

    public function __construct($user, $pdf)
    {

        $this->pdf = $pdf;
        $this->user = $user;
    }

    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $email = new SendLeaseMail($this->user, $this->pdf);

        Mail::to($this->user->email)->send($email);
    }
}
