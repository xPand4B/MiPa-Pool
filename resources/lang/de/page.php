<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Page Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain all page specific content such as
    | the title, headline/breadcrumb, etc.
    |
    */

    // Order Pages
    'orders' => [
        'title'  => 'Bestellungen',

        'manage' => 'Verwalten',

        'index' => [
            'empty' => [
                'title'     => 'Upps, ziemlich leer hier. ¯\_(ツ)_/¯',
                'message'   => "Wenn du eine Bestellung erstellen möchtest klicke auf das ".config('icons.addOrder')." Icon.",
            ],
        ],

        'create' => [
            'title' => 'Bestellung erstellen',
            
            'card'  => [
                'title' => 'Bestellung erstellen',
            ],
        ],

        'participate'   => [
            'title'     => 'Bestellinformationen',

            'created_by'        => 'Ersteller',
            'people'            => 'Mitbesteller',
            'deadline'          => 'Deadline',
            'time'              => 'Uhr',
            'minimum_value'     => 'Mindestbestellwert',
            'delivery_service'  => 'Lieferservice',

            'other_participants' => 'Andere Mitbesteller',
        ],
    ],

    // Manage Orders Page
    'manage' => [
        'title' => 'Verwaltung',

        'headline' => [
            'orders'    => 'Verwalte deine Bestellungen',
            'menus'     => 'Verwalte deine Menüs',
        ],
        
        'show' => [
            'noTimeLeft'    => 'Closed',
        ],
    ],

    // Profile Page
    'profile' => [
        'title' => 'Profil',
        
        'stats' => [
            'headline'  => 'Statistiken',
            'spend'     => 'Ausgegeben',
            'orders'    => 'Bestellungen',
            'month'     => 'Diesen Monat',
        ]
    ],

    // Search Page
    'search' => [
        'title' => 'Suche',
        
        'empty' => "Upps, sieht so aus als ob wir keine :type gefunden haben ¯\_(ツ)_/¯",
    ],

    'tabpages' => [
        'orders'    => 'Bestellungen',
        'menus'     => 'Menüs',
        'users'     => 'Nutzer',
    ],

    'mysticModal' => "Glückwunsch, du hast ein Easteregg gefunden.<br>Schaffst du es sie alle zu finden?",
];
