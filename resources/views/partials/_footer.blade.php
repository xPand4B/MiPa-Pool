<footer class="footer" style="border-top: none">
    <div class="container-fluid">
        {{-- Left Sided Items --}}
        <nav class="float-left text-dark">
            {!! language()->flags() !!}
        </nav>

        {{-- Right Sided Items --}}
        <nav class="float-right text-dark">
            <ul>
                {{-- Source Code --}}
                <li>
                    <a href="https://github.com/xPand4B/MiPa-Pool" target="_blank">
                        {!! config('icons.github-lg') !!} &ensp; @lang('menu.footer.sourcecode')
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</footer>
