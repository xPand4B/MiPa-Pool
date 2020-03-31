<?php

namespace MiPaPo\Core\Components\Order\Tests\Database;

use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\System\Tests\ComponentTestTrait;
use MiPaPo\Core\Components\Order\Database\Order;
use MiPaPo\Core\Components\Order\Tests\OrderTestCaseTrait;

/**
 * @group Order
 */
class OrderFactoryTest extends TestCase
{
    use OrderTestCaseTrait;

    /** @test  */
    public function test_factory_creates_a_new_order(): void
    {
//        $countBefore = Order::all()->count();
//        $this->createOrder();
//
//        $countAfter = Order::all()->count();
//
//        self::assertSame($countAfter, $countBefore + 1);
    }

    /** @test */
    public function test_factory_creates_users_per_order(): void
    {
        // TODO: Add test
    }
}
