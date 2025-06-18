<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Application;

class NewApplicationNotification extends Notification
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
            'message' => 'A new scholarship application has been submitted.',
            'applicant_name' => $this->application->user->name ?? 'Unknown',
            'application_id' => $this->application->id,
            'url' => route('admin.enrollments.index'),
        ];
    }
}
