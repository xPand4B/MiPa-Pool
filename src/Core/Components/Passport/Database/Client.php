<?php

namespace MiPaPo\Core\Components\Passport\Database;

use Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE_NAME = 'oauth_clients';
}
