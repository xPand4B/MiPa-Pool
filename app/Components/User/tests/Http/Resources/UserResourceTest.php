<?php

namespace App\Components\User\tests\Http\Resources;

use App\Components\Common\Testing\TestCase;
use App\Components\User\Database\User;
use App\Components\User\Http\Resources\UserResource;
use App\Components\User\tests\UserTestCaseTrait;

/**
 * @group User
 */
class UserResourceTest extends TestCase
{
    use UserTestCaseTrait;

    /** @test */
    public function test_resource_format(): void
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
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'username' => $user->username,
                'email' => $user->email,
                'birthday' => $user->birthday,
                'avatar' => $user->avatar,
                'locale' => $user->locale,
                'darkmode' => (boolean)$user->darkmode,
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
