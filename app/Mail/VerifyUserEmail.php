<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $verifyToken;

    /**
     * Констроктор.
     *
     * @return void
     */
    public function __construct($verifyToken)
    {
        $this->verifyToken = $verifyToken;
    }

    /**
     * Создание сообщения.
     *
     * @return $this
     */
    public function build()
    {
        $verifyToken = $this->verifyToken;

        return $this->view('mail.verify_email', ['verify_token' => $verifyToken]);
    }
}
