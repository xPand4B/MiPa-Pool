<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Brand Icon
    |--------------------------------------------------------------------------
    |
    | Here you can set the path and name of the brand icon.
    |
    */

    'brand-icon' => [
        'fileName' => env('BRAND_ICON'),
        'path'     => 'src/Frontend/Resources/public/brand-icon/'.env('BRAND_ICON'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Profile Avatars
    |--------------------------------------------------------------------------
    |
    | Here you can set the name for the default profile avatar.
    |
    */

    'avatar' => [
        'path'      => 'src/Frontend/Resources/public/avatars/',
        'default'   => 'default.svg'
    ],
];
