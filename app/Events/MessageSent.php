<?php
namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageData;

    public function __construct(ChatMessage $message)
    {
        // Sadece gerekli verileri primitive tiplerle gönderelim
        $this->messageData = [
            'id' => $message->id,
            'message' => $message->message,
            'user_id' => $message->user_id,
            'user_name' => $message->user->name,
            'created_at' => $message->created_at->toDateTimeString()
        ];
    }

    public function broadcastOn()
    {
        return new Channel('chat');
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->messageData
        ];
    }
}