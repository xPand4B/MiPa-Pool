<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\Order;

class ParticipateResourceTest extends TestCase
{
    /** @test */
    public function create()
    {
        $this->user();
        $order = factory(Order::class)->create($this->validOrderParams());

        $this->actingAsUser()
            ->get(route('participate.create', $order))
            ->assertStatus(200)
            ->assertViewIs('pages.participate.create')
            ->assertViewHas([
                'order'
            ]);

        $this->assertModelCount(2, 1, 0);
    }

    /** @test */
    public function store()
    {
        $this->withoutExceptionHandling();

        $user   = $this->user();
        $order  = factory(Order::class)->create($this->validOrderParams(['user_id'  => $user->id]));
        $params = $this->validMenuParams([
            'user_id'  => $user->id,
            'order_id' => $order->id,
        ]);

        $this->actingAs($user)
            ->post(route('participate.store', $params))
            ->assertStatus(302)
            ->assertRedirect(route('home'))
            ->assertSessionHas('success');

        $this->assertEquals($params['user_id'],     Menu::first()->user_id);
        $this->assertEquals($params['order_id'],    Menu::first()->order_id);
        $this->assertEquals($params['name'],        Menu::first()->name);
        $this->assertEquals($params['number'],      Menu::first()->number);
        $this->assertEquals($params['comment'],     Menu::first()->comment);
        $this->assertEquals($params['price'] * 100, Menu::first()->price);
        
        $this->assertModelCount(1, 1, 1);
    }

    /** @test */
    public function AuthRoutes()
    {
        $this->user();
        $order  = factory(Order::class)->create($this->validOrderParams());
        $params = $this->validMenuParams();

        // Create
        $this->get(route('participate.create', $order))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Store
        $this->post(route('participate.store', $params))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertModelCount(1, 1, 0);
    }
}
