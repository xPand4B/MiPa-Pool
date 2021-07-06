<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('app.head')

<title>{{ config('app.name') }}</title>

<!-- Fonts -->
@section('app.fonts')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
@show
@yield('app.fonts')

<!-- Styles -->
@section('app.stylesheets')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
@show
@yield('app.stylesheets')


<!-- Scripts -->
@section('app.scripts')
    <script src="{{ mix('js/app.js') }}" defer></script>
@show
@yield('app.scripts')
