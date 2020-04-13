<?php

namespace MiPaPo\Core\Components\Common\Tests\Http\Resources;

use MiPaPo\Core\Components\Common\Http\Resources\BaseResource;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class BaseResourceTest extends TestCase
{
    /**
     * @var \ReflectionClass
     */
    private $class;

    public function setUp(): void
    {
        parent::setUp();
        $this->class = new \ReflectionClass(BaseResource::class);
    }

    /** @test */
    public function test_class_has_all_required_abstract_methods(): void
    {
        $methods = $this->class->getMethods();

        $expected = [
            'getTable',
            'getType',
            'getAttributes',
            'getRelations'
        ];

        foreach ($methods as $key => $method) {
            if (!$method->isAbstract()) {
                continue;
            }

            self::assertSame($expected[$key], $method->name);
            self::assertTrue($method->isProtected());
            self::assertTrue($method->hasReturnType());
        }
    }

    /** @test */
    public function test_trait_has_getter_for_id(): void
    {
        self::assertTrue($this->class->hasMethod('getId'));

        $method = $this->class->getMethod('getId');

        self::assertTrue($method->isProtected());
        self::assertTrue($method->hasReturnType());
    }

    /** @test */
    public function test_trait_has_getter_for_links(): void
    {
        self::assertTrue($this->class->hasMethod('getLinks'));

        $method = $this->class->getMethod('getLinks');

        self::assertTrue($method->isProtected());
        self::assertTrue($method->hasReturnType());
    }
}
