<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationSuccessMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $user;
    public $course;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $course) {
        $this->user = $user->first_name;
        $this->courseName = $course->course->course_manager->name;
        $this->courseDuration = $course->course->course_manager->period->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('Welcome to KPFP - Application Received')
                        ->view('emails.successfull_application')
                        ->with([
                            'user' => $this->user,
                            'courseName' => $this->courseName,
                            'courseDuration' => $this->courseDuration,
        ]);
    }
}
