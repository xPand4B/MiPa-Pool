<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;

class OrderTest extends TestCase
{
    /** @test */
    public function an_order_can_be_created()
    {
        factory(Order::class, 1)->create($this->validOrderParams());

        $this->assertCount(1, Order::all());
    }

    /** @test */
    public function everything_is_required()
    {
        foreach($this->validOrderParams() as $param)
        {
            $this->expectException(\Exception::class);
    
            factory(Order::class)->create($this->validOrderParams([$param => null]));
        }
    }

    /** @test */
    public function all_open_orders_can_be_get()
    {
        factory(Order::class, 3)->create($this->validOrderParams(['closed' => 1]));
        factory(Order::class, 1)->create($this->validOrderParams(['name'   => 'Open Order']));

        $this->assertCount(4, Order::all());

        $this->assertCount(1, Order::Open()->get());
        $this->assertCount(3, Order::Closed()->get());

        foreach(Order::Open()->get() as $order)
            $this->assertEquals('Open Order', $order->name);
    }

    /** @test */
    public function all_closed_orders_can_be_get()
    {
        factory(Order::class, 3)->create($this->validOrderParams());

        factory(Order::class, 1)->create($this->validOrderParams([
            'name'   => 'Closed Order',
            'closed' => 1
        ]));

        $this->assertCount(4, Order::all());

        $this->assertCount(3, Order::Open()->get());
        $this->assertCount(1, Order::Closed()->get());

        foreach(Order::Closed()->get() as $order)
            $this->assertEquals('Closed Order', $order->name);
    }

    /** @test */
    public function all_order_from_logged_in_user_can_be_get()
    {
        $user1 = $this->user();
        $user2 = $this->user();

        $testOrders = [
            factory(Order::class)->create(['user_id' => $user1->id]),
            factory(Order::class)->create(['user_id' => $user1->id]),
            factory(Order::class)->create(['user_id' => $user1->id]),
        ];

        factory(Order::class, 3)->create(['user_id' => $user2->id]);

        $orders = Order::FromUser($user1->id);

        $this->assertCount( 6, Order::all());
        $this->assertEquals(3, Order::FromUser($user1->id)->count());
        $this->assertEquals(3, Order::FromUser($user2->id)->count());

        $count = 1;
        foreach($orders as $order){
            $this->assertEquals($testOrders[$count], $order);
            $count++;
        }
    }

    /** @test */
    public function all_orders_from_current_month_can_be_get()
    {
        $user = $this->user();

        factory(Order::class, 1)->create($this->validOrderParams(['user_id' => $user->id]));

        $this->assertCount(1, Order::all());

        $this->assertEquals(1, Order::currentMonth($user->id));
    }
}
