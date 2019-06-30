<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />

    <meta name="description" content="MiPaPo,Mitarbeiter Pausen Pool">
    <meta name="keywords" content="MiPaPo,Web,Tool,Lunch Break">
    
    <!-- !!! DON'T EVEN THING ABOUT CHANGING THIS NAME !!! -->
    <meta name="author" content="Eric Heinzl">
    <!-- !!! I SURE WILL FIND YOU !!! -->
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=0" name="viewport" />
    {{ Html::style('css/main.css') }}
    <title>@yield('title')</title>
</head>
<body>
    @yield('style')

    @yield('content')

    @yield('javascript')
</body>
</html>
