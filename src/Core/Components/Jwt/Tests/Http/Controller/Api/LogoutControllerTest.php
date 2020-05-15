<?php

namespace MiPaPo\Core\Components\Jwt\Tests\Http\Controller\Api;

use MiPaPo\Core\Components\Jwt\Tests\AuthTestCaseTrait;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group JwtCoreComponent
 */
class LogoutControllerTest extends TestCase
{
    use AuthTestCaseTrait;

    /**
     * @var string
     */
    private const LOGOUT_ROUTE = 'auth.logout';

    /**
     * @var string
     */
    private const ME_ROUTE = 'auth.me';

    /** @test */
    public function test_class_can_logout_user(): void
    {
        $user = $this->createUser()[0];

        $this->loginAs($user)->getJwtToken();

        $response = self::json('GET', route(self::LOGOUT_ROUTE));

        self::assertSame(200, $response->getStatusCode());
        self::assertSame([
            'data' => [
                'type' => 'message',
                'attributes' => [
                    'message' => 'Successfully logged out.',
                    'status' => 200
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], json_decode($response->getContent(), true));
    }

    /** @test */
    public function test_class_invalidates_token_during_logout(): void
    {
        $user = $this->createUser()[0];

        $this->loginAs($user)->getJwtToken();

        // First request
        $response = self::json('GET', route(self::LOGOUT_ROUTE));
        self::assertSame(200, $response->getStatusCode());

        // Second request
        $response = self::json('GET', route(self::ME_ROUTE));
        self::assertSame(401, $response->getStatusCode());
        self::assertSame([
            'errors' => [
                [
                    'status' => 401,
                    'title' => 'Authentication error',
                    'detail' => 'You are not authenticated.',
                    'source' => [
                        'pointer' => '/auth'
                    ]
                ]
            ],
            'jsonapi' => [
                'version' => '1.0'
            ]
        ], json_decode($response->getContent(), true));
    }
}
