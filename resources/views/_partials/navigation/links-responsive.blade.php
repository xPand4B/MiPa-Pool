<x-jet-responsive-nav-link
    href="{{ route('home') }}"
    :active="request()->routeIs('home')"
>
    {{ __('Home') }}
</x-jet-responsive-nav-link>
