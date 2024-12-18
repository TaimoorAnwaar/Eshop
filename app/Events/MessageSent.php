<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return [
            new Channel('chat.' . $this->message->receiver_id), // User channel
            new Channel('chat.manager.' . $this->message->receiver_id), // Manager channel
            'count' => Message::where('receiver_id', $this->message->receiver_id)->count(),

        ];
    }
    

    public function broadcastAs()
    {
        return 'message.sent';
    }
}


