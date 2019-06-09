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
        'normal'    => 'Hallo',
        'error'     => 'Upps! Da lief was schief!,',
    ],

    'regards' => 'Freundlich Grüße',

    'subcopy' => "Wenn du Probleme hast den Button \":actionText\" zu drücken kopiere dir den folgenden Link und füge ihn in deinem Browser ein: [:actionURL](:actionURL)",

    'verify' => [
        'subject'   => config('app.name') . ' - Email Bestätigung',
        'line'      => 'Bitte klicke auf den unten stehenden Button um deine Email zu bestätigen',
        'action'    => 'Email Bestätigen',
    ],

];
