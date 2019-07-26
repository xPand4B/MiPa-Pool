<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute muss akzeptiert werden.',
    'active_url'           => ':attribute ist keine gültige URL.',
    'after'                => ':attribute muss ein Datum nach dem :date sein.',
    'after_or_equal'       => ':attribute muss ein Datum nach oder identisch zu dem :date sein.',
    'alpha'                => ':attribute darf nur Buchstaben beinhalten.',
    'alpha_dash'           => ':attribute darf nur Buchstaben, Nummern, Binde- und Unterstriche beinhalten.',
    'alpha_num'            => ':attribute darf nur Buchstaben und Nummern beinhalten.',
    'array'                => ':attribute muss ein Array sein.',
    'before'               => ':attribute muss ein Datum vor dem :date sein.',
    'before_or_equal'      => ':attribute muss ein Datum vor oder identisch zu dem :date sein.',
    'between'              => [
        'numeric' => ':attribute muss zwischen :min und :max sein.',
        'file'    => ':attribute muss zwischen :min und :max kilobytes liegen.',
        'string'  => ':attribute muss zwischen :min und :max Zeichen beinhalten.',
        'array'   => ':attribute muss zwischen :min und :max Einträge haben.',
    ],
    'boolean'              => 'Das :attribute Feld darf nur true oder false sein.',
    'confirmed'            => 'Die :attribute Bestätigung stimmt nicht überein.',
    'date'                 => ':attribute ist kein gültiges Datum.',
    'date_format'          => ':attribute entspricht nicht dem Format :format.',
    'different'            => ':attribute und :other müssen unterschiedlich sein.',
    'digits'               => ':attribute muss :digits Zahlen beinhalten.',
    'digits_between'       => ':attribute muss zwischen :min und :max Zahlen beinhalten.',
    'dimensions'           => ':attribute hat ungültige Bilddimensionen.',
    'distinct'             => ':attribute hat einen doppelten Wert.',
    'email'                => ':attribute muss eine gültige Email sein.',
    'exists'               => 'Der ausgewählte Wert :attribute ist ungültig.',
    'file'                 => ':attribute muss eine Datei sein.',
    'filled'               => ':attribute darf nicht leer bleiben.',
    'gt'                   => [
        'numeric' => ':attribute muss höher als :value sein.',
        'file'    => ':attribute muss mehr als :value kilobytes groß sein.',
        'string'  => ':attribute muss mehr als :value Zeichen beinhalten.',
        'array'   => ':attribute muss mehr als :value Einträge beinhalten.',
    ],
    'gte'                  => [
        'numeric' => ':attribute muss größer oder gleich :value sein.',
        'file'    => ':attribute muss größer oder gleich :value kilobytes sein.',
        'string'  => ':attribute muss größer oder gleich :value Zeichen beinhalten.',
        'array'   => ':attribute muss mindestens :value Einträge haben.',
    ],
    'image'                => ':attribute muss ein Bild sein.',
    'in'                   => 'Der ausgewählte Wert :attribute ist ungültig.',
    'in_array'             => ':attribute ist in :other nicht vorhanden.',
    'integer'              => ':attribute muss eine ganze Zahl sein.',
    'ip'                   => ':attribute muss eine gültige IP sein.',
    'ipv4'                 => ':attribute muss eine gültige IPv4 sein.',
    'ipv6'                 => ':attribute muss eine gültige IPv6 sein.',
    'json'                 => ':attribute muss ein gültiger JSON string sein.',
    'lt'                   => [
        'numeric' => ':attribute muss kleiner als :value sein.',
        'file'    => ':attribute muss kleiner als :value kilobytes sein.',
        'string'  => ':attribute muss kleiner als :value Zeichen sein.',
        'array'   => ':attribute muss weniger als :value Einträge beinhalten.',
    ],
    'lte'                  => [
        'numeric' => ':attribute muss kleiner oder gleich :value sein.',
        'file'    => ':attribute muss kleiner oder gleich :value kilobytes sein.',
        'string'  => ':attribute muss kleiner oder gleich :value Zeichen sein.',
        'array'   => ':attribute darf nicht mehr als :value Einträge beinhalten.',
    ],
    'max'                  => [
        'numeric' => ':attribute darf nicht größer als :max sein.',
        'file'    => ':attribute darf nicht größer als :max kilobytes sein.',
        'string'  => ':attribute darf nicht größer als :max Zeichen sein.',
        'array'   => ':attribute darf nicht mehr als :max Einträge beinhalten.',
    ],
    'mimes'                => ':attribute muss folgenden Dateitypen haben: :values.',
    'mimetypes'            => ':attribute muss folgenden Dateitypen haben: :values.',
    'min'                  => [
        'numeric' => ':attribute muss mindestens :min sein.',
        'file'    => ':attribute muss mindestens :min kilobytes groß sein.',
        'string'  => ':attribute muss mindestens :min Zeichen besitzten.',
        'array'   => ':attribute muss mindestens :min Einträge beinhalten.',
    ],
    'not_in'               => 'Der ausgewählte Wert :attribute ist ungültig.',
    'not_regex'            => 'Das Format von :attribute ist ungültig.',
    'numeric'              => ':attribute muss eine Nummer sein.',
    'present'              => 'Das Feld :attribute muss vorhanden sein.',
    'regex'                => 'Das Format von :attribute ist ungültig.',
    'required'             => ':attribute ist erforderlich.',
    'required_if'          => ':attribute ist erforderlich wenn :other :value entspricht.',
    'required_unless'      => ':attribute ist erforderlich solange :other in :values ist.',
    'required_with'        => ':attribute ist erforderlich wenn :values vorhanden ist.',
    'required_with_all'    => ':attribute ist erforderlich wenn :values vorhanden ist.',
    'required_without'     => ':attribute ist erforderlich wenn :values nicht vorhanden ist.',
    'required_without_all' => ':attribute ist erforderlich wenn nichts von :values vorhanden ist.',
    'same'                 => ':attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => ':attribute muss :size sein.',
        'file'    => ':attribute muss :size kilobytes groß sein.',
        'string'  => ':attribute muss :size Zeichen haben.',
        'array'   => ':attribute muss :size Einträge beinhalten.',
    ],
    'string'               => ':attribute muss eine Zeichenfolge sein.',
    'timezone'             => ':attribute muss eine gültige Zeitzone sein.',
    'unique'               => ':attribute ist bereits vergeben.',
    'uploaded'             => ':attribute konnte nicht hochgeladen werden.',
    'url'                  => 'Das Format von :attribute ist ungültig.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
