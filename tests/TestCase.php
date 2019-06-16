<?php

namespace Tests;

use Carbon\Carbon;
use App\Models\User;
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
    protected function actingAsUser(string $driver = null)
    {
        $this->actingAs($this->user(), $driver);

        return $this;
    }
}
