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
        for($j = 0; $j < sizeof($order->menus); $j++)
        {
            $price = $order->menus[$j]->price * 0.01;
            $order->menus[$j]->price = self::Format((string)$price);
        }

        return $order;
    }

    /**
     * Return a sum based on all menus for specified order.
     *
     * @param \App\Models\Order $order
     *
     * @return \App\Models\Order
     */
    public static function getSum(Order $order): Order
    {
        $sum = 0;

        for($i = 0; $i < sizeof($order->menus); $i++)
            $sum += $order->menus[$i]->price * 0.01;

        $order->sum = self::Format((string)$sum);

        return $order;
    }

    /**
     * Return a formated value based in the input.
     *
     * @param string $value
     *
     * @return string|null
     */
    private static function Format(string $value): ?string
    {
        if(! isset($value))
            return null;

        if($value < 10)
        $value = '0'.$value;
    
        if(strlen($value) == 4)
            $value = $value.'0';

        if(strlen($value) == 2)
            $value = $value.'.00';

        return str_replace('.', ',', $value);
    }
}
