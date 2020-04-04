<?php

namespace MiPaPo\Frontend\Tests\Controller;

use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\System\Tests\ComponentTestTrait;

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
