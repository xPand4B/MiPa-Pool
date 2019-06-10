<?php

namespace App\Helper;

use App\Order;

class Currency
{
    /**
     * Formats currency to a more readable format.
     *
     * @param \App\Order $order
     *
     * @return \App\Order
     */
    public static function format(Order $order): Order
    {
        $sum = 0;

        for($j = 0; $j < sizeof($order->menus); $j++){
            $price = $order->menus[$j]->price * 0.01;
            $sum  += $price;

            if($price < 10)
                $price = '0'.$price;
            
            if(strlen($price) == 4)
                $price = $price.'0';

            if(strlen($price) == 2)
                $price = $price.'.00';

            $order->menus[$j]->price = str_replace('.', ',', $price);
            // $order->menus[$j]->price = $price;
        }

        if($sum < 10)
            $sum = '0'.$sum;
        
        if(strlen($sum) == 4){
            $sum = $sum.'0';

        }else if(strlen($sum) == 2){
            $sum = $sum.'.00';
        }

        $order->sum = str_replace('.', ',', $sum);
        // $order->sum = $sum;

        return $order;
    }
}
