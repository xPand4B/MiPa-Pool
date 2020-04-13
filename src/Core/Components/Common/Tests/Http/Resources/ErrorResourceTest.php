<?php

namespace MiPaPo\Core\Components\Common\Tests\Http\Resources;

use MiPaPo\Core\Components\Common\Http\Resources\ErrorResource;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class ErrorResourceTest extends TestCase
{
    /**
     * @var \ReflectionClass
     */
    private $class;

    public function setUp(): void
    {
        parent::setUp();
        $this->class = new \ReflectionClass(ErrorResource::class);
    }

    /** @test */
    public function test_class_has_all_required_properties(): void
    {
        $expected = [
            'id',
            'linkAbout',
            'statusCode',
            'applicationErrorCode',
            'title',
            'detail',
            'sourcePointer',
            'sourceParameter',
            'meta',
            'errorCollection'
        ];

        self::assertSame(10, sizeof($this->class->getProperties()));

        foreach ($this->class->getProperties() as $key => $property) {
            self::assertSame($expected[$key], $property->name);
        }
    }

    /** @test */
    public function test_class_has_all_required_setter(): void
    {
        $expected = [
            'setId' => [
                'params' => [ 'id' ],
            ],
            'setLinks' => [
                'params' => [ 'about' ],
            ],
            'setStatusCode' => [
                'params' => [ 'code' ],
            ],
            'setCode' => [
                'params' => [ 'code' ],
            ],
            'setTitle' => [
                'params' => [ 'title' ],
            ],
            'setDetail' => [
                'params' => [ 'detail' ],
            ],
            'setSource' => [
                'params' => [ 'pointer', 'parameter' ],
            ],
            'setMeta' => [
                'params' => [ 'meta' ],
            ],
        ];

        foreach ($expected as $method => $meta) {
            self::assertTrue($this->class->hasMethod($method));

            $method = $this->class->getMethod($method);
            $params = $meta['params'];

            foreach ($method->getParameters() as $key => $parameter) {
                self::assertSame($params[$key], $parameter->getName());
            }

            self::assertTrue($method->hasReturnType());
            self::assertTrue($method->isPublic());

            self::assertFalse($method->isStatic());
        }
    }

    /** @test */
    public function test_class_can_handle_single_error(): void
    {
        $errorResource = (new ErrorResource())
            ->setStatusCode(400)
            ->setId('1337')
            ->setLinks('https://xpand4b.de')
            ->setTitle('This is a sample error message')
            ->setDetail('Only occurs while testing the ErrorResource class.')
            ->setSource('/mipapo/core/phpunit/ErrorResourceTest', null)
            ->getError();

        self::assertJson($errorResource->getContent());
        self::assertSame(400, $errorResource->getStatusCode());
        self::assertSame(json_encode([
            'errors' => [
                [
                    'id' => '1337',
                    'links' => [
                        'about' => 'https://xpand4b.de'
                    ],
                    'status' => 400,
                    'title' => 'This is a sample error message',
                    'detail' => 'Only occurs while testing the ErrorResource class.',
                    'source' => [
                        'pointer' => '/mipapo/core/phpunit/ErrorResourceTest'
                    ],
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ]), $errorResource->getContent());
    }

    /** @test */
    public function test_class_can_handle_error_collection(): void
    {
        $errorResource = new ErrorResource();
        $errorResource->addError(...$this->getSampleError());
        $errorResource->addError(...$this->getSampleError());

        $result = $errorResource
            ->setStatusCode(400)
            ->getErrorCollection();

        self::assertJson($result->getContent());
        self::assertSame(400, $result->getStatusCode());
        self::assertSame(json_encode([
            'errors' => [
                [
                    'id' => '1337',
                    'links' => [
                        'about' => 'https://xpand4b.de'
                    ],
                    'status' => 401,
                    'title' => 'This is a sample error message',
                    'detail' => 'Only occurs while testing the ErrorResource class.',
                    'source' => [
                        'pointer' => '/mipapo/core/phpunit/ErrorResourceTest'
                    ],
                ],
                [
                    'id' => '1337',
                    'links' => [
                        'about' => 'https://xpand4b.de'
                    ],
                    'status' => 401,
                    'title' => 'This is a sample error message',
                    'detail' => 'Only occurs while testing the ErrorResource class.',
                    'source' => [
                        'pointer' => '/mipapo/core/phpunit/ErrorResourceTest'
                    ],
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ]), $result->getContent());
    }

    /**
     * Provides a sample error.
     *
     * @return array
     */
    private function getSampleError(): array
    {
        return [
            '1337',
            'https://xpand4b.de',
            401,
            null,
            'This is a sample error message',
            'Only occurs while testing the ErrorResource class.',
            '/mipapo/core/phpunit/ErrorResourceTest',
            null,
            null
        ];
    }
}
