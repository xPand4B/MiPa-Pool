<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Menu;

class MenuManagementResourceTest extends TestCase
{
    /** @test */
    public function index()
    {
        $user = $this->user();

        $order = factory(Order::class)->create(['user_id' => $this->user()->id]);
        factory(Order::class, 3)->create(['user_id' => $this->user()->id]);
        factory(Menu::class, 3)->create([
            'user_id'   => $user->id,
            'order_id'  => $order->id
        ]);
        factory(Menu::class, 3)->create([
            'user_id'   => $this->user()->id,
            'order_id'  => $order->id
        ]);

        $this->actingAs($user)
            ->get(route('manage.menus.index'))
            ->assertStatus(200)
            ->assertViewIs('pages.manage.menus.index')
            ->assertViewHas('menus');

        $this->assertModelCount(4, 4, 6);
        $this->assertEquals(3, Menu::FromUser($user->id)->count());
    }

    /** @test */
    public function UserHasMenus()
    {
        $this->actingAsUser()
            ->get(route('manage.menus.index'))
            ->assertStatus(302)
            ->assertRedirect(route('home'));

        $this->assertModelCount(1, 0, 0);
    }
    
    /** @test */
    public function AuthRoutes()
    {
        $order = factory(Order::class)->create(['user_id' => $this->user()->id]);
        factory(Order::class, 3)->create(['user_id' => $this->user()->id]);
        factory(Menu::class)->create([
            'user_id'   => $this->user()->id,
            'order_id'  => $order->id
        ]);

        // Index
        $this->get(route('manage.menus.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertModelCount(3, 4, 1);
    }
}
