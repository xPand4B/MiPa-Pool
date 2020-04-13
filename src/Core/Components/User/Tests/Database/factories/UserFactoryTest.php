<?php

namespace MiPaPo\Core\Components\User\Tests\Database\factories;

use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Tests\UserTestCaseTrait;

/**
 * @group UserCoreComponent
 */
class UserFactoryTest extends TestCase
{
    use UserTestCaseTrait;

    /** @test  */
    public function test_factory_creates_a_new_user(): void
    {
        $countBefore = User::all()->count();
        $this->createUser();

        $countAfter = User::all()->count();

        self::assertSame($countAfter, $countBefore + 1);
    }
}
