@if ($paginator->hasPages())
    <div class="styled-pagination">
        <ul class="clearfix">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="prev disabled"><a href="javascript:void(0);"><span class="ti-angle-left"></span> </a></li>
            @else
                <li class="prev"><a href="{{ $paginator->previousPageUrl() }}"><span class="ti-angle-left"></span> </a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><a href="javascript:void(0);">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="javascript:void(0);">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next"><a href="{{ $paginator->nextPageUrl() }}"><span class="ti-angle-right"></span> </a></li>
            @else
                <li class="next disabled"><a href="javascript:void(0);"><span class="ti-angle-right"></span> </a></li>
            @endif
        </ul>
    </div>
@endif
