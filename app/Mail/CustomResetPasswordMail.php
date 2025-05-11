<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $resetUrl;
    public $expireMinutes;

    /**
     * Create a new message instance.
     *
     * @param string $token
     * @param string $email
     * @return void
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
        $this->resetUrl = url(route('password.reset', ['token' => $this->token, 'email' => $this->email], false));
        $this->expireMinutes = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Your Password')
                    ->view('emails.password_reset')
                    ->with([
                        'resetUrl' => $this->resetUrl,
                        'expireMinutes' => $this->expireMinutes,
                    ]);
    }
}