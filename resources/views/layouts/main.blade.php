<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('partials._head')
    </head>
    <body>
        <div class="wrapper">
            
            @include('partials._sidenav')

            <div class="main-panel">
                @include('partials._topnav')
                @include('partials._messages')

                <div class="content mt-0 pt-3 pb-0">
                    <div class="container-fluid">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>

                @include('partials._footer')
            </div>
        </div>
        
        @include('partials._javascript')
    </body>
</html>