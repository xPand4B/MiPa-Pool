<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Form Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain all form specific content, listed
    | per page.
    |
    */

    // Orders pages
    'orders' => [

        'create' => [
            'order_name'            => 'Name der Bestellung',
            'deadline'              => 'Laufzeit bis',
            'time'                  => 'Uhr',
            'max_orders'            => 'Mitbesteller',
            'minimum_order_value'   => 'Mindestbestellwert',
            'delivery_service'      => 'Lieferdienst',
            'site_link'             => 'Speisekarte',
            'submit'                => 'Bestellung erstellen',
        ],

        'participate' => [
            'name'      => 'Menü Name',
            'number'    => 'Anzahl',
            'price'     => 'Gesamt Preis (in '.config('app.currency').')',
            'comment'   => 'Kommentar',
            'submit'    => 'Menü bestellen'
        ],
    ],

    // Management pages
    'manage' => [
        'edit' => [
            'order_name'            => 'Name der Bestellung',
            'deadline'              => 'Laufzeit bis',
            'time'                  => 'Uhr',
            'max_orders'            => 'Mitbesteller',
            'minimum_order_value'   => 'Mindestbestellwert',
            'delivery_service'      => 'Lieferdienst',
            'site_link'             => 'Speisekarte',

            'order_name'            => 'Menü Name',
            'number'                => 'Anzahl',
            'price'                 => 'Gesamt Preis (in '.config('app.currency').')',
            'comment'               => 'Kommentar',

            'submit'                => 'Änderungen Speichern'
        ]
    ],

    // Profile page
    'profile' => [
        'headline'          => 'Profil bearbeiten',
        'username'          => 'Username',
        'firstname'         => 'Name',
        'surname'           => 'Nachname',
        'email'             => 'E-Mail',
        'password'          => 'Passwort',
        'confirm_password'  => 'Passwort bestätigen',
        'about_me'          => 'Über mich',
        'avatar'            => [
            'label'         => 'Wähle ein Bild',
            'helper'        => 'Bitte wähle ein gültiges Bild aus. Es sollte nicht größer als 2MB sein.'
        ],
        'reset_avatar'      => 'Bild zurücksetzten',
        'submit'            => 'Profil aktualisieren'
    ]
];
