<?php

namespace App\Events;

use App\Models\chat_group;
use App\Models\chat_private;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class chat_user implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $message, $user;
    /**
     * Create a new event instance.
     */
    public function __construct(chat_private $message,  $user)

    {
        $this->message = $message;
        $this->user = $user;
         
    }


    public function broadcastOn(): array
{
    return [
        new Channel('chat_private')
    ];
}
}
