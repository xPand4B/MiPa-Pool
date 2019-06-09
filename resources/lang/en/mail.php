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

    'regards' => 'Regards',

    'subcopy' => "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below into your web browser: [:actionURL](:actionURL)",

    'verify' => [
        'subject'   => config('app.name') . ' - Email Verification',
        'line'      => 'Please click the button below to verify your email address.',
        'action'    => 'Verify Email',
    ],

];
