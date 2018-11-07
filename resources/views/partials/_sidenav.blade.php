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
                <li class="nav-item {{ Nav::isRoute('home') }}">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="material-icons">home</i>
                        <p>Bestellungen</p>
                    </a>
                </li>
    
                {{-- User Profil --}}
                <li class="nav-item {{ Nav::hasSegment('profile') }}">
                    <a href="{{ route('profile.show') }}" class="nav-link">
                        <i class="material-icons">person</i>
                        <p>Profil</p>
                    </a>
                </li>
    
            </ul>
        </div>
    
    </div>