<footer class="footer">
    <div class="container-fluid">
        {{-- Left Sided Items --}}
        <nav class="float-left text-dark">
            <ul>
                <li><a href="{{ route('home') }}">
                    Home</a></li>

                <li><a href="{{ route('about') }}">
                    About</a></li>

                <li><a href="{{ route('contact') }}">
                    Contact</a></li>
            </ul>
        </nav>

        {{-- Right Sided Items --}}
        <nav class="float-right text-info">
            <ul>
                <li><a href="{{ route('impressum') }}">
                    Impressum</a></li>

                <li><a href="{{ route('datenschutz') }}">
                    Datenschutzerklärung</a></li>
            </ul>
        </nav>
    </div>
</footer>