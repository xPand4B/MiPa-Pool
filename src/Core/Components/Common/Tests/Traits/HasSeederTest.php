<?php

namespace MiPaPo\Core\Components\Common\Tests\Traits;

use MiPaPo\Core\Components\Common\Traits\HasSeeder;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class HasSeederTest extends TestCase
{
    /**
     * @var \ReflectionClass
     */
    private $class;

    /**
     * @var \ReflectionProperty
     */
    private $property;

    public function setUp(): void
    {
        $this->class = new \ReflectionClass(HasSeeder::class);
        $this->property = $this->class->getProperty('seed_count');
    }

    /** @test */
    public function test_trait_has_only_seed_count(): void
    {
        self::assertSame('seed_count', $this->property->name);
        self::assertSame(1, sizeof($this->class->getProperties()));
    }

    /** @test */
    public function test_seed_count_is_correct(): void
    {
        self::assertTrue($this->property->isPublic());
        self::assertTrue($this->property->isStatic());

        self::assertSame(25, $this->property->getValue());
    }
}
