<?php

namespace App\Listeners\Orders;

use App\Events\Orders\NewOrderHasCreatedEvent;
use App\Events\SendFlashMessageEvent;
use Carbon\Carbon;
use App\Order;

class StoreNewOrderListener
{
    /**
     * Handle the event.
     *
     * @param  NewOrderHasCreatedEvent  $event
     * @return void
     */
    public function handle(NewOrderHasCreatedEvent $event)
    {
        $request = $event->request;

        $request->validated();

        $order = Order::create([
            'user_id'           => $request->user()->id,
            'name'              => $request->order_name,
            'site_link'         => $request->site_link,
            'deadline'          => Carbon::createFromTimeString($request->deadline),
            'delivery_service'  => $request->delivery_service,
            'max_orders'        => $request->max_orders
        ]);

        event(new SendFlashMessageEvent('success', trans('session.order.created')));

        return $order->id;
    }
}
