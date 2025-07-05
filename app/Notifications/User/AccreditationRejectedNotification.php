<?php

namespace App\Notifications\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccreditationRejectedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The user instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        // Get the admin comment from the user's data
        $userData = $notifiable->userData;
        $comment = $userData ? $userData->admin_comment : 'Please update your accreditation information and try again.';

        return (new MailMessage)
            ->subject('Accreditation Needs Attention')
            ->greeting('Hello ' . $this->user->name . ',')
            ->line('Your accreditation submission requires updates before it can be approved.')
            ->line('Administrator comment:')
            ->line($comment)
            ->action('Update Accreditation', url('/user/accreditation'))
            ->line('Please make the necessary changes and resubmit your information.')
            ->line('If you have any questions, please contact our support team.');
    }
}
