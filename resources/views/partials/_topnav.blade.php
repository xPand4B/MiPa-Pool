<nav class="navbar navbar-expand-lg sticky-top m-0 p-0">
    <div class="container-fluid">

        {{-- Navbar Brand --}}
        <div class="navbar-wrapper">
            <a class="navbar-brand"></a>
            @yield('headline')
        </div>

        {{-- Mobile Menu --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end">
            {{-- Search --}}
            <form class="navbar-form" action="{{ route('search.show') }}" method="GET" role="search">
                {{-- <div class="input-group no-border">
                    <input name="q" id="q" type="text" class="form-control" placeholder="{{ trans('menu.top.search') }}" value="{{ request('q') }}">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div> --}}
            </form>
            
            <ul class="navbar-nav">
                {{-- Add order --}}
                <li class="nav-item">
                    <a href="{{ route('order.create') }}" class="nav-link" title="{{ trans('menu.top.create_order') }}">
                        <i class="fa fa-plus-square-o"></i>
                        <p class="d-lg-none d-md-block">@lang('menu.top.create_order')</p>
                    </a>
                </li>

                {{-- Notifications --}}
                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="{{ trans('menu.top.notifications') }}">
                        <i class="material-icons">notifications</i>
                        <span class="notification">5</span>
                        <p class="d-lg-none d-md-block">@lang('menu.top.notifications')</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <a href="#" class="dropdown-item">Test</a>
                        <a href="#" class="dropdown-item">Test</a>
                        <a href="#" class="dropdown-item">Test</a>
                        <a href="#" class="dropdown-item">Test</a>
                    </div>
                </li> --}}

                {{-- Logout --}}
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" title="{{ trans('menu.top.logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="material-icons">power_settings_new</i>
                        <p class="d-lg-none d-md-block">@lang('menu.top.logout')</p>
                    </a>

                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>
