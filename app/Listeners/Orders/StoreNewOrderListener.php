<?php

namespace App\Listeners\Orders;

use Carbon\Carbon;
use App\Models\Order;
use App\Events\SendFlashMessageEvent;
use App\Events\Orders\NewOrderCreationEvent;

class StoreNewOrderListener
{
    /**
     * Handle the event.
     *
     * @param  NewOrderCreationEvent  $event
     * 
     * @return void
     */
    public function handle(NewOrderCreationEvent $event)
    {
        $request = $event->request;

        $data = $request->validated();
        
        $data['user_id']  = $request->user()->id;
        $data['deadline'] = Carbon::createFromTimeString($request->deadline);

        $order = Order::create($data);

        event(new SendFlashMessageEvent('success', trans('session.order.created')));

        return $order;
    }
}
