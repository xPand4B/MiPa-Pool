<footer class="footer">
    <div class="container-fluid">
        {{-- Left Sided Items --}}
        <nav class="float-left text-dark">
            <ul>
                
            </ul>
        </nav>

        {{-- Right Sided Items --}}
        <nav class="float-right text-info">
            <ul>
                <li><a href="{{ route('imprint') }}">
                    @lang('menu.footer.imprint')</a></li>

                <li><a href="{{ route('privacy_policy') }}">
                    @lang('menu.footer.privacy_policy')</a></li>
            </ul>
        </nav>
    </div>
</footer>