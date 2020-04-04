<?php

namespace MiPaPo\Core\Components\Passport\Database;

use Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE_NAME = 'oauth_access_tokens';
}
