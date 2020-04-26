<?php

namespace MiPaPo\Core\Components\Jwt\Tests\Http\Controller\Api;

use MiPaPo\Core\Components\Jwt\Tests\AuthTestCaseTrait;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group JwtCoreComponent
 */
class MeControllerTest extends TestCase
{
    use AuthTestCaseTrait;

    /**
     * @var string
     */
    private const ME_ROUTE = 'auth.me';

    /**
     * @var string
     */
    private const REFRESH_ROUTE = 'auth.refresh';

    /** @test */
    public function test_class_can_get_me(): void
    {
        $user = $this->createUser(1, [
            'locale' => config('app.locale')
        ])[0];

        $token = $this->loginAs($user)->getJwtToken();

        $response = self::json('GET', route(self::ME_ROUTE));

        self::assertSame(200, $response->getStatusCode());
        self::assertSame([
            'data' => [
                'type' => 'user',
                'id' => (string)$user->id,

                'attributes' => [
                    'username' => $user->username,
                    'firstname' => $user->firstname,
                    'lastname' => $user->lastname,
                    'initials' => $user->initials,
                    'email' => $user->email,
                    'birthday' => $user->birthday,
                    'avatar' => $user->avatar,
                    'preferences' => [
                        'locale' => $user->locale,
                        'darkmode' => (boolean)$user->darkmode,
                    ]
                ],

                'relationships' => [
                    'orders' => null,
                    'menus' => null
                ],

                'links' => [
                    'self' => route('user.show', ['user' => $user->id]),
                    'related' => null,
                ]
            ],
            'links' => [
                'self' => 'http://localhost/api/v1/auth/me',
                'parameter' => [
                    // nth
                ]
            ],
            'meta' => [
                // nth
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], json_decode($response->getContent(), true));
    }

    public function test_class_can_refresh_token(): void
    {
        $user = $this->createUser()[0];

        // Login user
        $this->loginAs($user)->getJwtToken();

        // Request
        $response = self::json('GET', route(self::REFRESH_ROUTE));
        $responseData = json_decode($response->getContent(), true);

        // Response format
        self::assertSame(200, $response->getStatusCode());
        self::assertSame([
            'data' => [
                'type' => 'token',
                'attributes' => [
                    'access_token' => $responseData['data']['attributes']['access_token'],
                    'token_type' => 'bearer',
                    'expires_in' => $responseData['data']['attributes']['expires_in'],
                    'status' => 200,
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], $responseData);
    }

    /** @test */
    public function test_class_can_refresh_token_and_invalidate_previous(): void
    {
        $user = $this->createUser()[0];

        // Login user
        $token = $this->loginAs($user)->getJwtToken();

        self::json('GET', route(self::REFRESH_ROUTE));
        auth()->logout();
        $response = self::json('GET', route(self::ME_ROUTE), [
            'Authorization' => 'Bearer '.$token
        ]);

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
                'version' => CoreBundle::API_VERSION
            ]
        ], json_decode($response->getContent(), true));
    }

    /** @test */
    public function test_class_can_update_me(): void
    {
        $user = $this->createUser(1, [
            'darkmode' => (bool) false
        ])[0];

        $this->loginAs($user);

        $response = self::json('PATCH', route(self::ME_ROUTE), [
            'darkmode' => (bool) true
        ]);

        $responseData = json_decode($response->getContent(), true);

        self::assertSame(200, $response->getStatusCode());
        self::assertTrue($responseData['data']['attributes']['preferences']['darkmode']);
    }
}
