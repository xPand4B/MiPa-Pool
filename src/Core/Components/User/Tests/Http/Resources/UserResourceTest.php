<?php

namespace MiPaPo\Core\Components\User\Tests\Http\Resources;

use MiPaPo\Core\Testing\TestCase;
use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Http\Resources\UserResource;
use MiPaPo\Core\Components\User\Tests\UserTestCaseTrait;

/**
 * @group UserCoreComponent
 */
class UserResourceTest extends TestCase
{
    use UserTestCaseTrait;

    /** @test */
    public function test_user_resource_format(): void
    {
        $this->createUser(2);
        $users = User::all();

        $collection = UserResource::collection($users)->resolve();

        self::assertSame([
            $this->getResponse($users[0]),
            $this->getResponse($users[1])
        ], $collection);
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
