<?php

namespace MiPaPo\Core\Components\Common\Tests\Http\Controllers;

use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\Tests\ComponentTestTrait;

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
