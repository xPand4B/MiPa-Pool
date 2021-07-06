<?php

namespace Tests\Fortify\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    /** @test */
    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $user = Features::hasTeamFeatures()
            ? User::factory()->withPersonalTeam()->create()
            : User::factory()->create();

        $this->actingAs($user)
            ->get('/user/confirm-password')
            ->assertStatus(200);
    }

    /** @test */
    public function test_password_can_be_confirmed(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create(['password' => Hash::make('password')]);

        $this->actingAs($user)
            ->post('/user/confirm-password', [
                'password' => 'password',
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        /** @var Authenticatable $user */
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/user/confirm-password', [
                'password' => 'wrong-password',
            ])
            ->assertSessionHasErrors();
    }
}
