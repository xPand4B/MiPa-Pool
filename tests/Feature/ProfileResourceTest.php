<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProfileResourceTest extends TestCase
{
    /** @test */
    public function a_logged_in_user_can_view_his_profile()
    {
        $user = $this->user();

        $this->actingAs($user)
            ->get(route('profile.edit'))
            ->assertStatus(200)
            ->assertSee($user->username)
            ->assertSee($user->firstname)
            ->assertSee($user->surname)
            // ->assertSee($user->email)
            ->assertSee($user->about_me)
            ->assertViewIs('pages.profile.edit');
    }

    /** @test */
    public function only_logged_in_users_can_see_a_profile()
    {
        $this->get(route('profile.edit'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function a_logged_in_user_can_update_his_profile()
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
    }

    /** @test */
    public function only_logged_in_users_can_update_a_profile()
    {
        $user   = $this->user();
        $params = $this->validUserParams();
    
        $this->patch(route('profile.update'), $params)
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $user = $user->refresh();

        $this->assertDatabaseMissing('users', $params);

        $this->assertNotEquals($params['firstname'],   $user->firstname);
        $this->assertNotEquals($params['surname'],     $user->surname);
        $this->assertNotEquals($params['username'],    $user->username);
        $this->assertNotEquals($params['about_me'],    $user->about_me);
    }

    /** @test */
    public function a_logged_in_user_can_reset_his_avatar()
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
    }

    /** @test */
    public function only_logged_in_users_can_reset_a_avatar()
    {
        $user   = $this->user(['avatar' => 'test.png']);
        $params = $this->validUserParams();

        $this->post(route('profile.reset.avatar'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertNotEquals($params['avatar'], $user->refresh()->avatar);
    }
}
