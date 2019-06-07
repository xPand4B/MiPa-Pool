<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('partials._head')
    </head>
    <body>
        @include('partials._javascript')
        
        <div class="wrapper">    
            @include('partials._sidenav')

            {{-- https://webgradients.com/ --}}
            <div class="main-panel" style="background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
                @include('partials._topnav')
                @include('partials._messages')

                <div class="content mt-0 pt-3 pb-0 px-0">
                    <div class="container-fluid">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>

                @include('partials._footer')
            </div>
        </div>
    </body>
</html>
