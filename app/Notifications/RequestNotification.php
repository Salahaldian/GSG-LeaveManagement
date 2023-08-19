<?php

namespace App\Notifications;

use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestNotification extends Notification
{
    use Queueable;

    public $userId;

    /**
     * Create a new notification instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $user = User::query()
            ->where('type', '=', 'admin')
            ->first();
        $leaveRequest =LeaveRequest::query()
            ->where('user_id', '=', $this->userId)
            ->latest('id')
            ->first();

        return (new MailMessage)
            ->subject('Leave Request Notification')
            ->greeting('Hello ' . $user->name . ',')
            ->line('We hope this email finds you well.')
            ->line('We would like to inform you regarding the status of your recent leave request.')
            ->line('Leave Request Details:')
            ->line('Leave Type: ' . $leaveRequest->type)
            ->line('Reason: ' . $leaveRequest->reason)
            ->line('Status: ' . ucfirst($leaveRequest->status))
            ->line('We appreciate your understanding and cooperation during this process.')
            ->line('Thank you for being a valued member of our organization.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
