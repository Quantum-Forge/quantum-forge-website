@extends('layouts.app')

@section('content')
    <!-- Page Title Section -->
    <div class="page-title-section">
        <div class="auto-container">
            <ul class="post-meta">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li>Artikel</li>
            </ul>
            <h2><span>Artikel</span> Terbaru</h2>
        </div>
    </div>
    <!-- End Page Title Section -->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container padding-top">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Content Side -->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">

                    <div class="our-blogs">
                        @forelse($articles as $article)
                            <div class="news-block-three">
                                <div class="inner-box">
                                    <div class="image">
                                        <a href="{{ route('articles.show', $article) }}">
                                            <img style="height: 188px; object-fit: cover;" src="{{ $article->featured_image_url ?? '' }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="" />
                                        </a>
                                    </div>
                                    <div class="title">{{ $article->keywords[0] ?? 'Artikel' }}</div>
                                    <h4>
                                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                                    </h4>
                                    <div class="post-date">
                                        {{ optional($article->published_at)->format('F jS, Y') }} by
                                        <span>{{ $article->author?->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="news-block-three">
                                <div class="inner-box">
                                    <h4>Belum ada artikel yang dipublikasikan.</h4>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="styled-pagination">
                        {{ $articles->links() }}
                    </div>

                </div>
                @include('section.articles.sidebar')

            </div>
        </div>
    </div>
@endsection
