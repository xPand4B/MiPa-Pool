<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\Order;
use App\Helper\Currency;

class CurrencyHelperTest extends TestCase
{
    /** @test */
    public function get_formated_price_from_order()
    {
        $order = factory(Order::class)->create($this->validOrderParams());

        factory(Menu::class)->create($this->validMenuParams([
            'order_id'  => $order->id,
            'price'     => 590
        ]));

        factory(Menu::class)->create($this->validMenuParams([
            'order_id'  => $order->id,
            'price'     => 1
        ]));

        factory(Menu::class)->create($this->validMenuParams([
            'order_id'  => $order->id,
            'price'     => 1500
        ]));

        $this->assertCount(1, Order::all());
        $this->assertCount(3, Menu::all());

        $order = Currency::formatPriceForOrder($order);

        $this->assertEquals('05,90', $order->menus[0]->price);
        $this->assertEquals('00,01', $order->menus[1]->price);
        $this->assertEquals('15,00', $order->menus[2]->price);
    }
    
    /** @test */
    public function get_sum_from_order()
    {
        $order = factory(Order::class)->create($this->validOrderParams());

        factory(Menu::class)->create($this->validMenuParams([
            'order_id'  => $order->id,
            'price'     => 590
        ]));
        
        factory(Menu::class)->create($this->validMenuParams([
            'order_id'  => $order->id,
            'price'     => 1
        ]));

        factory(Menu::class)->create($this->validMenuParams([
            'order_id'  => $order->id,
            'price'     => 1500
        ]));

        $this->assertCount(1, Order::all());
        $this->assertCount(3, Menu::all());

        $this->assertEquals("20,91", Currency::getSum($order)->sum);
    }

    /** @test */
    public function value_can_be_formated()
    {
        $this->assertEquals(
            "14,98", Currency::Format(1498)
        );

        $this->assertEquals(
            "14,98", Currency::Format(1498 * 0.01, false)
        );

        $this->assertEquals(
            "14980", Currency::Format(1498, false)
        );
    }
}
