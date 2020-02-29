<?php

namespace App\Components\Menu\tests\Database;

use App\Components\Common\Testing\TestCase;
use App\Components\Menu\Database\Menu;
use App\Components\Menu\tests\MenuTestCaseTrait;

/**
 * @group Menu
 */
class MenuFactoryTest extends TestCase
{
    use MenuTestCaseTrait;

    /** @test  */
    public function test_factory_creates_a_new_menu(): void
    {
//        $countBefore = Menu::all()->count();
//        $this->createMenu();
//
//        $countAfter = Menu::all()->count();
//
//        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_factory_creates_orders_and_users_per_menu(): void
    {
        // TODO: Add test
    }
}
