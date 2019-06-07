<?php

namespace App\Listeners\Orders;

use App\Events\Orders\NewMenuHasBeenCreatedEvent;
use App\Events\SendFlashMessageEvent;
use App\Menu;

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

        $request->validated();

        $price = str_replace(',', '.', $request->price);

        if(!is_numeric($price)){
            event(new SendFlashMessageEvent('error', trans('session.order.price_is_no_digit')));
            return redirect()->back();
        }

        Menu::create([
            'user_id'   => $request->user()->id,
            'order_id'  => $request->order_id,
            'menu'      => $request->name,
            'number'    => $request->number,
            'comment'   => $request->comment,
            'price'     => $price * 100
        ]);

        event(new SendFlashMessageEvent('success', trans('session.order.participated')));
    }
}
