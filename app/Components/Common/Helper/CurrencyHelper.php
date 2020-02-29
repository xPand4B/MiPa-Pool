<?php

namespace App\Components\Common\Helper;

use App\Components\Order\Database\Order;

// TODO: Re-work
class CurrencyHelper
{
    /**
     * Formats currency to a more readable format.
     *
     * @param Order $order
     *
     * @return Order
     */
    public static function formatPriceForOrder(Order $order): Order
    {
        for($j = 0; $j < sizeof($order->menus); $j++)
        {
            $price = $order->menus[$j]->price;
            $order->menus[$j]->price = self::Format($price);
        }

        return $order;
    }

    /**
     * Return a sum based on all menus for specified order.
     *
     * @param Order $order
     *
     * @return Order
     */
    public static function getSum(Order $order): Order
    {
        $sum = 0;

        for($i = 0; $i < sizeof($order->menus); $i++)
            $sum += $order->menus[$i]->price * 0.01;

        $order->sum = self::Format($sum, false);

        return $order;
    }

    /**
     * Return a formated value based in the input.
     *
     * @param $value
     * @param bool $convert
     *
     * @return string|string[]|null
     */
    public static function Format($value, bool $convert = true)
    {
        if(! isset($value))
            return null;

        if($convert)
            $value *= 0.01;

        if($value < 10)
            $value = '0'.$value;

        if(strlen($value) == 4)
            $value = $value.'0';

        if(strlen($value) == 2)
            $value = $value.'.00';

        return str_replace('.', ',', $value);
    }
}
