<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Order;

class OrderTest extends TestCase
{
    /** @test */
    public function an_order_can_be_created()
    {
        factory(Order::class, 1)->create($this->validParams());

        $this->assertCount(1, Order::all());
    }

    /** @test */
    public function everything_is_required()
    {
        foreach($this->validParams() as $param)
        {
            $this->expectException(\Exception::class);
    
            factory(Order::class)->create($this->validParams([$param => null]));
        }
    }

    /** @test */
    public function all_open_orders_can_be_get()
    {
        factory(Order::class, 3)->create($this->validParams(['closed' => 1]));
        factory(Order::class, 1)->create($this->validParams(['name'   => 'Open Order']));

        $this->assertCount(4, Order::all());

        $this->assertCount(1, Order::Open()->get());
        $this->assertCount(3, Order::Closed()->get());

        foreach(Order::Open()->get() as $order)
            $this->assertEquals('Open Order', $order->name);
    }

    /** @test */
    public function all_closed_orders_can_be_get()
    {
        factory(Order::class, 3)->create($this->validParams());

        factory(Order::class, 1)->create($this->validParams([
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
    public function all_orders_from_current_month_can_be_get()
    {
        $user = $this->user();

        factory(Order::class, 1)->create($this->validParams(['user_id' => $user->id]));

        $this->assertCount(1, Order::all());

        $this->assertEquals(1, Order::currentMonth($user->id));
    }

    /**
     * Provides an array with valid data.
     *
     * @param array $overrides
     *
     * @return array
     */
    private function validParams(array $overrides = []): array
    {
        return array_merge([
            'user_id'           => 1,
            'name'              => 'Test Order',
            'delivery_service'  => 'Delivery Service',
            'site_link'         => 'https://xpand4b.de',
            'deadline'          => Carbon::now()->format('Y-m-d H:i'),
            'minimum_value'     => rand(0, 20),
            'max_orders'        => rand(2, 20),
            'closed'            => 0,
        ], $overrides);
    }
}
