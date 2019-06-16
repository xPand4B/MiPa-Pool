<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Menu;

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
