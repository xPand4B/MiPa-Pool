<?php

namespace MiPaPo\Core\Components\Common\Tests\Http\Resources;

use Illuminate\Http\JsonResponse;
use MiPaPo\Core\Components\Common\Http\Resources\ResourceBuilder;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class ResourceBuilderTest extends TestCase
{
    /** @test */
    public function test_resource_can_set_data(): void
    {
        $type = 'Sample';
        $attributes = [
            'first' => 'First value',
            'second' => 'Second value'
        ];

        $response = $this->getCoreResource()
            ->setData($type, $attributes)
            ->getResponse();

        self::assertSame(200, $response->getStatusCode());
        self::assertSame([
            'data' => [
                'type' => 'Sample',
                'attributes' => [
                    'first' => 'First value',
                    'second' => 'Second value'
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], $this->decodeResponse($response));
    }

    /** @test */
    public function test_resource_can_set_meta(): void
    {
        $data = [
            'first' => 'First value',
            'second' => 'Second value'
        ];

        $response = $this->getCoreResource()
            ->setMeta($data)
            ->getResponse();

        self::assertSame(200, $response->getStatusCode());
        self::assertSame([
            'meta' => [
                'first' => 'First value',
                'second' => 'Second value'
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], $this->decodeResponse($response));
    }

    /** @test */
    public function test_resource_can_set_status_code(): void
    {
        $statusCode = 404;

        $response = $this->getCoreResource()
            ->setStatusCode($statusCode)
            ->getResponse();

        self::assertSame(404, $response->getStatusCode());
        self::assertSame([
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], $this->decodeResponse($response));
    }

    /**
     * Get a new CoreResource instance.
     *
     * @return ResourceBuilder
     */
    private function getCoreResource(): ResourceBuilder
    {
        return new ResourceBuilder();
    }

    /**
     * Get the decoded response.
     *
     * @param JsonResponse $response
     * @return array
     */
    private function decodeResponse(JsonResponse $response): array
    {
        return json_decode($response->getContent(), true);
    }
}
