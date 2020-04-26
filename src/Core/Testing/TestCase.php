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

    protected function assertClassExtendsClass(string $childClass, string $parentClass)
    {
        $child = new \ReflectionClass($childClass);

        self::assertSame(
            $child->getParentClass()->getName(), $parentClass
        );
    }

    /**
     * Returns the specified method.
     *
     * @param string $class
     * @param string $method
     *
     * @return \ReflectionMethod|string|null
     * @throws \ReflectionException
     */
    protected static function getMethod(string $class, string $method)
    {
        if (! class_exists($class)) {
            return null;
        }

        $class = new \ReflectionClass($class);

        self::assertTrue($class->hasMethod($method));

        $method = $class->getMethod($method);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * Returns the given method as invoke method.
     *
     * @param string $reflectionClass
     * @param string $method
     * @param array $methodArgs
     * @param $invokeClass
     *
     * @return mixed
     * @throws \ReflectionException
     */
    protected static function invokeMethod(string $reflectionClass, string $method, array $methodArgs, $invokeClass)
    {
        $method = self::getMethod($reflectionClass, $method);

        return $method->invoke($invokeClass, ...$methodArgs);
    }
}
