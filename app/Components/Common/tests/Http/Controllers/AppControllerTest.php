<?php

namespace App\Components\Common\tests\Http\Controllers;

use App\Components\Common\Testing\TestCase;

/**
 * @group Common
 */
class AppControllerTest extends TestCase
{
    /** @test */
    public function test_index_returns_master_page()
    {
        self::get('/')
            ->assertViewIs('pages.master')
            ->assertStatus(200);
    }
}
