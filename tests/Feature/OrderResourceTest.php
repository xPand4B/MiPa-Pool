<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\Order;

class OrderResourceTest extends TestCase
{
    /** @test */
    public function all_orders_can_be_displayed()
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
            ->get('/')
            ->assertStatus(200)
            ->assertViewIs('pages.orders.index');

        $this->assertCount($orders,                     Order::all());
        $this->assertCount($orders * $menusPerOrder,    Menu::all());
    }

    /** @test */
    public function only_logged_in_users_can_see_all_orders()
    {
        $this->get('/')
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
    
    /** @test */
    public function the_create_form_can_be_visited_by_a_logged_in_users()
    {
        $this->actingAsUser()
            ->get('/order/create')
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertViewIs('pages.orders.create');
    }

    /** @test */
    public function only_logged_in_users_can_visit_create_form()
    {
        $this->get('/order/create')
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_order_can_be_created_by_a_logged_in_user()
    {
        $user   = $this->user();
        $params = $this->validOrderParams(['user_id' => $user->id]);

        $this->actingAs($user)
            ->post('/order/store', $params)
            ->assertStatus(302)
            ->assertRedirect(route('participate.create', 1))
            ->assertSessionHas('success');

        $this->assertCount(1, Order::all());

        $this->assertEquals($params['user_id'], Order::first()->user_id);
    }

    /** @test */
    public function only_logged_in_users_can_create_orders()
    {
        $params = $this->validOrderParams();

        $this->post('/order/store', $params)
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertCount(0, Order::all());
    }
}
