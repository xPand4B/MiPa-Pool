<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=0" name="viewport" />
{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{ Html::style('css/app.css') }}
@yield('stylesheet')

<title>{{ config('app.name', 'MiPa-Pool') }} @yield('title')</title>