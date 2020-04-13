<?php

namespace MiPaPo\Core\Testing;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Assert that a given class has specified traits assigned.
     *
     * @param string $class
     * @param array $traits
     */
    protected function assertClassHasTrait(string $class, array $traits): void
    {
        foreach ($traits as $trait) {
            $hasTrait = in_array(
                $trait,
                array_keys((new \ReflectionClass($class))->getTraits())
            );

            self::assertTrue($hasTrait);
        }
    }
}
