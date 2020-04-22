<?php

namespace MiPaPo\Core\Components\Common\Tests\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MiPaPo\Core\Components\Common\Contracts\RepositoryInterface;
use MiPaPo\Core\Components\Common\Repositories\GenericRepository;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Http\Resources\UserResource;
use MiPaPo\Core\Components\User\Tests\UserTestCaseTrait;
use MiPaPo\Core\CoreBundle;
use MiPaPo\Core\Testing\TestCase;

/**
 * @group CommonCoreComponent
 */
class GenericRepositoryTest extends TestCase
{
    use UserTestCaseTrait;

    /**
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    private function getGenericRepositoryReflectionClass(): \ReflectionClass
    {
        return new \ReflectionClass(GenericRepository::class);
    }

    /**
     * @return Request
     */
    private function getRequest(): Request
    {
        return new Request();
    }

    /**
     * @return GenericRepository
     */
    private function getNewGenericRepository(): GenericRepository
    {
        return new GenericRepository(
            UserResource::class, User::class
        );
    }

    /** @test */
    public function test_class_has_correct_interface(): void
    {
        $class = $this->getGenericRepositoryReflectionClass();

        self::assertTrue($class->implementsInterface(RepositoryInterface::class));
    }

    /** @test */
    public function test_class_has_all_required_properties(): void
    {
        $class = $this->getGenericRepositoryReflectionClass();

        $expected = [
            'resource',
            'model',
            'validationRules',
            'validationMessages',
            'validationCustomAttributes'
        ];

        foreach ($expected as $property) {
            self::assertTrue($class->hasProperty($property));
        }
    }

    /** @test */
    public function test_class_can_get_all_entities_without_pagination(): void
    {
        $user = $this->createUser(1, [
            'locale' => config('app.locale'),
            'darkmode' => (boolean) false
        ])[0];

        $repo = $this->getNewGenericRepository();
        $request = $this->getRequest();

        $response = $repo->all($request)->jsonSerialize();

        self::assertSame([
            'type' => 'user',
            'id' => (string) $user->id,
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
                    'darkmode' => $user->darkmode,
                ],
            ],
            'relationships' => [
                'orders' => null,
                'menus' => null,
            ],
            'links' => [
                'self' => 'http://localhost/api/v1/users/'.(string) $user->id,
                'related' => null
            ]
        ], $response[1]);
    }

    /** @test */
    public function test_class_can_get_all_entities_with_pagination(): void
    {
        $this->createUser(1, [
            'locale' => config('app.locale'),
            'darkmode' => (boolean) false
        ]);

        $user = User::all();

        $user1 = $user[0];
        $user2 = $user[1];

        $repo = $this->getNewGenericRepository();
        $request = ($this->getRequest())
            ->merge([
                'paginate' => 2
            ]);

        $response = $repo->all($request)->jsonSerialize();

        self::assertSame(2, sizeof($response));
        self::assertContains([
            'type' => 'user',
            'id' => (string) $user1->id,
            'attributes' => [
                'username' => $user1->username,
                'firstname' => $user1->firstname,
                'lastname' => $user1->lastname,
                'initials' => $user1->initials,
                'email' => $user1->email,
                'birthday' => $user1->birthday,
                'avatar' => $user1->avatar,
                'preferences' => [
                    'locale' => $user1->locale,
                    'darkmode' => $user1->darkmode,
                ],
            ],
            'relationships' => [
                'orders' => null,
                'menus' => null,
            ],
            'links' => [
                'self' => 'http://localhost/api/v1/users/'.(string) $user1->id,
                'related' => null
            ],
        ], $response);
    }

    /** @test */
    public function test_class_can_validate_request(): void
    {
        // TODO: Add tests
    }

    /** @test */
    public function test_class_can_store_data(): void
    {
        $request = ($this->getRequest())
            ->merge([
                'username' => 'xPand',
                'firstname' => 'Eric',
                'lastname' => 'Heinzl',
                'email' => 'xpand.4beatz@gmail.com',
                'password' => '123456789',
                'password_confirmation' => '123456789',
            ]);

        self::assertSame(0, User::all()->count());

        $repo = $this->getNewGenericRepository();

        $repo->store($request, [
            'username' => $request->get('username'),
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'initials' => 'EH',
            'email' => $request->get('email'),
            'avatar' => $request->get('avatar'),
            'birthday' => $request->get('birthday'),
            'remember_token' => Str::random(40),
            'password' => bcrypt($request->get('password')),
        ]);

        self::assertSame(1, User::all()->count());
    }

    /** @test */
    public function test_class_can_get_entity_by_id_without_parameter(): void
    {
        $user = $this->createUser(1, [
            'locale' => config('app.locale'),
            'darkmode' => (boolean) false
        ])[0];

        $request = $this->getRequest();
        $repo = $this->getNewGenericRepository();

        $response = $repo->getById($request, $user->id)->jsonSerialize();

        self::assertSame([
            'type' => 'user',
            'id' => (string) $user->id,
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
                    'darkmode' => $user->darkmode,
                ],
            ],
            'relationships' => [
                'orders' => null,
                'menus' => null,
            ],
            'links' => [
                'self' => 'http://localhost/api/v1/users/'.(string) $user->id,
                'related' => null
            ],
        ], $response);
    }

    /** @test */
    public function test_class_can_get_entity_by_id_with_parameter(): void
    {
        $user = $this->createUser(1, [
            'locale' => config('app.locale'),
            'darkmode' => (boolean) false
        ])[0];

        $request = ($this->getRequest())
            ->merge([
                'username' => null,
                'firstname' => null,
                'lastname' => null,
            ]);

        $repo = $this->getNewGenericRepository();

        $response = $repo->getById($request, $user->id)->jsonSerialize();

        self::assertSame([
            'type' => 'user',
            'id' => (string) $user->id,
            'attributes' => [
                'username' => $user->username,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
            ],
            'relationships' => [
                'orders' => null,
                'menus' => null,
            ],
            'links' => [
                'self' => 'http://localhost/api/v1/users/'.(string) $user->id,
                'related' => null
            ],
        ], $response);
    }

    /** @test */
    public function test_class_can_update_entity(): void
    {
        $this->createUser(1, [
            'locale' => config('app.locale'),
            'darkmode' => (boolean) false
        ])[0];

        $repo = ($this->getNewGenericRepository())
            ->setValidationRules([
                'darkmode' => 'boolean'
            ]);
        $request = ($this->getRequest())
            ->merge([
                'locale' => config('app.locale'),
                'darkmode' => (boolean) true,

                'sample' => 'sample'
            ]);

        self::assertFalse((boolean) User::first()->darkmode);

        $repo->update($request, User::first());

        self::assertTrue((boolean) User::first()->darkmode);
    }

    /** @test */
    public function test_class_checks_validation_while_updating_entity(): void
    {
        $this->createUser(1, [
            'darkmode' => (boolean) false
        ])[0];

        $repo = ($this->getNewGenericRepository())
            ->setValidationRules([
                'darkmode' => 'boolean'
            ]);
        $request = ($this->getRequest())
            ->merge([
                'darkmode' => 'test',
            ]);

        self::assertFalse((boolean) User::first()->darkmode);

        $response = $repo->update($request, User::first());

        self::assertSame(json_encode([
            'errors' => [
                [
                    'status' => 422,
                    'title' => 'Validation Error',
                    'detail' => 'validation.boolean',
                    'source' => [
                        'pointer' => '/data/attributes/darkmode'
                    ]
                ]
            ],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ]), $response->getContent());
    }

    /** @test */
    public function test_class_can_delete_entity(): void
    {
        $user = $this->createUser()[0];

        $request = $this->getRequest();
        $repo = $this->getNewGenericRepository();

        // TODO: Remove flag after implementation
        $this->markTestIncomplete(
            'GenericRepository::delete has not been implemented yet.'
        );

        self::assertSame(1, User::all()->count());

        $repo->delete($request, $user->id);

        self::assertSame(0, User::all()->count());
    }

    /** @test */
    public function test_class_can_soft_delete_entity(): void
    {
        $user = $this->createUser()[0];

        $request = $this->getRequest();
        $repo = $this->getNewGenericRepository();

        // TODO: Remove flag
        $this->markTestIncomplete(
            'GenericRepository::deleteSoft has not been implemented yet.'
        );

        // TODO: Add assertions
    }

    /** @test */
    public function test_class_has_additional_data(): void
    {
        $this->createUser();

        $repo = $this->getNewGenericRepository();
        $request = $this->getRequest();

        self::assertSame([
            'links' => [
                'self' => 'http://:',
                'parameter' => []
            ],
            'meta' => [],
            'jsonapi' => [
                'version' => CoreBundle::API_VERSION
            ]
        ], $repo->all($request)->additional);
    }
}
