<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class MentionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $message;
    private $sender;
    private $url;

    public function __construct($message, $sender, $url)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => [
                'id' => $this->message->id,
                'content' => $this->message->message,
                'created_at' => $this->message->created_at
            ],
            'sender' => [
                'id' => $this->sender->id,
                'name' => $this->sender->name,
                'avatar' => $this->sender->avatar
            ],
            'url' => $this->url
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notification_id' => $this->id,
            'type' => 'mention',
            'message' => [
                'id' => $this->message->id,
                'content' => $this->message->message,
                'created_at' => $this->message->created_at->toDateTimeString()
            ],
            'sender' => [
                'id' => $this->sender->id,
                'name' => $this->sender->name,
                'avatar' => $this->sender->avatar
            ],
            'url' => $this->url
        ]);
    }
}