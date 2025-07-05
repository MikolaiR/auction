<?php

namespace App\Notifications\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccreditationApprovedNotification extends Notification implements ShouldQueue
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
        return (new MailMessage)
            ->subject('Accreditation Approved')
            ->greeting('Hello ' . $this->user->name . '!')
            ->line('Great news! Your account accreditation has been approved.')
            ->line('You now have full access to all platform features.')
            ->action('Go to My Account', url('/user/profile'))
            ->line('Thank you for using our platform!');
    }
}
