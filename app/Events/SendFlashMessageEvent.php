<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SendFlashMessageEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var String
     */
    public $type;

    /**
     * @var String
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $type, string $message)
    {
        $this->type    = $type;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
