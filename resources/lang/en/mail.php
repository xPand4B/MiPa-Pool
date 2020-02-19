<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain all mail relevant messages.
    |
    */

    'greeting' => [
        'normal'    => 'Hello',
        'error'     => 'Whoops! Something went wrong!',
    ],

    'regards' => 'Regards,<br>the :name Team',

    'subcopy' => "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below into your web browser: [:actionURL](:actionURL)",

    'verify' => [
        'subject'   => config('app.name') . ' - Email Verification',
        'line'      => 'Please click the button below to verify your email address.',
        'action'    => 'Verify Email',
    ],

    'reset' => [
        'subject'       => config('app.name') . ' - Reset Password',
        'introLines'    => [
            '01' => 'You are receiving this email because we received a password reset request for your account.',
        ],
        'action'        => 'Reset Password',
        'outroLines'    => [
            '01' => 'This password reset link will expire in :time minutes.',
            '02' => 'If you did not request a password reset, no further action is required.'
        ],
    ],

];
