<?php

namespace App\Helper;

use App\Models\Order;

class Currency
{
    /**
     * Formats currency to a more readable format.
     *
     * @param \App\Models\Order $order
     *
     * @return \App\Models\Order
     */
    public static function formatPriceForOrder(Order $order): Order
    {
        for($j = 0; $j < sizeof($order->menus); $j++){
            $price = $order->menus[$j]->price * 0.01;

            if($price < 10)
                $price = '0'.$price;
            
            if(strlen($price) == 4)
                $price = $price.'0';

            if(strlen($price) == 2)
                $price = $price.'.00';

            $order->menus[$j]->price = str_replace('.', ',', $price);
            // $order->menus[$j]->price = $price;
        }

        return $order;
    }

    public static function getSum(Order $order): Order
    {
        $sum = 0;

        for($i = 0; $i < sizeof($order->menus); $i++)
            $sum += $order->menus[$i]->price * 0.01;

        if($sum < 10)
            $sum = '0'.$sum;
        
        if(strlen($sum) == 4){
            $sum = $sum.'0';

        }else if(strlen($sum) == 2){
            $sum = $sum.'.00';
        }

        $order->sum = str_replace('.', ',', $sum);

        return $order;
    }

    /**
     * Formats price for a single menu
     *
     * @param int $price
     *
     * @return int
     */
    public static function formatPriceForSingleMenu(int $price)
    {
        if(! isset($price))
            return;

        if($price < 10)
            $price = '0'.$price;
        
        if(strlen($price) == 4)
            $price = $price.'0';

        if(strlen($price) == 2)
            $price = $price.'.00';

        return str_replace('.', ',', $price);;
    }
}
