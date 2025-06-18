<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Applications;

class ProofOfPaymentUploadNotification extends Notification
{
    protected $application;

    public function __construct(Applications $application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['database']; // You can add 'mail' or 'broadcast' if needed
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new proof of payment has been uploaded',
            'applicant_name' => $this->application->user->name ?? 'Unknown',
            'application_id' => $this->application->id,
            'url' => route('admin.enrollments.index'),
        ];
    }
}
