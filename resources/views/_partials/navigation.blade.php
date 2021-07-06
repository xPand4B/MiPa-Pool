<nav
    x-data="{ open: false }"
    class="bg-white border-b border-gray-100"
>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        @section('navigation.logo.content')
                            <x-jet-application-mark class="block h-9 w-auto"></x-jet-application-mark>
                        @show
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @section('navigation.links')
                        @include('_partials.navigation.links')
                    @show
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures() && \Illuminate\Support\Facades\Auth::check())
                    @section('navigation.teams')
                        @include('_partials.navigation.teams')
                    @show
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    @section('navigation.settings')
                        @auth()
                            <x-jet-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                        >
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <img
                                                    src="{{ \Illuminate\Support\Facades\Auth::user()->profile_photo_url }}"
                                                    alt="{{ \Illuminate\Support\Facades\Auth::user()->name }}"
                                                    class="h-8 w-8 rounded-full object-cover mr-3"
                                                />
                                            @endif
                                            {{ \Illuminate\Support\Facades\Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <!-- Profile -->
                                    <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-jet-dropdown-link>

                                    <!-- API -->
                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-jet-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-jet-dropdown-link
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                        >
                                            {{ __('Log Out') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-jet-dropdown>
                        @else
                            <!-- Login -->
                            <x-jet-nav-link
                                href="{{ route('login') }}"
                                :active="request()->routeIs('login')"
                            >
                                {{ __('Login') }}
                            </x-jet-nav-link>

                            <!-- Register -->
                            <x-jet-nav-link
                                href="{{ route('register') }}"
                                :active="request()->routeIs('register')"
                            >
                                {{ __('Register') }}
                            </x-jet-nav-link>
                        @endauth
                    @show
                </div>
            </div>

            <!-- Hamburger -->
            @section('navigation.hamburger')
                @include('_partials.navigation.hamburger')
            @show
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden"
    >
        <div class="pt-2 pb-3 space-y-1">
            @section('navigation.links-responsive')
                @include('_partials.navigation.links-responsive')
            @show
        </div>

        <!-- Responsive Settings Options -->
        @section('navigation.settings-responsive')
            @auth()
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex-shrink-0 mr-3">
                                <img
                                    src="{{ \Illuminate\Support\Facades\Auth::user()->profile_photo_url }}"
                                    alt="{{ \Illuminate\Support\Facades\Auth::user()->name }}"
                                    class="h-8 w-8 rounded-full object-cover mr-3"
                                />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800">
                                {{ \Illuminate\Support\Facades\Auth::user()->name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ \Illuminate\Support\Facades\Auth::user()->email }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-jet-responsive-nav-link
                            href="{{ route('profile.show') }}"
                            :active="request()->routeIs('profile.show')"
                        >
                            {{ __('Profile') }}
                        </x-jet-responsive-nav-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-responsive-nav-link
                                href="{{ route('api-tokens.index') }}"
                                :active="request()->routeIs('api-tokens.index')"
                            >
                                {{ __('API Tokens') }}
                            </x-jet-responsive-nav-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-responsive-nav-link
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                {{ __('Log Out') }}
                            </x-jet-responsive-nav-link>
                        </form>

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            @include('_partials.navigation.teams-responsive')
                        @endif
                    </div>
                </div>
            @endauth
        @show

    </div>
</nav>
