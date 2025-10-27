@extends('layouts.app')

@section('content')
    <!-- Page Title Section -->
    <div class="page-title-section">
        <div class="auto-container">
            <ul class="post-meta">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li>Berita</li>
            </ul>
            <h2><span>Berita</span> Terkini dari Kami</h2>
        </div>
    </div>
    <!-- End Page Title Section -->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container padding-top">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Content Side -->
                <div class="content-side col-lg-12">

                    @if(!empty($error))
                        <div class="alert alert-warning">{{ $error }}</div>
                    @endif

                    @php
                        // Normalisasi data agar kompatibel dengan legacy ($newsData) maupun controller ($news)
                        $data = $news ?? ($newsData ?? []);
                        $page = (int) ($page ?? request()->integer('page', 1));
                        $pageSize = (int) ($pageSize ?? 5);
                        $query = $query ?? request('q', '');
                        $totalResults = (int) ($data['totalResults'] ?? 0);
                        $totalPages = (int) ceil($totalResults / max($pageSize, 1));
                        $articles = $data['articles'] ?? [];

                        // Logika pagination identik dengan legacy
                        $startPage = max(1, min($page - 1, $totalPages - 3));
                        $endPage = min($startPage + 3, $totalPages);
                        if ($endPage < 4) {
                            $startPage = 1;
                            $endPage = min(4, $totalPages);
                        }
                    @endphp

                    <div class="our-blogs">
                        @if(!empty($articles))
                            @foreach($articles as $article)
                                @if(!empty($article['urlToImage']))
                                    <!-- News Block Three -->
                                    <div class="news-block-three">
                                        <div class="inner-box">
                                            <div class="image">
                                                <a href="{{ $article['url'] }}" target="_blank">
                                                    <img style="height: 169px;" src="{{ !empty($article['urlToImage']) ? $article['urlToImage'] : 'https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg' }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="title">{{ e($article['source']['name'] ?? '') }}</div>
                                            <h4>
                                                <a href="{{ $article['url'] }}" target="_blank">{{ e($article['title'] ?? '') }}</a>
                                            </h4>
                                            <div class="post-date">
                                                {{ \Carbon\Carbon::parse($article['publishedAt'] ?? now())->format('F jS, Y') }} by
                                                <span>{{ !empty($article['author']) ? e($article['author']) : 'Unknown' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>No news available at the moment.</p>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if($totalPages > 1)
                        <div class="styled-pagination">
                            <ul class="clearfix">
                                @if($page > 1)
                                    <li class="prev">
                                        <a href="{{ route('news', ['page' => $page - 1, 'q' => $query]) }}">
                                            <span class="ti-angle-left"></span>
                                        </a>
                                    </li>
                                @endif
                                @for($i = $startPage; $i <= $endPage; $i++)
                                    <li class="{{ $i === $page ? 'active' : '' }}">
                                        <a href="{{ route('news', ['page' => $i, 'q' => $query]) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if($page < $totalPages)
                                    <li class="next">
                                        <a href="{{ route('news', ['page' => $page + 1, 'q' => $query]) }}">
                                            <span class="ti-angle-right"></span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
