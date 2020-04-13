<?php

namespace MiPaPo\Frontend\Tests\Controller;

use MiPaPo\Core\Testing\TestCase;

/**
 * @group Frontend
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
