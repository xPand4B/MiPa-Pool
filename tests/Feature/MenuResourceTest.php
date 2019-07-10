<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\Order;

class MenuResourceTest extends TestCase
{
    /** @test */
    public function create()
    {
        $this->user();
        $order = factory(Order::class)->create($this->validOrderParams());

        $this->actingAsUser()
            ->get(route('menu.create', $order))
            ->assertStatus(200)
            ->assertViewIs('pages.menu.create')
            ->assertViewHas([
                'order'
            ]);

        $this->assertModelCount(2, 1, 0);
    }

    /** @test */
    public function store()
    {
        $user   = $this->user();
        $order  = factory(Order::class)->create($this->validOrderParams(['user_id'  => $user->id]));
        $params = $this->validMenuParams([
            'user_id'  => $user->id,
            'order_id' => $order->id,
        ]);

        $this->actingAs($user)
            ->post(route('menu.store', $params))
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
    public function MenuExists()
    {
        $order = factory(Order::class)->create(['user_id' => $this->user()]);
        factory(Menu::class)->create([
            'user_id'   => $this->user(),
            'order_id'  => $order->id,
        ]);

        // Update
        $this->actingAsUser()
            ->patch(route('menu.update', 2), $this->validMenuParams())
            ->assertStatus(404);

        // Destroy
        $this->actingAsUser()
            ->delete(route('menu.destroy', 2))
            ->assertStatus(404);

        $this->assertModelCount(4, 1, 1);
    }

    /** @test */
    public function MenuFromUser()
    {
        $user   = $this->user();
        $order  = factory(Order::class)->create($this->validOrderParams(['user_id' => $user->id]));

        $params = $this->validMenuParams([
            'user_id'   => $user->id,
            'order_id'  => $order->id
        ]);

        $menu = factory(Menu::class)->create($params);
        
        // Update
        $this->actingAsUser()
            ->patch(route('menu.update', $menu), $params)
            ->assertStatus(404);

        // Destroy
        $this->actingAsUser()
            ->delete(route('menu.destroy', 1))
            ->assertStatus(302)
            ->assertRedirect(route('manage.menus.index'));

        $this->assertModelCount(3, 1, 1);
    }

    /** @test */
    public function AuthRoutes()
    {
        $user   = $this->user();
        $order  = factory(Order::class)->create($this->validOrderParams(['user_id' => $user->id]));

        $params = $this->validMenuParams([
            'user_id'   => $user->id,
            'order_id'  => $order->id
        ]);

        // Create
        $this->get(route('menu.create', $order))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Store
        $this->post(route('menu.store', $params))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Update
        $this->patch(route('menu.update', $params))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Destroy
        $this->delete(route('menu.destroy', 1))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertModelCount(1, 1, 0);
    }
}
