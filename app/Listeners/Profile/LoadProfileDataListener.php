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
        $money_spend = Menu::where('user_id', '=', Auth::user()->id)->sum('price');
        $money_spend *= 0.01;

        if($money_spend != '0'){
            if(strlen($money_spend) != 1){
                
                if($money_spend < 10)
                    $money_spend = '0'.$money_spend;
                
                if(strlen($money_spend) == 4)
                    $money_spend = $money_spend.'0';
            }
        }

        $order_count = Auth::user()->orders->count();

        $this_month  = Order::where('user_id', '=', Auth::user()->id)
                            ->whereMonth('created_at', date('m'))
                            ->count();
        
        return [
            'user'        => Auth::user(),
            'money_spend' => $money_spend,
            'order_count' => $order_count,
            'this_month'  => $this_month
        ];
    }
}
