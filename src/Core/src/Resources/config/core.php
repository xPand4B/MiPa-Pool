<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Path Variables
    |--------------------------------------------------------------------------
    |
    | This is where all path related stuff is defined.
    |
    */
    'path' => [

        /*
        |--------------------------------------------------------------------------
        | Component Path
        |--------------------------------------------------------------------------
        |
        | This will define were the components root directory is located.
        |
        */

        'component' => 'src'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Components',

        /*
        |--------------------------------------------------------------------------
        | Database Path
        |--------------------------------------------------------------------------
        |
        | This will define were the Database path is for each component.
        |
        */

        'database' => 'Database',

        /*
        |--------------------------------------------------------------------------
        | Factories Path
        |--------------------------------------------------------------------------
        |
        | This will define were factories for each component are located.
        |
        */

        'factories' => 'Database'.DIRECTORY_SEPARATOR.'factories',

        /*
        |--------------------------------------------------------------------------
        | Migrations Path
        |--------------------------------------------------------------------------
        |
        | This will define were component migrations are located.
        |
        */

        'migrations' => 'Database'.DIRECTORY_SEPARATOR.'migrations',

        /*
        |--------------------------------------------------------------------------
        | Seeds Path
        |--------------------------------------------------------------------------
        |
        | This will define were component seeds are located.
        |
        */

        'seeds' => 'Database'.DIRECTORY_SEPARATOR.'seeds',

        /*
        |--------------------------------------------------------------------------
        | OAuth Key Location
        |--------------------------------------------------------------------------
        |
        | This will define were oauth keys are being stored.
        |
        */

        'oauth' => 'src'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'oauth'
    ],
];
