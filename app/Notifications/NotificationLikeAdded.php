<?php

namespace App\Notifications;

use App\Models\Like;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NotificationLikeAdded extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Like $like)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id'=> $this->like->user_id,
            'like_id'=> $this->like->id,
            'post_id'=> $this->like->post_id,
            'userName'=> $this->like->user->userName,
            
        ];
    }
}
