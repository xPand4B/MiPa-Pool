<?php

namespace MiPaPo\Core\Components\Common\Tests\Repositories;

use MiPaPo\Core\Components\Common\Contracts\RepositoryInterface;
use MiPaPo\Core\Components\Common\Repositories\GenericRepository;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Http\Resources\UserResource;
use MiPaPo\Core\Components\User\Tests\UserTestCaseTrait;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class GenericRepositoryTest extends TestCase
{
    use UserTestCaseTrait;

    /**
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    private function getGenericRepositoryReflectionClass(): \ReflectionClass
    {
        return new \ReflectionClass(GenericRepository::class);
    }

    /** @test */
    public function test_class_has_correct_interface(): void
    {
        $class = $this->getGenericRepositoryReflectionClass();

        self::assertTrue($class->implementsInterface(RepositoryInterface::class));
    }

    /** @test */
    public function test_class_has_all_required_properties(): void
    {
        $class = $this->getGenericRepositoryReflectionClass();

        $expected = [
            'resource',
            'model',
            'validationRules',
            'validationMessages',
            'validationCustomAttributes'
        ];

        foreach ($expected as $property) {
            self::assertTrue($class->hasProperty($property));
        }
    }

    // TODO: Add tests
}
