<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class MentionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $message;
    public $sender;
    public $url;

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
            'id' => $this->id,
            'title' => is_string($this->sender->name) ? $this->sender->name . ' sizi bir mesajda etiketledi' : json_encode($this->sender->name) . ' sizi bir mesajda etiketledi',
            'message' => is_string($this->message->message) ? $this->message->message : json_encode($this->message->message),
            'url' => $this->url,
            'sender_id' => $this->sender->id,
            'sender_name' => $this->sender->name,
            'chat_message_id' => $this->message->id,
            'created_at' => now(),
            'read_at' => null
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notification_id' => $this->id,
            'type' => 'mention',
            'message' => [
                'id' => $this->message->id,
                'content' => is_string($this->message->message) ? $this->message->message : json_encode($this->message->message),
                'created_at' => $this->message->created_at->toDateTimeString()
            ],
            'sender' => [
                'id' => $this->sender->id,
                'name' => is_string($this->sender->name) ? $this->sender->name : json_encode($this->sender->name),
                'avatar' => $this->sender->avatar
            ],
            'read_at' => null
        ]);
    }
}