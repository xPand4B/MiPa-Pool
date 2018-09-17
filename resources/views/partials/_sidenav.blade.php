{{-- Data-Colors: purple, azure, green, orange, danger, rose --}}
{{-- If you want to add another color you need to create as custom css --}}
<div class="sidebar" data-color="primary1" data-background-color="black">

        <!-- Brand Name -->
        <div class="logo">
            <a href="{{ route('home') }}" class="simple-text logo-normal">
                <!-- BRAND LOGO HERE -->
                {{ config('app.name', 'MiPa-Pool') }}
            </a>
        </div>
    
        <div class="sidebar-wrapper">
            <ul class="nav">
                <!-- Home -->
                <li class="nav-item {{ Nav::isRoute('home') }}">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="material-icons">home</i>
                        <p>Home</p>
                    </a>
                </li>
    
                {{-- User Profil --}}
                <li class="nav-item {{ Nav::isRoute('profile') }}">
                    <a href="#" class="nav-link">
                        <i class="material-icons">person</i>
                        <p>Profil</p>
                    </a>
                </li>
    
            </ul>
        </div>
    
    </div>