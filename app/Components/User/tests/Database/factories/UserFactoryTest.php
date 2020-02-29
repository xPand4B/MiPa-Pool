<?php

namespace App\Components\User\tests\Database\factories;

use App\Components\Common\Testing\TestCase;
use App\Components\User\Database\User;
use App\Components\User\tests\UserTestCaseTrait;

/**
 * @group User
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
