@if ($paginator->hasPages())
    <ul class="pagination" role="navigation" style="justify-content: center">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <strong>
                    <a class="page-link text-dark" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="material-icons" style="font-size: 16px">keyboard_arrow_left</i>
                    </a>
                </strong>
            </li>
        @endif


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item bg-primary" aria-current="page">
                            <span class="page-link text-white" >{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link text-dark" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

            @endif
            
        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <strong>
                    <a class="page-link text-dark" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="material-icons" style="font-size: 16px">keyboard_arrow_right</i>
                    </a>
                </strong>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif

<style>
    .page-link:hover, a.page-link:hover{
        background-color: rgb(52, 58, 64) !important;
        color: white !important;
    }

    span.page-link:hover{
        background-color: #2196f3 !important;
    }
</style>