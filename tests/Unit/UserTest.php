<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Menu;
use App\Models\User;
use App\Models\Order;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_can_be_created()
    {
        factory(User::class)->create($this->validUserParams());

        $this->assertCount(1, User::all());
    }

    /** @test */
    public function check_all_required_fields()
    {
        foreach($this->validUserParams() as $field)
        {
            if(! in_array($field, $this->requiredFields()))
            {
                $this->expectException(\Exception::class);
                
                factory(User::class)->create($this->validUserParams([$field => null]));
            }
        }
    }

    /** @test */
    public function check_all_not_required_fields()
    {
        foreach($this->validUserParams() as $field => $value)
        {
            if(! in_array($field, $this->requiredFields())){
                factory(User::class)->create([$field => null]);
                
            }else{
                factory(User::class)->create();
            }
        }

        $this->assertCount(sizeof($this->validUserParams()), User::all());
    }

    /** @test */
    public function a_fullname_attribute_can_be_get()
    {
        factory(User::class)->create($this->validUserParams());

        $this->assertCount(1, User::all());

        $fullname = $this->validUserParams()['firstname'].' '.$this->validUserParams()['surname'];

        $this->assertEquals($fullname, User::first()->fullname);
    }

    /** @test */
    public function check_if_a_user_has_orders()
    {
        $user = factory(User::class)->create();

        $this->assertEquals(false, $user->hasOrders());

        factory(Order::class)->create(['user_id' => $user->id]);

        $this->assertEquals(true, $user->hasOrders());

        $this->assertModelCount(1, 1, 0);
    }

    /** @test */
    public function check_if_a_user_has_menus()
    {
        $user  = factory(User::class)->create();
        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $this->assertEquals(false, $user->hasMenus());

        factory(Menu::class)->create([
            'user_id' => $user->id,
            'order_id' => $order->id,
        ]);

        $this->assertEquals(true, $user->hasMenus());

        $this->assertModelCount(1, 1, 1);
    }

    /**
     * Return all fields that are not required.
     *
     * @return array
     */
    private function requiredFields(): array
    {
        return [
            'username',
            'firstname',
            'surname',
            'avatar',
            'locale',
            'password'
        ];
    }
}
