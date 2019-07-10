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

        'breadcrumb' => [
            'index'         => 'Orders',
            'create'        => 'Create',
            'participate'   => 'Participate'
        ],

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
            
            'form'  => [
                'order_name'            => 'Order name',
                'deadline'              => 'Deadline',
                'time'                  => "o'clock",
                'max_orders'            => 'Participants',
                'minimum_order_value'   => 'Min. Value',
                'delivery_service'      => 'Delivery Service',
                'site_link'             => 'Menu-card',
                'submit'                => 'Create Order'
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

            'form' => [
                'name'      => 'Menu Name',
                'number'    => 'How much do you want?',
                'price'     => 'Total Price (in '.config('app.currency').')',
                'comment'   => 'Comment',
                'submit'    => 'Add to order'
            ]
        ],
    ],

    // Manage Orders Page
    'manage' => [
        'title' => 'Management',

        'empty' => [
            'title'     => "Upps, seems like you haven't created an order yet ¯\_(ツ)_/¯",
            'message'   => 'If you want to create an order click the '.config('icons.addOrder').' icon.',
        ],

        'breadcrumb' => [
            'index'     => 'Management',
            'orders'    => 'Orders',
            'menus'     => 'Menus',
        ],

        'headline' => [
            'orders'    => 'Manage your orders',
            'menus'     => 'Manage your menus',
        ],

        'tableHeads' => [
            'name'              => 'Name',

            'deliveryService'   => 'Delivery Service',
            'deadline'          => 'Deadline',
            'createdAt'         => 'Created',
            'updatedAt'         => 'Updated',

            'number'            => 'Number',
            'price'             => 'Price (in '.config('app.currency').')',
        ],

        'tableButtons' => [
            'edit'      => 'Edit',
            'close'     => 'Close',
            'show'      => 'View',
            'delete'    => 'Delete'
        ],

        'show' => [
            'noTimeLeft'    => 'Closed',
        ],

        'edit' => [
            'form'  => [
                'order_name'            => 'Order name',
                'deadline'              => 'Deadline',
                'time'                  => "o'clock",
                'max_orders'            => 'Participants',
                'minimum_order_value'   => 'Min. Value',
                'delivery_service'      => 'Delivery Service',
                'site_link'             => 'Menu-card',

                'menu_name'             => 'Menu Name',
                'number'                => 'How much do you want?',
                'price'                 => 'Total Price (in '.config('app.currency').')',
                'comment'               => 'Comment',

                'submit'                => 'Save changes',
            ],
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
                'label'         => 'Choose a picture',
                'helper'        => 'Please upload a valid image file. Size of image should not be more than 2MB.'
            ],
            'reset_avatar'      => 'Reset avatar',
            'submit'            => 'Update profile'
        ],
        
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

        'breadcrumb' => [
            'index'  => 'Search'
        ],
        
        'empty' => "Upps, seems like we couldn't find any :type ¯\_(ツ)_/¯",
    ],

    'tabpages' => [
        'orders'    => 'Orders',
        'menus'     => 'Menus',
        'users'     => 'Users',
    ],

    'mysticModal' => "Congratulation, you've found an easteregg.<br>Can you find all of them?",
];
