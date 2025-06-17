<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProofOfPaymentMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $user;
    public $course;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user) {
        $this->user = $user->first_name;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('KPFP Application Proof of payment Status')
                        ->view('emails.proof_of_payment')
                        ->with([
                            'user' => $this->user,
                          
        ]);
    }
}
