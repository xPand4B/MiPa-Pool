<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\Order;

class OrderResourceTest extends TestCase
{
    /** @test */
    public function index()
    {
        $orders = 10;
        $menusPerOrder  = 5;

        $user = $this->user();
        
        for($i = 0; $i < $orders; $i++)
        {
            $order = factory(Order::class)->create([
                'user_id'   => $user->id,
                'name'      => 'Test Bestellung',
            ]);

            for($j = 0; $j < $menusPerOrder; $j++)
            {
                factory(Menu::class)->create([
                    'user_id'   => $user->id,
                    'order_id'  => $order->id,
                ]);
            }
        }

        $this->actingAsUser()
            ->get(route('home'))
            ->assertStatus(200)
            ->assertViewIs('pages.orders.index')
            ->assertViewHasAll([
                'orders'
            ]);

        $this->assertModelCount(2, $orders, $orders * $menusPerOrder);
    }
    
    /** @test */
    public function create()
    {
        $this->withoutExceptionHandling();

        $this->actingAsUser()
            ->get(route('orders.create'))
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertViewIs('pages.orders.create')
            ->assertViewHasAll([
                'timesteps'
            ]);

        $this->assertModelCount(1, 0, 0);
    }

    /** @test */
    public function store()
    {
        $user   = $this->user();
        $params = $this->validOrderParams(['user_id' => $user->id]);

        $this->actingAs($user)
            ->post(route('orders.store', $params))
            ->assertStatus(302)
            ->assertRedirect(route('participate.create', 1))
            ->assertSessionHas('success');

        $this->assertEquals($params['user_id'], Order::first()->user_id);

        $this->assertModelCount(1, 1, 0);
    }

    /** @test */
    public function AuthRoutes()
    {
        $params = $this->validOrderParams();

        // Index - Home
        $this->get(route(('home')))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Create
        $this->get(route('orders.create'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Store
        $this->post(route('orders.store', $params))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertModelCount(0, 0, 0);
    }
}
