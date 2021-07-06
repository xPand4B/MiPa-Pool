<?php

namespace Tests\Http\Controllers;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /** @test */
    public function test_homepage_is_correct(): void
    {
        $this->get(route('home'))
            ->assertStatus(200)
            ->assertViewIs('home.index');
    }
}
