<?php

namespace Tests\Jetstream\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    /** @test */
    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertSame($user->username, $component->state['username']);
        $this->assertSame($user->name, $component->state['name']);
        $this->assertSame($user->email, $component->state['email']);
    }

    /** @test */
    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', [
                'username' => 'Test Username',
                'name' => 'Test Name',
                'email' => 'test@example.com'
            ])
            ->call('updateProfileInformation');

        $this->assertSame('Test Username', $user->fresh()->username);
        $this->assertSame('Test Name', $user->fresh()->name);
        $this->assertSame('test@example.com', $user->fresh()->email);
    }
}
