<?php

namespace App\Notifications;

use App\Mail\CustomResetPasswordMail;
use App\Services\ZohoMailService;
use Illuminate\Notifications\Notification;

class CustomResetPassword extends Notification {

    public $token;

    public function __construct($token) {
        $this->token = $token;
    }

    public function via($notifiable) {
        return ['mail'];
    }

    public function toMail($notifiable) {
        $zoho = app(ZohoMailService::class);
        $mailable = new CustomResetPasswordMail($this->token, $notifiable->getEmailForPasswordReset());
        try {
            $zoho->sendMailable($notifiable->getEmailForPasswordReset(), $mailable);
        } catch (\Exception $e) {
            \Log::error('Failed to send password reset email: ' . $e->getMessage());
            throw $e; // Or handle gracefully
        }

        // Return null or a minimal response since the email is sent via ZohoMailService
        return null;
    }
}
