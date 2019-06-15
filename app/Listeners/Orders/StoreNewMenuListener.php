<?php

namespace App\Listeners\Orders;

use App\Events\Orders\NewMenuHasBeenCreatedEvent;
use App\Events\SendFlashMessageEvent;
use App\Models\Menu;

class StoreNewMenuListener
{
    /**
     * Handle the event.
     *
     * @param  NewMenuHasBeenCreatedEvent  $event
     * @return void
     */
    public function handle(NewMenuHasBeenCreatedEvent $event)
    {
        $request = $event->request;

        $data               = $request->validated();
        $data['user_id']    = $request->user()->id;
        $data['order_id']   = $request->order_id;
        
        $price = str_replace(',', '.', $request->price);

        if(!is_numeric($price)){
            event(new SendFlashMessageEvent('error', trans('session.order.price_is_no_digit')));
            return redirect()->back();
        }

        $data['price']      = $price * 100;

        Menu::create($data);

        event(new SendFlashMessageEvent('success', trans('session.order.participated')));
    }
}
