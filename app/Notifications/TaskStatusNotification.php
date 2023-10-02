<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user, $taskName;
    /**
     * Create a new notification instance.
     */
    public function __construct($user,$taskName)
    {
        $this->user= $user;
        $this->taskName = $taskName;
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
          ->greeting("Hello! $this->user")
                    ->line("Your task: $this->taskName has been reviewed!")
                    // ->action('Notification Action', url('/'))
                    ->line( 'You may have to make some changes');
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
