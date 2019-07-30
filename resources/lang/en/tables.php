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
        'participate'     => 'Participate',

        'deliveryService' => 'Delivery Service',

        'head' => [
            'name'      => 'Name',
            'menu'      => 'Menu',
            'number'    => 'Number',
            'comment'   => 'Comment',
            'price'     => 'Price'
        ],

        'footer' => [
            'closed'        => 'Closed',
            'people_count'  => 'People',
        ],

        'empty' => 'Sorry, but this order seems to be empty. ¯\_(ツ)_/¯'
    ],

    // Management Table
    'management' => [
        'head' => [
            'name'              => 'Name',

            'deliveryService'   => 'Delivery Service',
            'deadline'          => 'Deadline',
            'createdAt'         => 'Created',
            'updatedAt'         => 'Updated',

            'number'            => 'Number',
            'price'             => 'Price (in '.config('app.currency').')',
        ],

        'buttons' => [
            'edit'      => 'Edit',
            'close'     => 'Close',
            'show'      => 'View',
            'delete'    => 'Delete'
        ]
    ],
];