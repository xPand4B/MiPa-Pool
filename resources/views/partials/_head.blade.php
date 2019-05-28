<meta charset="utf-8" />

<meta name="description" content="MiPaPo,Mitarbeiter Pausen Pool">
<meta name="keywords" content="MiPaPo,Web,Tool,Lunch Break">

<meta name="author" content="Eric Heinzl">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=0" name="viewport" />
{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{ Html::style('css/main.css') }}
@yield('stylesheet')

<title>
    {{ config('app.name', 'MiPa-Pool') }} 

    @hasSection ('title')
        | @yield('title')        
    @endif
</title>
