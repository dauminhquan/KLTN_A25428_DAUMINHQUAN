<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GetTokenResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $email;
    private $token;
    private $timeLimit;
    public function __construct($email,$token,$timeLimit)
    {
        $this->email = $email;
        $this->token = $token;
        $this->timeLimit = $timeLimit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Token reset password')->view('auth.sendTokenEmail',['token' => $this->token,'email' => $this->email,'timeLimit' => $this->timeLimit]);
    }
}
