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
            ->assertRedirect(route('menu.create', 1))
            ->assertSessionHas('success');

        $this->assertEquals($params['user_id'], Order::first()->user_id);

        $this->assertModelCount(1, 1, 0);
    }

    /** @test */
    public function close()
    {
        $user  = $this->user();
        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('orders.close', $order))
            ->assertStatus(302)
            ->assertRedirect(route('manage.orders.index'))
            ->assertSessionHas('success');

        $order = $order->refresh();

        $this->assertEquals(1, Order::first()->closed);

        $this->assertModelCount(1, 1, 0);
    }

    /** @test */
    public function destroy()
    {
        $user  = $this->user();
        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->delete(route('orders.destroy', $order))
            ->assertStatus(302)
            ->assertRedirect(route('manage.orders.index'))
            ->assertSessionHas('success');

        $this->assertModelCount(1, 0, 0);
    }

    /** @test */
    public function OrderExists()
    {
        // $this->user();
        factory(Order::class)->create(['user_id' => $this->user()]);

        // Update
        $this->actingAsUser()
            ->patch(route('orders.update', 2), $this->validOrderParams())
            ->assertStatus(404);

        // Close
        $this->actingAsUser()
            ->get(route('orders.close', 2))
            ->assertStatus(404);

        // Destroy
        $this->actingAsUser()
            ->delete(route('orders.destroy', 2))
            ->assertStatus(404);
        
        $this->assertModelCount(4, 1, 0);
    }

    /** @test */
    public function OrderFromUser()
    {
        $order = factory(Order::class)->create(['user_id' => $this->user()]);

        // Update
        $this->actingAsUser()
            ->patch(route('orders.update', $order), $this->validOrderParams())
            ->assertStatus(404);

        // Close
        $this->actingAsUser()
            ->get(route('orders.close', $order))
            ->assertStatus(302)
            ->assertRedirect(route('manage.orders.index'));

        // Destroy
        $this->actingAsUser()
            ->delete(route('orders.destroy', $order))
            ->assertStatus(302)
            ->assertRedirect(route('manage.orders.index'));
        
        $this->assertModelCount(4, 1, 0);
    }

    /** @test */
    public function AuthRoutes()
    {
        $params = $this->validOrderParams();
        $order  = factory(Order::class)->create($params);

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

        // Update
        $this->patch(route('orders.update', $params))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Close
        $this->get(route('orders.close', $order))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Destroy
        $this->delete(route('orders.destroy', 1))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertModelCount(0, 1, 0);
    }
}
