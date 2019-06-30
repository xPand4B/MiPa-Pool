<nav aria-label="breadcrumb">
    <ol class="breadcrumb m-0 p-0 bg-transparent">
        @if (isset($items))
            @php $count = 0; @endphp

            @foreach ($items as $key => $value)
                @if ($key === $count)
                    <li class="breadcrumb-item active" aria-current="page">{{ $value }}</li>
                    @php $count++; @endphp
                @else
                    <li class="breadcrumb-item"><a href="{{ $value }}" class="text-info">{{ $key }}</a></li>
                @endif
            @endforeach

        @endif
    </ol>
</nav>
