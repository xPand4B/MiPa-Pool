<?php

namespace App\Listeners\Menus;

use App\Models\Menu;
use App\Events\Menus\UpdateMenuEvent;
use App\Events\SendFlashMessageEvent;

class UpdateMenuListener
{
    /**
     * Handle the event.
     *
     * @param  UpdateMenuEvent  $event
     * @return void
     */
    public function handle(UpdateMenuEvent $event)
    {
        $request = $event->request;

        $price = str_replace(',', '.', $request->price);

        if(!is_numeric($price)){
            event(new SendFlashMessageEvent('error', trans('session.order.price_is_no_digit')));
            return redirect()->back();
        }

        Menu::findOrFail($request->input('id'))
            ->update([
                'name'      => $request->input('name'),
                'number'    => $request->input('number'),
                'price'     => $price * 100,
                'comment'   => $request->input('comment'),
        ]);
    }
}
