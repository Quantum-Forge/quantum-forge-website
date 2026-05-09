@if ($paginator->hasPages())
    <div class="styled-pagination d-flex justify-content-center">
        <ul class="clearfix">
            {{-- Previous Page Link --}}
            @if (! $paginator->onFirstPage())
                <li class="previous"><a href="{{ $paginator->previousPageUrl() }}"><span class="ti-angle-left"></span> </a></li>
            @endif

            @php
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();
                
                // Tentukan jumlah halaman per "grup/blok" (misal: 4 halaman per blok)
                $pagesPerBlock = 4;
                
                // Hitung blok saat ini (contoh: halaman 1-4 ada di blok 1, 5-8 ada di blok 2)
                $currentBlock = ceil($currentPage / $pagesPerBlock);
                
                // Hitung halaman awal dan akhir untuk blok ini
                $startPage = ($currentBlock - 1) * $pagesPerBlock + 1;
                $endPage = min($startPage + $pagesPerBlock - 1, $lastPage);
            @endphp

            {{-- Pagination Elements (Looping halaman dalam blok) --}}
            @for ($i = $startPage; $i <= $endPage; $i++)
                <li class="{{ $i == $currentPage ? 'active' : '' }}">
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
