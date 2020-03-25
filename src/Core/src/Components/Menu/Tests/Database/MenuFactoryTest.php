<?php

namespace MiPaPo\Core\Components\Menu\Tests\Database;

use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\Tests\ComponentTestTrait;
use MiPaPo\Core\Components\Menu\Database\Menu;
use MiPaPo\Core\Components\Menu\Tests\MenuTestCaseTrait;

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
