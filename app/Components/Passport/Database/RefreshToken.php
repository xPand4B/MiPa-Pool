<?php

namespace App\Components\Passport\Database;

use Laravel\Passport\RefreshToken as PassportRefreshToken;

class RefreshToken extends PassportRefreshToken
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE_NAME = 'oauth_refresh_tokens';
}
