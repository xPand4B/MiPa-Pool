<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=0" name="viewport" />
{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{ Html::style('css/main.css') }}
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
@yield('stylesheet')

<title>{{ config('app.name', 'MiPa-Pool') }} @yield('title')</title>