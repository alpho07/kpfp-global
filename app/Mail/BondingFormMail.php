<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BondingFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->view('emails.bonding')
            ->attach(public_path('kpfp_gertrudes_bonding_application_forms_and_award_letter.zip'), [
                'as' => 'KPFP Scholarship award letter with Bonding and Application Forms',
                'mime' => 'application/zip',
            ]);
    }
}
