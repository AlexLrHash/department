<?php

namespace App\Jobs;

use App\Mail\VerifyUserEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $verificationToken;

    protected $userEmail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($verificationToken, $userEmail)
    {
        $this->verificationToken = $verificationToken;
        $this->userEmail = $userEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->userEmail)->send(new VerifyUserEmail($this->verificationToken));
    }
}
