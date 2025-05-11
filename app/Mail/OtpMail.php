<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $user;
    public $otp;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $otp) {
        $this->user = $user->first_name;
        $this->otp = $otp;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('KPFP Sholarship Portal Registration')
                        ->view('emails.otp')
                        ->with([
                            'user' => $this->user,
                            'otp' => $this->otp
                           
        ]);
    }
}
