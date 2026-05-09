@if ($paginator->hasPages())
    <div class="styled-pagination d-flex justify-content-center">
        <ul class="clearfix">
            {{-- Previous Page Link --}}
            @if (! $paginator->onFirstPage())
                <li class="previous"><a href="{{ $paginator->previousPageUrl() }}"><span class="ti-angle-left"></span> </a></li>
            @endif

            {{-- Pagination Elements (Looping halaman) --}}
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="{{ $i == $paginator->currentPage() ? 'active' : '' }}">
                    <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next"><a href="{{ $paginator->nextPageUrl() }}"><span class="ti-angle-right"></span> </a></li>
            @endif
        </ul>
    </div>
@endif
