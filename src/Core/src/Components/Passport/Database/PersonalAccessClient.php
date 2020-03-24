<?php

namespace MiPaPo\Core\Components\Passport\Database;

use Laravel\Passport\PersonalAccessClient as PassportPersonalAccessClient;

class PersonalAccessClient extends PassportPersonalAccessClient
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    const TABLE_NAME = 'oauth_personal_access_clients';
}
