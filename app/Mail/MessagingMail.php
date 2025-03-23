<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessagingMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $param1;
    protected $param2;

    public function __construct($param1, $param2)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
    }

    public function build()
    {
        return $this->view('emails.message')
            ->with([
                'param1' => $this->param1,
                'param2' => $this->param2,
            ]);

    }
}
