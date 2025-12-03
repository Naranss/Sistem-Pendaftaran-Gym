<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(ChatMessage $message)
    {
        $this->message = $message->load('sender');
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.room.' . $this->message->chat_room_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'chat_room_id' => $this->message->chat_room_id,
            'sender_id' => (string)$this->message->sender_id,
            'sender_name' => $this->message->sender->nama,
            'message' => $this->message->message,
<<<<<<< HEAD
            'created_at' => $this->message->created_at->format('H:i d-m-Y H:i'),
=======
            'created_at' => $this->message->created_at->format('H:i d-m-Y'),
>>>>>>> cc2d019606d1050d7861c7be7080f0d40cddc1c9
        ];
    }
}
