<?php

namespace App\Listeners\Orders;

use App\Models\Order;
use App\Events\SendFlashMessageEvent;
use App\Events\Orders\UpdateOrderEvent;

class UpdateOrderListener
{
    /**
     * Handle the event.
     *
     * @param  UpdateOrderEvent  $event
     * @return void
     */
    public function handle(UpdateOrderEvent $event)
    {
        $request = $event->request;

        $order          = Order::findOrFail($request->input("id"));
        $currentMenus   = $order->menus()->count();

        if($request->input("max_orders") < $currentMenus){
            return redirect()->back();
        }

        $order->update([
                "name"              => $request->input("name"),
                "max_orders"        => $request->input("max_orders"),
                "minimum_value"     => $request->input("minimum_value"),
                "delivery_service"  => $request->input("delivery_service"),
                "site_link"         => $request->input("site_link"),
        ]);
    }
}
