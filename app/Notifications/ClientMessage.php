<?php

namespace App\Notifications;

use App\Models\Client;
use App\Models\Complaint;
use App\Models\LiveMessage;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClientMessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private LiveMessage $liveMessage)
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Hi')
                    ->line('New message from: '.$this->liveMessage->user->name)
                    ->line('client phone: '.$this->liveMessage->user->phone)
                    ->line('message title')
                    ->line($this->liveMessage->title)
                    ->line('message content')
                    ->line($this->liveMessage->content);
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
