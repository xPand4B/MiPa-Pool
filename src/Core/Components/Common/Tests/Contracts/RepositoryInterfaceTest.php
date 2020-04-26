<?php

namespace MiPaPo\Core\Components\Common\Tests\Contracts;

use Illuminate\Http\Request;
use MiPaPo\Core\Components\Common\Contracts\RepositoryInterface;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class RepositoryInterfaceTest extends TestCase
{
    /** @test */
    public function test_interface_contains_all_required_methods(): void
    {
        $class = new \ReflectionClass(RepositoryInterface::class);

        $expected = [
            'all' => [
                [ Request::class, 'request'],
            ],
            'getById' => [
                [ Request::class, 'request'],
                [ 'string', 'id'],
            ],
            'update' => [
                [ Request::class, 'request'],
                [ 'string', 'id'],
            ],
            'delete' => [
                [ Request::class, 'request'],
                [ 'string', 'id'],
            ],
            'deleteSoft' => [
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
