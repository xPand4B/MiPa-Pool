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
        'title' => 'Orders',

        'breadcrumb' => [
            'index'       => 'Orders',
            'create'      => 'Create',
            'participate' => 'Participate'
        ],

        'create' => [
            'title' => 'Create Order',
            
            'card'  => [
                'title' => 'Create Order',
            ],

            'form'  => [
                'order_name'            => 'Name',
                'deadline'              => 'Laufzeit bis',
                'time'                  => '',
                'max_orders'            => 'Participants',
                'people'                => '',
                'currency'              => '€',
                'minimum_order_value'   => 'Minimum Value',
                'delivery_service'      => 'Delivery Service',
                'site_link'             => 'Menu-card',
                'submit'                => 'Create Order',
            ],
        ],

        'participate' => [
            
        ],
    ],
    // Profile Page
    'profile' => [
        'title' => 'Profile',
        
        'breadcrumb' => [
            'index'  => 'Profile'
        ],
        
        'form' => [
            'headline'          => 'Edit your profile',
            'username'          => 'Username',
            'firstname'         => 'Firstname',
            'surname'           => 'Surname',
            'email'             => 'E-Mail',
            'password'          => 'Password',
            'confirm_password'  => 'Confirm password',
            'about_me'          => 'About me',
            'submit'            => 'Update profile'
        ],
        
        'stats' => [
            'headline'  => 'Statistics',
            'spend'     => 'Spend',
            'orders'    => 'Orders',
            'month'     => 'This month',
        ]
    ],
    
    // Imprint Page
    'imprint' => [
        'title'      => 'Imprint',

        'headline'   => 'Imprint',
        
        'breadcrumb' => [
            'index'  => 'Imprint',
        ]
    ],
    
    // Privacy Policy Page
    'privacy_policy' => [
        'title'      => 'Privacy Policy',
        
        'headline'   => 'Privacy Policy',
        
        'breadcrumb' => [
            'index'  => 'Privacy Policy',
        ]
    ],
];
