<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\NotifyUserCreated;

class WelcomeUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;

    public function __construct($user)
    {

        $this->user = $user;

    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new NotifyUserCreated($this->user);

        Mail::to($this->user->email)->send($email);

    }
}
