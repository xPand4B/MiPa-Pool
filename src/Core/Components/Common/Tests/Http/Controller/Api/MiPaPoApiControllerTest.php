<?php

namespace MiPaPo\Core\Components\Common\Tests\Http\Controller\Api;

use MiPaPo\Core\Components\Common\Contracts\ApiControllerInterface;
use MiPaPo\Core\Components\Common\Http\Controller\Api\MiPaPoApiController;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class MiPaPoApiControllerTest extends TestCase
{
    /**
     * Get the Reflection class.
     *
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    private function getReflectionClass(): \ReflectionClass
    {
        return new \ReflectionClass(MiPaPoApiController::class);
    }

    /**
     * Get the specified reflection class method.
     *
     * @param string $method
     * @return \ReflectionMethod|null
     */
    private function getClassMethod(string $method)
    {
        try {
            return $this->getReflectionClass()->getMethod($method);
        } catch (\Exception $e) {
            dump("Class '".$method."' could not be found.");
            return null;
        }
    }

    /** @test */
    public function test_controller_implements_correct_interface(): void
    {
        self::assertSame([
            ApiControllerInterface::class
        ], $this->getReflectionClass()->getInterfaceNames());
    }

    /** @test */
    public function test_controller_has_all_required_abstract_methods(): void
    {
        $expected = [
            'setResource'                   => 'string',
            'setModel'                      => 'string',
            'setStoreValues'                => 'array',
            'setValidationRules'            => 'array',
            'setValidationMessages'         => 'array',
            'setValidationCustomAttributes' => 'array',
        ];

        foreach ($expected as $method => $returnType) {
            $classMethod = $this->getClassMethod($method);

            self::assertTrue($classMethod->isAbstract());
            self::assertTrue($classMethod->isProtected());

            self::assertNotNull($classMethod->getReturnType());

            self::assertSame($returnType, (string)$classMethod->getReturnType());
        }
    }

    /** @test */
    public function test_correct_api_method_params(): void
    {
        $expected = [
            'index' => [
                'Illuminate\Http\Request',
            ],
            'store' => [
                'Illuminate\Http\Request',
            ],
            'show' => [
                'Illuminate\Http\Request',
                'string'
            ],
            'update' => [
                'Illuminate\Http\Request',
                'string'
            ],
            'destroy' => [
                'Illuminate\Http\Request',
                'string'
            ],
        ];

        foreach ($expected as $method => $options) {
            $classMethod = $this->getClassMethod($method);

            self::assertTrue($classMethod->isPublic());
            self::assertStringContainsString('return', $classMethod->getDocComment());

            foreach ($classMethod->getParameters() as $key => $param) {
                self::assertSame(
                    $options[$key],
                    (string) $classMethod->getParameters()[$key]->getType()
                );
            }
        }
    }

    /** @test */
    public function test_index_method(): void
    {
        // TODO: Add test
    }
}
