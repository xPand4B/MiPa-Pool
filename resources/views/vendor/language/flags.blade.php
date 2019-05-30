<ul class="{{ config('language.flags.ul_class') }}">
@foreach (language()->allowed() as $code => $name)
    @if (app()->getLocale() != $code)
    <li class="{{ config('language.flags.li_class') }}">
        <a href="{{ language()->back($code) }}">
            <img 
                src="{{ asset(config('language.flag_assets'). language()->country($code) .'.png') }}"
                alt="{{ $name }}"
                class="{{ config('language.flags.img_class') }}"
                width="{{ config('language.flags.width') }}"
            /> &nbsp; {{ $name }}
            </a>
        </li>
    @endif
@endforeach
</ul>
