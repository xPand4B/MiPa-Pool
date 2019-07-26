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
            'order_name'            => 'Order name',
            'deadline'              => 'Deadline',
            'time'                  => "o'clock",
            'max_orders'            => 'Participants',
            'minimum_order_value'   => 'Min. Value',
            'delivery_service'      => 'Delivery Service',
            'site_link'             => 'Menu-card',
            'submit'                => 'Create Order'
        ],

        'participate' => [
            'name'      => 'Menu Name',
            'number'    => 'How much do you want?',
            'price'     => 'Total Price (in '.config('app.currency').')',
            'comment'   => 'Comment',
            'submit'    => 'Add to order'
        ],
    ],

    // Management pages
    'manage' => [
        'edit' => [
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
        ]
    ],

    // Profile page
    'profile' => [
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
    ]
];
