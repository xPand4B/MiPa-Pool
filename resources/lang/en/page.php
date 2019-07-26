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
        'title'  => 'Orders',

        'manage' => 'Manage',

        'index' => [
            'empty' => [
                'title'     => "Upps, pretty empty here. ¯\_(ツ)_/¯",
                'message'   => "If you want to create an order click the ".config('icons.addOrder')." icon.",
            ],
        ],

        'create' => [
            'title' => 'Create Order',
            
            'card'  => [
                'title' => 'Create Order',
            ],
        ],

        'participate'   => [
            'title'     => 'Order informations',

            'created_by'        => 'Creator',
            'people'            => 'Participants',
            'deadline'          => 'Deadline',
            'time'              => "o'clock",
            'minimum_value'     => 'Minimum Value',
            'delivery_service'  => 'Delivery Service',

            'other_participants' => 'Other participants',
        ],
    ],

    // Manage Orders Page
    'manage' => [
        'title' => 'Management',

        'headline' => [
            'orders'    => 'Manage your orders',
            'menus'     => 'Manage your menus',
        ],

        'show' => [
            'noTimeLeft'    => 'Closed',
        ],
    ],

    // Profile Page
    'profile' => [
        'title' => 'Profile',
        
        'stats' => [
            'headline'  => 'Statistics',
            'spend'     => 'Spend',
            'orders'    => 'Orders',
            'month'     => 'This month',
        ]
    ],

    // Search Page
    'search' => [
        'title' => 'Search',
        
        'empty' => "Upps, seems like we couldn't find any :type ¯\_(ツ)_/¯",
    ],

    'tabpages' => [
        'orders'    => 'Orders',
        'menus'     => 'Menus',
        'users'     => 'Users',
    ],

    'mysticModal' => "Congratulation, you've found an easteregg.<br>Can you find all of them?",
];
