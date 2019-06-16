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
        'title' => 'Bestellungen',

        'breadcrumb' => [
            'index'       => 'Bestellungen',
            'create'      => 'Erstellen',
            'participate' => 'Mitbestellen'
        ],

        'index' => [
            'empty' => [
                'title' => 'Upps, ziemlich leer hier. ¯\_(ツ)_/¯',
                'message' => 'Wenn du eine Bestellung erstellen möchtest klicke auf das <i class="fa fa-plus-square-o"></i> Icon.',
            ],
        ],

        'create' => [
            'title' => 'Bestellung erstellen',
            
            'card'  => [
                'title' => 'Bestellung erstellen',
            ],

            'form'  => [
                'order_name'            => 'Name der Bestellung',
                'deadline'              => 'Laufzeit bis',
                'time'                  => 'Uhr',
                'max_orders'            => 'Mitbesteller',
                'people'                => '',
                'minimum_order_value'   => 'Mindestbestellwert',
                'delivery_service'      => 'Lieferdienst',
                'site_link'             => 'Speisekarte',
                'submit'                => 'Bestellung erstellen',
            ],
        ],

        'participate' => [
            'title'         => 'Bestellinformationen',

            'created_by'        => 'Ersteller',
            'people'            => 'Mitbesteller',
            'deadline'          => 'Deadline',
            'time'              => 'Uhr',
            'minimum_value'     => 'Mindestbestellwert',
            'delivery_service'  => 'Lieferservice',

            'other_participants' => 'Andere Mitbesteller',

            'form' => [
                'name'      => 'Menü Name',
                'number'    => 'Anzahl',
                'price'     => 'Gesamt Preis (in '.config('app.currency').')',
                'comment'   => 'Kommentar',
                'submit'    => 'Menü bestellen'
            ]
        ],
    ],

    // Manage Orders Page
    'manage' => [
        'title' => 'Verwaltung',

        'breadcrumb' => [
            'index'       => 'Verwaltung',
        ],

        'index' => [
            'headline' => 'Verwalte deine Bestellungen',

            'tableHeads' => [
                'name'              => 'Name',
                'deliveryService'   => 'Lieferdienst',
                'deadline'          => 'Laufzeit',
                'createdAt'         => 'Erstellung'
            ],

            'tableButtons' => [
                'edit'      => 'Bestellung bearbeiten',
                'close'     => 'Bestellung schließen',
                'delete'    => 'BEstellung löschen'
            ]
        ],
    ],

    // Profile Page
    'profile' => [
        'title' => 'Profil',
        
        'breadcrumb' => [
            'index'  => 'Profil'
        ],
        
        'form' => [
            'headline'          => 'Profil bearbeiten',
            'username'          => 'Username',
            'firstname'         => 'Name',
            'surname'           => 'Nachname',
            'email'             => 'E-Mail',
            'password'          => 'Passwort',
            'confirm_password'  => 'Passwort bestätigen',
            'about_me'          => 'Über mich',
            'avatar'            => [
                'label'  => 'Wähle ein Bild',
                'helper' => 'Bitte wähle ein gültiges Bild aus. Es sollte nicht größer als 2MB sein.'
            ],
            'reset_avatar'      => 'Bild zurücksetzten',
            'submit'            => 'Profil aktualisieren'
        ],
        
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

        'breadcrumb' => [
            'index' => 'Suche'
        ],
        
        'tabpages' => [
            'orders'    => 'Bestellungen',
            'menus'     => 'Menüs',
            'users'     => 'Nutzer',
        ],
        
        'empty' => "Upps, sieht so aus als ob wir keine :type gefunden haben ¯\_(ツ)_/¯"
    ],

    'mysticModal' => "Glückwunsch, du hast ein Easteregg gefunden.<br>Schaffst du es sie alle zu finden?",
];
