<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;

class MenuTest extends TestCase
{   
    /** @test */
    public function a_menu_can_be_created()
    {
        factory(Menu::class)->create($this->validMenuParams());

        $this->assertCount(1, Menu::all());
    }

    /** @test */
    public function everything_is_required()
    {
        foreach($this->validMenuParams() as $param)
        {
            $this->expectException(\Exception::class);
    
            factory(Menu::class)->create($this->validMenuParams([$param => null]));
        }
    }

    /** @test */
    public function all_menus_from_logged_in_user_can_be_get()
    {
        $user1 = $this->user();
        $user2 = $this->user();

        $order = factory(Order::class)->create(['user_id' => $this->user()]);

        $testMenus = [
            factory(Menu::class)->create(['user_id' => $user1->id, 'order_id' => $order->id]),
            factory(Menu::class)->create(['user_id' => $user1->id, 'order_id' => $order->id]),
            factory(Menu::class)->create(['user_id' => $user1->id, 'order_id' => $order->id]),
        ];

        factory(Menu::class, 3)->create(['user_id' => $user2->id, 'order_id' => $order->id]);

        $menus = Menu::FromUser($user1->id);

        $this->assertCount( 6, Menu::all());
        $this->assertEquals(3, Menu::FromUser($user1->id)->count());
        $this->assertEquals(3, Menu::FromUser($user2->id)->count());

        $count = 1;
        foreach($menus as $menu){
            $this->assertEquals($testMenus[$count], $menu);
            $count++;
        }
    }

    /** @test */
    public function spend_money_on_menus_can_be_get()
    {
        $user = factory(User::class)->create($this->validUserParams());

        factory(Menu::class)->create($this->validMenuParams([
            'user_id'   => $user->id,
            'price'     => 900,
        ]));

        factory(Menu::class)->create($this->validMenuParams([
            'user_id'   => $user->id,
            'price'     => 1100,
        ]));

        $this->assertEquals(
            "20,00", Menu::moneySpend($user->id)
        );
    }
}
