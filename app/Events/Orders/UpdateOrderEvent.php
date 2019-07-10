<?php

namespace App\Events\Orders;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use App\Http\Requests\Orders\OrderRequest;
use Illuminate\Broadcasting\InteractsWithSockets;

class UpdateOrderEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var App\Http\Requests\Orders\OrderRequest
     */
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(OrderRequest $request)
    {
        $this->request = $request;
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