<?php

namespace MiPaPo\Core\Components\Jwt\Tests\Http\Controller\Api;

use MiPaPo\Core\Components\Jwt\Http\Controller\Api\LoginController;
use MiPaPo\Core\Components\Jwt\Http\Controller\JwtBaseController;
use MiPaPo\Core\Components\User\Tests\UserTestCaseTrait;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group JwtCoreComponent
 */
class LoginControllerTest extends TestCase
{
    use UserTestCaseTrait;

    /**
     * @var string
     */
    private const LOGIN_ROUTE = 'auth.login';

    /** @test */
    public function test_class_has_correct_base_controller(): void
    {
        $class = new \ReflectionClass(LoginController::class);

        self::assertSame(
            JwtBaseController::class, $class->getParentClass()->getName()
        );
    }

    /** @test */
    public function test_class_requires_credentials(): void
    {
        $response = self::json(
            'POST', route(self::LOGIN_ROUTE)
        );

        self::assertSame(401, $response->getStatusCode());
        self::assertSame([
            'errors' => [
                [
                    'status' => 401,
                    'title' => 'Invalid credentials',
                    'detail' => 'The email field is required.',
                    'source' => [
                        'pointer' => '/auth/credentials/email'
                    ]
                ],
                [
                    'status' => 401,
                    'title' => 'Invalid credentials',
                    'detail' => 'The password field is required.',
                    'source' => [
                        'pointer' => '/auth/credentials/password'
                    ]
                ],
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], json_decode($response->getContent(), true));
    }

    /** @test */
    public function test_class_checks_if_credentials_exists(): void
    {
        $this->createUser()[0];

        $response = self::json('POST', route(self::LOGIN_ROUTE), [
            'email' => 'sample@mipapo.com',
            'password' => 'secret'
        ]);

        self::assertSame(401, $response->getStatusCode());
        self::assertSame([
            'errors' => [
                [
                    'status' => 401,
                    'title' => 'Invalid credentials',
                    'detail' => 'There is no user matching these credentials.',
                    'source' => [
                        'pointer' => '/auth'
                    ]
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], json_decode($response->getContent(), true));
    }

    /** @test */
    public function test_class_can_generate_login_token(): void
    {
        $user = $this->createUser()[0];

        $response = self::json('POST', route(self::LOGIN_ROUTE), [
            'email' => $user->email,
            'password' => 'secret'
        ]);
        $responseData = json_decode($response->getContent(), true);

        $accessToken = $responseData['data']['attributes']['access_token'];
        $expiresIn = $responseData['data']['attributes']['expires_in'];

        self::assertSame(200, $response->getStatusCode());
        self::assertSame([
            'data' => [
                'type' => 'token',
                'attributes' => [
                    'access_token' => $accessToken,
                    'token_type' => 'bearer',
                    'expires_in' => $expiresIn,
                    'status' => 200,
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], $responseData);
    }
}
