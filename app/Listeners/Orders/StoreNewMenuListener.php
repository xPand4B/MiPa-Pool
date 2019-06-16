<?php

namespace App\Listeners\Orders;

use App\Models\Menu;
use App\Events\SendFlashMessageEvent;
use App\Events\Orders\NewMenuCreationEvent;

class StoreNewMenuListener
{
    /**
     * Handle the event.
     *
     * @param  NewMenuCreationEvent  $event
     * @return void
     */
    public function handle(NewMenuCreationEvent $event)
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
