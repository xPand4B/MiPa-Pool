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

    'regards' => 'Freundlich Grüße,<br>das :name Team',

    'subcopy' => "Wenn du Probleme hast den Button \":actionText\" zu drücken kopiere dir den folgenden Link und füge ihn in deinem Browser ein: [:actionURL](:actionURL).",

    'verify' => [
        'subject'   => config('app.name') . ' - Email Bestätigung',
        'line'      => 'Bitte klicke auf den unten stehenden Button um deine Email zu bestätigen.',
        'action'    => 'Email Bestätigen',
    ],

    'reset' => [
        'subject'       => config('app.name') . ' - Passwort zurücksetzten',
        'introLines'    => [
            '01' => 'Du erhältst diese Email da wir eine Anfrage erhalten haben dein Passwort zurückzusetzten.',
        ],
        'action'        => 'Passwort zurücksetzten',
        'outroLines'    => [
            '01' => 'Dieser Link wird in :time Minuten ungültig.',
            '02' => 'Wenn du diese Anfrage nicht gestellt hast sind keine weiteren Aktionen erforderlich',
        ],
    ],

];
