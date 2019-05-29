<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('partials._head')
    </head>
    <body>
        <div class="wrapper">
            
            @include('partials._sidenav')

            {{-- https://webgradients.com/ --}}
            <div class="main-panel" style="background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
            {{-- <div class="main-panel" style="background-color: #E4E4E1;background-image: radial-gradient(at top center, rgba(255,255,255,0.03) 0%, rgba(0,0,0,0.03) 100%), linear-gradient(to top, rgba(255,255,255,0.1) 0%, rgba(143,152,157,0.60) 100%);background-blend-mode: normal, multiply;"> --}}
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
        
        @include('partials._javascript')
    </body>
</html>
