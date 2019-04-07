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

            'mysticModal01' => 'Glückwunsch, du hast ein Easteregg gefunden.',

            'form'  => [
                'order_name'            => 'Name der Bestellung',
                'deadline'              => 'Laufzeit bis',
                'time'                  => 'Uhr',
                'max_orders'            => 'Max. Mitbesteller',
                'people'                => '',
                'currency'              => '€',
                'minimum_order_value'   => 'Mindestbestellwert',
                'delivery_service'      => 'Lieferdienst',
                'site_link'             => 'Speisekarte',
                'submit'                => 'Bestellung erstellen',
            ],
        ],

        'participate' => [
            
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
                'label'  => 'Wähle ein Bild aus...',
                'helper' => 'Bitte wähle ein gültiges Bild aus. Es sollte nicht größer als 2MB sein.'
            ],
            'submit'            => 'Profil aktualisieren'
        ],
        
        'stats' => [
            'headline'  => 'Statistiken',
            'spend'     => 'Ausgegeben',
            'orders'    => 'Bestellungen',
            'month'     => 'Diesen Monat',
        ]
    ],
    
    // Imprint Page
    'imprint' => [
        'title'      => 'Impressum',
    ],
    
    // Privacy Policy Page
    'privacy_policy' => [
        'title'      => 'Datenschutzerklärung',
    ],
];
