<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewReplyNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(public Reply $reply)
    {
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
            'message' => $this->message(),
            'avatar' => $this->reply->author->avatar_path,
            'placeholder' => $this->reply->author->username_initials,
            'link' => route('threads.show', $this->reply->thread),
        ];
    }

    private function message()
    {
        return $this->reply->author->username . ' replied to ' . $this->reply->thread->title;
    }
}
