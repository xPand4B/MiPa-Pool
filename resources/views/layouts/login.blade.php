<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('partials._head')
    </head>
    <body>
        <div class="wrapper">
            <div class="content mt-0 pt-3 pb-0">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        @include('partials._javascript')
    </body>
</html>