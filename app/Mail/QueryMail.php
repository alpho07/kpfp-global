<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueryMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $user;
    public $course;
    public $query;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $course, $query) {
        $this->user = $user->first_name;
        $this->courseName = $course->course->course_manager->name;
        $this->query = $query;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->subject('KPFP Sholarship Application Status')
                        ->view('emails.query_status')
                        ->with([
                            'user' => $this->user,
                            'courseName' => $this->courseName,
                            'query' => $this->query,
        ]);
    }
}
