<?php

namespace MiPaPo\Core\Components\User\Tests;

use MiPaPo\Core\Components\User\Database\User;

/**
 * @group UserCoreComponent
 */
trait UserTestCaseTrait
{
    /**
     * Returns a new user.
     *
     * @param int $count
     * @param array $overrides
     *
     * @return mixed
     */
    public function createUser(int $count = 1, array $overrides = [])
    {
        return factory(User::class, $count)->create($overrides);
    }

    /**
     * Provides an array with valid user data.
     *
     * @param array $overrides
     *
     * @return array
     */
    protected function validUserParams(array $overrides = []): array
    {
        return array_merge([
            //
        ], $overrides);
    }
}
