@php
    $templates = [
        'vampire',
        'lost',
        'space-invader',
        'heart',
        'space',
];

$randIndex = array_rand($templates);
$include = 'errors.404-templates.'.$templates[$randIndex];
@endphp

@include($include)
