<?php

namespace Tests;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use TestParameter, CreatesApplication, RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Return an user
     *
     * @param array $overrides
     *
     * @return \App\Models\User
     */
    protected function user(array $overrides = [])
    {
        return factory(User::class)->create($overrides);
    }

    /**
     * Acting as an user
     *
     * @return TestCase
     */
    protected function actingAsUser(string $driver = null): TestCase
    {
        $this->actingAs($this->user(), $driver);

        return $this;
    }

    /**
     * Assert count for all models in one method.
     *
     * @param integer $userCount
     * @param integer $orderCount
     * @param integer $menuCount
     *
     * @return TestCase
     */
    protected function assertModelCount(int $userCount, int $orderCount, int $menuCount): TestCase
    {
        $this->assertCount($userCount,  User::all());
        $this->assertCount($orderCount, Order::all());
        $this->assertCount($menuCount,  Menu::all());

        return $this;
    }
}
