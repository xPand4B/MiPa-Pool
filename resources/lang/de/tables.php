<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain all table specific translations.
    | This includes tableheads, buttons and footer descriptions.
    |
    */

    // Order Table
    'orders' => [
        'participate'     => 'Mitbestellen',

        'deliveryService' => 'Lieferservice',

        'head' => [
            'name'      => 'Name',
            'menu'      => 'Menü',
            'number'    => 'Anzahl',
            'comment'   => 'Kommentar',
            'price'     => 'Preis',
        ],

        'footer' => [
            'closed'        => 'Geschlossen',
            'people_count'  => 'Personen',
        ],

        'empty' => 'Tut uns leid, aber diese Bestellung scheint leer zu sein. ¯\_(ツ)_/¯'
    ],

    // Management Table
    'management' => [
        'head' => [
            'name'              => 'Name',
    
            'deliveryService'   => 'Lieferdienst',
            'deadline'          => 'Laufzeit',
            'createdAt'         => 'Erstellung',
            'updatedAt'         => 'Aktualisiert',
    
            'number'            => 'Anzahl',
            'price'             => 'Preis (in '.config('app.currency').')',
        ],

        'buttons' => [
            'edit'      => 'Bearbeiten',
            'close'     => 'Schließen',
            'show'      => 'Ansehen',
            'delete'    => 'Löschen'
        ]
    ],
];