<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;

class ManagementResourceTest extends TestCase
{
    /** @test */
    public function index()
    {
        $user = $this->user();

        factory(Order::class, 3)->create(['user_id' => $this->user()->id]);
        factory(Order::class, 3)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('manage.index'))
            ->assertStatus(200)
            ->assertViewIs('pages.manage.index')
            ->assertViewHas([
                'orders'
            ]);

        $this->assertModelCount(2, 6, 0);
        $this->assertEquals(3, Order::FromUser($user->id)->count());
    }

    /** @test */
    public function show()
    {
        $user  = $this->user();
        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('manage.show', $order))
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertViewIs('pages.manage.show')
            ->assertViewHas([
                'order' => $order
            ]);

        $this->assertModelCount(1, 1, 0);
    }

    /** @test */
    public function edit()
    {
        $user  = $this->user();
        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('manage.edit', $order))
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertViewIs('pages.manage.edit')
            ->assertViewHas([
                'order' => $order
            ]);

        $this->assertModelCount(1, 1, 0);
    }

    /** @test */
    // public function update()
    // {
    //     //
    // }
    
    /** @test */
    // public function close()
    // {
    //     //
    // }

    /** @test */
    public function destroy()
    {
        $user  = $this->user();
        $order = factory(Order::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->delete(route('manage.destroy', $order))
            ->assertStatus(302)
            ->assertRedirect(route('manage.index'))
            ->assertSessionHas('success');

        $this->assertModelCount(1, 0, 0);
    }

    /** @test */
    public function OrderExists()
    {
        // $this->user();
        factory(Order::class)->create(['user_id' => $this->user()]);

        // Show
        $this->actingAsUser()
            ->get(route('manage.show', 2))
            ->assertStatus(404);

        // Edit
        $this->actingAsUser()
            ->get(route('manage.edit', 2))
            ->assertStatus(404);

        // Update

        // Close

        // Destroy
        $this->actingAsUser()
            ->delete(route('manage.destroy', 2))
            ->assertStatus(404);
        
        // $this->assertModelCount(2, 1, 0);
    }

    /** @test */
    public function OrderFromUser()
    {
        $this->user();
        $order = factory(Order::class)->create();

        $this->withoutExceptionHandling();

        // Show
        $this->actingAsUser()
            ->get(route('manage.show', $order))
            ->assertStatus(302)
            ->assertRedirect(route('manage.index'));

        // Edit
        $this->actingAsUser()
            ->get(route('manage.edit', $order))
            ->assertStatus(302)
            ->assertRedirect(route('manage.index'));

        // Update

        // Close

        // Destroy
        
        // $this->assertModelCount(2, 1, 0);
    }

    /** @test */
    public function AuthRoutes()
    {
        factory(Order::class, 4)->create(['user_id' => $this->user()->id]);

        // Index
        $this->get(route('manage.index'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Show
        $this->get(route('manage.show', 1))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Edit
        $this->get(route('manage.edit', 1))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Update
        $this->patch(route('manage.update', $this->validOrderParams()))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Close
        $this->patch(route('manage.update', $this->validOrderParams(['closed' => 1])))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        // Destroy
        $this->delete(route('manage.destroy', 1))
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertModelCount(1, 4, 0);
    }
}
