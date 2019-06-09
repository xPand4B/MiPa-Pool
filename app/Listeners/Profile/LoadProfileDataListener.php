<?php

namespace App\Listeners\Profile;

use App\Order;
use App\Menu;
use Auth;

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

        $money_spend *= 0.01;

        if($money_spend != '0'){
            if(strlen($money_spend) != 1){
                
                if($money_spend < 10)
                    $money_spend = '0'.$money_spend;
                
                if(strlen($money_spend) == 4)
                    $money_spend = $money_spend.'0';
            }
        }
        
        return [
            'user'        => Auth::user(),
            'money_spend' => $money_spend,
            'order_count' => $order_count,
            'this_month'  => $this_month
        ];
    }
}
