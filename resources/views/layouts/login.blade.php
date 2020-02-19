<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('partials._head')
    </head>
    <body style="
        background-image: url('https://source.unsplash.com/1280x720/daily?programming');
        background-repear: no-repeat;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat">
        
        @include('partials._javascript')

        @include('partials._messages')

        <div class="wrapper">
            
            <div class="content mt-0 pt-3 pb-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-5">

                                    {{-- Card --}}
                                    <div class="card">
                                        <div class="card-body pb-1">
                                            {{-- Header --}}
                                            <div class="h2 pb-2">
                                                <div class="row">
                                                    <div class="col">
                                                        @yield('headline')
                                                    </div>
                                                </div>
                                            </div>
                                            @yield('content')

                                            <hr class="my-2">

                                            <div class="text-center py-0">
                                                <div class="row">
                                                    @foreach (language()->allowed() as $code => $name)
                                                        @if (app()->getLocale() != $code)
                                                        <div class="col px-0">
                                                            <a class="btn btn-link text-dark py-1 px-0" href="{{ language()->back($code) }}">
                                                                {!! language()->flag($code) !!} &nbsp; {{ $name }}
                                                            </a>
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
