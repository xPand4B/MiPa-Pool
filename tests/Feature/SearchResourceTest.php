<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class SearchResourceTest extends TestCase
{
    /** @test */
    public function only_logged_in_users_can_perform_a_search_request()
    {
        $this->get(route('search.show', $this->validUserParams()['username']))
            ->assertRedirect(route('login'));
    }
    /** @test */
    // public function a_logged_in_user_can_search_for_a_user()
    // {
    //     $user   = factory(User::class)->create($this->validUserParams());

    //     $order  = factory(Order::class)->create($this->validOrderParams([
    //         'user_id' => $user->id
    //     ]));

    //     $menu   = factory(Menu::class)->create($this->validUserParams([
    //         'user_id'   => $user->id,
    //         'order_id'  => $order->id
    //     ]));

    //     $this->actingAs($user)
    //         ->get(route('search.show', '?q=xPand'));
    // }
}
