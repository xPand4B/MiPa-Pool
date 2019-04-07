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

        'index' => [
            'empty' => [
                'title' => "Upps, pretty empty here. ¯\_(ツ)_/¯",
                'message' => 'If you want to create an order click the <i class="fa fa-plus-square-o"></i> icon.',
            ],
        ],

        'create' => [
            'title' => 'Create Order',
            
            'card'  => [
                'title' => 'Create Order',
            ],
            
            'mysticModal01' => "Congratulation, you've found an easteregg.",

            'form'  => [
                'order_name'            => 'Order name',
                'deadline'              => 'Deadline',
                'time'                  => '',
                'max_orders'            => 'Max. Participants',
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
            'avatar'            => [
                'label'  => 'Choose a picture...',
                'helper' => 'Please upload a valid image file. Size of image should not be more than 2MB.'
            ],
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
    ],
    
    // Privacy Policy Page
    'privacy_policy' => [
        'title'      => 'Privacy Policy',
    ],
];
