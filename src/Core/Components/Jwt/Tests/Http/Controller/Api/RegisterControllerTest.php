<?php

namespace MiPaPo\Core\Components\Jwt\Tests\Http\Controller\Api;

use MiPaPo\Core\Components\Jwt\Http\Controller\Api\RegisterController;
use MiPaPo\Core\Components\Jwt\Http\Controller\JwtBaseController;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group JwtCoreComponent
 */
class RegisterControllerTest extends TestCase
{
    /**
     * @var string
     */
    private const REGISTER_ROUTE = 'auth.register';

    /** @test */
    public function test_class_has_correct_base_controller(): void
    {
        $class = new \ReflectionClass(RegisterController::class);

        self::assertSame(
            JwtBaseController::class, $class->getParentClass()->getName()
        );
    }

    /** @test */
    public function test_class_requires_credentials(): void
    {
        $response = self::json(
            'POST', route(self::REGISTER_ROUTE)
        );
        
        self::assertSame(422, $response->getStatusCode());
        self::assertSame([
            'errors' => [
                [
                    'status' => 422,
                    'title' => 'Validation Error',
                    'detail' => 'validation.required',
                    'source' => [
                        'pointer' => '/data/attributes/username'
                    ]
                ],
                [
                    'status' => 422,
                    'title' => 'Validation Error',
                    'detail' => 'validation.required',
                    'source' => [
                        'pointer' => '/data/attributes/firstname'
                    ]
                ],
                [
                    'status' => 422,
                    'title' => 'Validation Error',
                    'detail' => 'validation.required',
                    'source' => [
                        'pointer' => '/data/attributes/lastname'
                    ]
                ],
                [
                    'status' => 422,
                    'title' => 'Validation Error',
                    'detail' => 'validation.required',
                    'source' => [
                        'pointer' => '/data/attributes/email'
                    ]
                ],
                [
                    'status' => 422,
                    'title' => 'Validation Error',
                    'detail' => 'validation.required',
                    'source' => [
                        'pointer' => '/data/attributes/password'
                    ]
                ],
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], json_decode($response->getContent(), true));
    }

    /** @test */
    public function test_class_can_create_a_new_user(): void
    {
        $countBefore = User::all()->count();

        $response = self::json(
            'POST', route(self::REGISTER_ROUTE), [
                'username' => 'xPand',
                'firstname' => 'Eric',
                'lastname' => 'Heinzl',
                'email' => 'xpand.4beatz@gmail.com',
                'password' => 'secret',
                'password_confirmation' => 'secret',
            ]
        );

        $countAfter = User::all()->count();

        self::assertSame($countBefore + 1, $countAfter);

        $responseData = json_decode($response->getContent(), true);

        $accessToken = $responseData['data']['attributes']['access_token'];
        $expiresIn = $responseData['data']['attributes']['expires_in'];

        self::assertSame(200, $response->getStatusCode());
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
