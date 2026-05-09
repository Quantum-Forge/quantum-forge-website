@extends('layouts.app')

@section('title', request('search') ? 'Hasil Pencarian: ' . request('search') . ' | Quantum Forge' : 'Artikel & Berita Terbaru | Quantum Forge')
@section('meta_description', 'Baca artikel terbaru dari Quantum Forge seputar teknologi, web development, mobile app, strategi digital marketing, dan inovasi IT terkini.')
@section('meta_keywords', 'Artikel IT, Teknologi, Web Development, Digital Marketing, Software House Makassar')

@section('content')
    <!-- Page Title Section -->
    <div class="page-title-section">
        <div class="auto-container">
            <ul class="post-meta">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li>Artikel</li>
            </ul>
            @if(request('search'))
                <h2>Hasil Pencarian: <span>"{{ request('search') }}"</span></h2>
            @else
                <h2><span>Artikel</span> Terbaru</h2>
            @endif
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
                        <!-- News Block Three -->
                        <div class="news-block-three">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="{{ route('articles.details', $article->slug) }}">
                                        @if($article->image_url)
                                            <img style="height: 188px; object-fit: cover;" src="{{ asset('storage/' . $article->image_url) }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="{{ $article->title }}" />
                                        @else
                                            <img style="height: 188px; object-fit: cover;" src="https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg" alt="{{ $article->title }}" />
                                        @endif
                                    </a>
                                </div>
                                <div class="title">{{ $article->category->name ?? 'Uncategorized' }}</div>
                                <h4>
                                    <a href="{{ route('articles.details', $article->slug) }}">{{ $article->title }}</a>
                                </h4>
                                <div class="post-date">
                                    {{ $article->published_at ? $article->published_at->format('F jS, Y') : $article->created_at->format('F jS, Y') }} by
                                    <span>Sledge</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="alert alert-warning text-center" style="width: 100%; border-radius: 8px;">
                            Maaf, tidak ada artikel yang ditemukan.
                            @if(request('search'))
                                Coba cari artikel yang lebih spesifik.
                            @endif
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    {{ $articles->onEachSide(1)->links('pagination.custom') }}
                </div>
                @include('section.articles.sidebar')

            </div>
        </div>
    </div>
@endsection
