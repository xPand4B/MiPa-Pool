<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;

class OrderManagementResourceTest extends TestCase
{
    /** @test */
    public function index()
    {
        $user = $this->user();

        factory(Order::class, 3)->create(['user_id' => $this->user()->id]);
        factory(Order::class, 3)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('manage.orders.index'))
            ->assertStatus(200)
            ->assertViewIs('pages.manage.orders.index')
            ->assertViewHas('orders');

        $this->assertModelCount(2, 6, 0);
        $this->assertEquals(3, Order::FromUser($user->id)->count());
    }

    /** @test */
    public function UserHasOrders()
    {
        $this->actingAsUser()
            ->get(route('manage.orders.index'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        $this->assertModelCount(1, 0, 0);
    }
    
    /** @test */
    public function AuthRoutes()
    {
        factory(Order::class, 4)->create(['user_id' => $this->user()->id]);

        // Index
        $this->get(route('manage.orders.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertModelCount(1, 4, 0);
    }
}
