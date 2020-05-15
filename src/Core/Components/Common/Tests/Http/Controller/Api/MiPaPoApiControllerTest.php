<?php

namespace MiPaPo\Core\Components\Common\Tests\Http\Controller\Api;

use Illuminate\Http\Request;
use MiPaPo\Core\Components\Common\Contracts\ApiControllerInterface;
use MiPaPo\Core\Components\Common\Http\Controller\Api\MiPaPoApiController;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Http\Controller\Api\UserApiController;
use MiPaPo\Core\Components\User\Tests\UserTestCaseTrait;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class MiPaPoApiControllerTest extends TestCase
{
    use UserTestCaseTrait;

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
        $request = new Request();

        $response = (new UserApiController())
            ->index($request);

        self::assertSame([], $response->jsonSerialize());

        $user1= $this->createUser(1, [
            'locale' => config('app.locale')
        ])[0];
        $user2 = User::where('username', 'xPand')->firstOrFail();

        $response = (new UserApiController())
            ->index($request);


        self::assertSame([
            $this->getResponse($user2),
            $this->getResponse($user1),
        ], $response->jsonSerialize());
    }

    /** @test */
    public function test_store_method(): void
    {
        $request = (new Request())
            ->merge([
                'username' => 'xPand',
                'firstname' => 'Eric',
                'lastname' => 'Heinzl',
                'email' => 'xpand.4beatz@gmail.com',
                'password' => 'secret',
                'password_confirmation' => 'secret'
            ]);

        $countBefore = User::all()->count();

        $response = (new UserApiController())
            ->store($request);

        $countAfter = User::all()->count();
        $user = User::first();

        self::assertSame($countAfter, $countBefore + 1);
        self::assertSame([
            'type' => 'user',
            'id' => $user->id,
            'attributes' => [
                'username' => 'xPand',
                'firstname' => 'Eric',
                'lastname' => 'Heinzl',
                'email' => 'xpand.4beatz@gmail.com'
            ],
            'relationships' => [
                'orders' => null,
                'menus' => null
            ],
            'links' => [
                'self' => route('user.show', ['user' => $user->id]),
                'related' => null,
            ]
        ], $response->jsonSerialize());
    }

    /** @test */
    public function test_store_validation(): void
    {
        $request = new Request();

        $response = (new UserApiController())
            ->store($request);

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
    public function test_show_method(): void
    {
        $request = new Request();
        $user= $this->createUser(1, [
            'locale' => config('app.locale')
        ])[0];

        $response = (new UserApiController())
            ->show($request, $user->id);

        self::assertSame(
            $this->getResponse($user), $response->jsonSerialize()
        );
    }

    /** @test */
    public function test_update_method(): void
    {
        $user = $this->createUser(1, [
            'darkmode' => (bool) false
        ])[0];

        // Before
        $request = new Request();
        $response = (new UserApiController())
            ->update($request, $user->id);

        self::assertFalse(
            $response->jsonSerialize()['attributes']['preferences']['darkmode']
        );

        // After
        $request = (new Request())
            ->merge([
                'darkmode' => (bool) true
            ]);
        $response = (new UserApiController())
            ->update($request, $user->id);

        self::assertTrue(
            $response->jsonSerialize()['attributes']['preferences']['darkmode']
        );
    }

    /** @test */
    public function test_destroy_method(): void
    {
        // TODO: Activate test if method has been added.
        $this->markTestIncomplete(
            'GenericRepository::delete has not been implemented yet.'
        );

        $user = $this->createUser()[0];

        $countBefore = User::all()->count();

        $request = new Request();
        $response = (new UserApiController())
            ->destroy($request, $user->id);

        $countAfter = User::all()->count();

        self::assertSame($countBefore - 1, $countAfter);
        self::assertSame([

        ], $response->jsonSerialize());
    }

    /**
     * Get the response that should be returned.
     *
     * @param User $user
     *
     * @return array
     */
    private function getResponse(User $user): array
    {
        return [
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
        ];
    }
}
