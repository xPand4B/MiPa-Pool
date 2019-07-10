{{-- Data-Colors: primary, info, success, warning, danger, rose, white --}}
{{-- If you want to add another color you need to create as custom css --}}
{{-- Other parameters: data-image="{{ asset('img/<PATH TO IMAGE>') }}" --}}
<div class="sidebar" data-color="primary" data-background-color="black">

        <!-- Brand Name -->
        <div class="logo">
            <a href="{{ route('home') }}" class="simple-text logo-normal">
                {{-- Brand Icon --}}
                @if (config('filesystems.brand-icon.fileName'))
                    @if (file_exists(public_path(config('filesystems.brand-icon.path'))))
                    <img src="{{ asset(config('filesystems.brand-icon.path')) }}" alt="{{ config('app.name', 'MiPa-Pool') }}" width="32px" height="32px" style="border-radius: 16px">
                    @endif
                @endif

                {{ config('app.name', 'MiPa-Pool') }}
            </a>
        </div>
    
        <div class="sidebar-wrapper">
            <ul class="nav">
                {{-- Home --}}
                <li class="nav-item {{ Nav::isRoute('home') }} {{ Nav::hasSegment('orders') }}">
                    <a href="{{ route('home') }}" class="nav-link">
                        {!! config('icons.home') !!}
                        <p>@lang('menu.side.home')</p>
                    </a>
                </li>
    
                {{-- User Profil --}}
                <li class="nav-item {{ Nav::hasSegment('profile') }}">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        {!! config('icons.profile') !!}
                        <p>@lang('menu.side.profile')</p>
                    </a>
                </li>

                {{-- Management --}}
                @if (Auth::user()->hasOrders() || Auth::user()->hasMenus())
                    <div class="nav-collection">

                        {{-- Manage Index --}}
                        <li class="nav-parent">
                            <a class="nav-link">
                                <p>
                                    {!! config('icons.settings') !!}
                                    @lang('menu.side.manage.index')
                                </p>
                            </a>
                        </li>

                        {{-- Manage Orders --}}
                        @if (Auth::user()->hasOrders())
                            <li class="nav-item {{ Nav::isRoute('manage.orders.index') }}">
                                <a href="{{ route('manage.orders.index') }}" class="nav-link nav-child">
                                    {!! config('icons.shopping-cart') !!}
                                    <p>
                                        <span class="badge badge-pill badge-light">{{ sizeof(Auth::user()->orders) }}</span>
                                        @lang('menu.side.manage.orders')
                                    </p>
                                </a>
                            </li>
                        @endif

                        {{-- Manage Menus --}}
                        @if (Auth::user()->hasMenus())
                            <li class="nav-item {{ Nav::isRoute('manage.menus.index') }}">
                                <a href="{{ route('manage.menus.index') }}" class="nav-link nav-child">
                                    {!! config('icons.fastfood') !!}
                                    <p>
                                        <span class="badge badge-pill badge-light">{{ sizeof(Auth::user()->menus) }}</span>
                                        @lang('menu.side.manage.menus')
                                    </p>
                                </a>
                            </li>
                        @endif
                    </div>
                @endif

                {{-- PayPal --}}
                <li class="nav-item active-pro mb-5">
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F8EMZ2C75K4TA" class="nav-link" target="_blank">
                        {!! config('icons.paypal') !!}
                        <p>@lang('menu.side.support')</p>
                    </a>
                </li>

                <li class="nav-item active-pro">
                    <a href="https://xpand4b.de" class="nav-link" target="_blank">
                        {!! config('icons.heart') !!}
                        <!-- !!! DON'T EVEN THING ABOUT CHANGING THIS NAME !!! -->
                        <p class="text-muted">©<?=date('Y')?>, by Eric Heinzl</p>
                        <!-- !!! I SURE WILL FIND YOU !!! -->
                    </a>
                </li>

            </ul>
        </div>    
    </div>
