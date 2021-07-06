<x-jet-nav-link
    href="{{ route('home') }}"
    :active="request()->routeIs('home')"
>
    {{ __('Home') }}
</x-jet-nav-link>
