{{-- Data-Colors: primary, info, success, warning, danger, rose, white --}}
{{-- If you want to add another color you need to create as custom css --}}
{{-- Other parameters: data-image="{{ asset('img/<PATH TO IMAGE>') }}" --}}
<div class="sidebar" data-color="primary" data-background-color="black">

        <!-- Brand Name -->
        <div class="logo">
            <a href="{{ route('home') }}" class="simple-text logo-normal">
                <!-- BRAND LOGO HERE -->
                <img src="{{ asset('img/brand-icon.jpg') }}" alt="{{ config('app.name', 'MiPa-Pool') }}" width="32px" height="32px" style="border-radius: 16px">
                {{ config('app.name', 'MiPa-Pool') }}
            </a>
        </div>
    
        <div class="sidebar-wrapper">
            <ul class="nav">
                <!-- Home -->
                <li class="nav-item {{ Nav::isRoute('home') }}{{ Nav::hasSegment('order') }}">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="material-icons">home</i>
                        <p>@lang('menu.side.orders')</p>
                    </a>
                </li>
    
                {{-- User Profil --}}
                <li class="nav-item {{ Nav::hasSegment('profile') }}">
                    <a href="{{ route('profile.show') }}" class="nav-link">
                        <i class="material-icons">person</i>
                        <p>@lang('menu.side.profile')</p>
                    </a>
                </li>

                
                <hr class="mx-3 mt-5 mb-0" style="background-color: rgba(180, 180, 180, 0.3);">

                {{-- PayPal --}}
                <li class="nav-item">
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F8EMZ2C75K4TA" class="nav-link" target="_blank">
                        <i class="fa fa-paypal"></i>
                        <p>@lang('menu.side.support')</p>
                    </a>
                </li>

            </ul>
        </div>    
    </div>