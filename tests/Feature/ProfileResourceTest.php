<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProfileResourceTest extends TestCase
{
    /** @test */
    public function edit()
    {
        $user = $this->user();

        $this->actingAs($user)
            ->get(route('profile.edit'))
            ->assertStatus(200)
            ->assertViewIs('pages.profile.edit')
            ->assertViewHasAll([
                'user',
                'order_count',
                'order_count_this_month',
                'money_spend',
            ]);

        $this->assertModelCount(1, 0, 0);
    }

    /** @test */
    public function update()
    {
        $user   = $this->user();
        $params = $this->validUserParams();

        $this->actingAs($user)
            ->get(route('profile.edit'));

        $this->actingAs($user)
            ->patch(route('profile.update'), $params)
            ->assertStatus(302)
            ->assertRedirect(route('profile.edit'))
            ->assertSessionDoesntHaveErrors();

        $user = $user->refresh();

        $this->assertDatabaseHas('users', $params);

        $this->assertEquals($params['firstname'],   $user->firstname);
        $this->assertEquals($params['surname'],     $user->surname);
        $this->assertEquals($params['username'],    $user->username);
        $this->assertEquals($params['about_me'],    $user->about_me);

        $this->assertModelCount(1, 0, 0);
    }

    /** @test */
    public function resetAvatar()
    {
        $user   = $this->user(['avatar' => 'test.png']);
        $params = $this->validUserParams();

        $this->actingAs($user)
            ->get(route('profile.edit'));

        $this->actingAs($user)
            ->post(route('profile.reset.avatar'))
            ->assertStatus(302)
            ->assertRedirect(route('profile.edit'))
            ->assertSessionDoesntHaveErrors();

        $this->assertEquals($params['avatar'], $user->refresh()->avatar);

        $this->assertModelCount(1, 0, 0);
    }

    /** @test */
    public function AuthRoutes()
    {
        $user   = $this->user(['avatar' => 'test.png']);
        $params = $this->validUserParams();
    
        // Edit
        $this->get(route('profile.edit'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Update
        $this->patch(route('profile.update'), $params)
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $user = $user->refresh();

        $this->assertDatabaseMissing('users', $params);

        $this->assertNotEquals($params['firstname'],   $user->firstname);
        $this->assertNotEquals($params['surname'],     $user->surname);
        $this->assertNotEquals($params['username'],    $user->username);
        $this->assertNotEquals($params['about_me'],    $user->about_me);

        // Reset Avatar
        $this->post(route('profile.reset.avatar'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertNotEquals($params['avatar'], $user->refresh()->avatar);

        $this->assertModelCount(1, 0, 0);
    }
}
