<meta charset="utf-8"/>
<!-- !!! DON'T EVEN THING ABOUT CHANGING THIS NAME !!! -->
<meta name="author" content="Eric Heinzl">
<!-- !!! I SURE WILL FIND YOU !!! -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, shrink-to-fit=no, user-scalable=0" name="viewport"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>

<!-- CSS -->
@section('master.stylesheet')
    <link type="text/css" rel="stylesheet" href="{{ url(asset('css/app.css')) }}"/>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"/>
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css"/>
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}"/>
@show
