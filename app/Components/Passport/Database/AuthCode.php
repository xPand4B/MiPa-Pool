<?php

namespace App\Components\Passport\Database;

use Laravel\Passport\AuthCode as PassportAuthCode;

class AuthCode extends PassportAuthCode
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE_NAME = 'oauth_auth_codes';
}
