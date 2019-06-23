<?php

namespace App\Listeners\Profile;

use Auth;
use App\Models\Menu;
use App\Models\Order;

class LoadProfileDataListener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        $money_spend = Menu::moneySpend(Auth::user()->id);

        $order_count = Auth::user()->orders->count();
        
        $this_month  = Order::currentMonth(Auth::user()->id);
        
        return [
            'user'        => Auth::user(),
            'money_spend' => $money_spend,
            'order_count' => $order_count,
            'this_month'  => $this_month
        ];
    }
}
