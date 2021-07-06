<?php

namespace Tests\Fortify\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /** @test */
    public function test_login_screen_can_be_rendered(): void
    {
        $this->get('/login')
            ->assertStatus(200);
    }

    /** @test */
    public function test_users_can_authenticate_using_email_and_the_login_screen(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'identity' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /** @test */
    public function test_users_can_authenticate_using_username_and_the_login_screen(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'identity' => $user->username,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    /** @test */
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'identity' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
