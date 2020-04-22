<?php

namespace MiPaPo\Core\Components\Common\Tests\Contracts;

use Illuminate\Http\Request;
use MiPaPo\Core\Components\Common\Contracts\ApiControllerInterface;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class ApiControllerInterfaceTest extends TestCase
{
    /** @test */
    public function test_interface_contains_all_required_methods(): void
    {
        $class = new \ReflectionClass(ApiControllerInterface::class);

        $expected = [
            'index' => [
                [ Request::class, 'request'],
            ],
            'store' => [
                [ Request::class, 'request'],
            ],
            'show' => [
                [ Request::class, 'request'],
                [ 'string', 'id'],
            ],
            'update' => [
                [ Request::class, 'request'],
                [ 'string', 'id'],
            ],
            'destroy' => [
                [ Request::class, 'request'],
                [ 'string', 'id'],
            ],
        ];

        foreach ($expected as $expectedName => $expectedParams) {
            self::assertTrue($class->hasMethod($expectedName));

            $method = $class->getMethod($expectedName);
            $params = $method->getParameters();

            self::assertSame(sizeof($expectedParams), $method->getNumberOfParameters());
            self::assertTrue($method->isPublic());

            foreach ($params as $key => $param) {
                $expectedParamType = $expectedParams[$key][0];
                $expectedParamName = $expectedParams[$key][1];

                self::assertSame($expectedParamType, (string) $param->getType());
                self::assertSame($expectedParamName, $param->getName());
            }
        }
    }
}
