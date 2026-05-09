@extends('layouts.app')

@php
    $metaDescription = Str::limit(strip_tags($article->content), 150);
    $metaKeywords = is_array($article->tags) ? implode(', ', $article->tags) . ', Digital Marketing, Software House Makassar' : 'Digital Marketing, Software House Makassar, ' . ($article->category->name ?? '');
    $ogImage = $article->image_url ? asset('storage/' . $article->image_url) : asset('images/logo.png');
@endphp

@section('title', $article->title . ' | Quantum Forge')
@section('meta_description', $metaDescription)
@section('meta_keywords', $metaKeywords)
@section('og_type', 'article')
@section('og_image', $ogImage)

@section('schema_markup')
<script type="application/ld+json">
{
  "{{ '@' }}context": "https://schema.org",
  "{{ '@' }}type": "Article",
  "headline": "{{ $article->title }}",
  "image": [
    "{{ $article->image_url ? asset('storage/' . $article->image_url) : asset('images/logo.png') }}"
  ],
  "datePublished": "{{ $article->published_at ? $article->published_at->toIso8601String() : $article->created_at->toIso8601String() }}",
  "dateModified": "{{ $article->updated_at->toIso8601String() }}",
  "author": [{
      "{{ '@' }}type": "Organization",
      "name": "Quantum Forge",
      "url": "{{ route('home') }}"
  }],
  "publisher": {
    "{{ '@' }}type": "Organization",
    "name": "Quantum Forge",
    "logo": {
      "{{ '@' }}type": "ImageObject",
      "url": "{{ asset('images/logo.png') }}"
    }
  },
  "description": "{{ Str::limit(strip_tags($article->content), 150) }}"
}
</script>
@endsection

@section('content')
    <!-- Page Title Section -->
    <div class="page-title-section style-two">
        <div class="auto-container">
            <ul class="post-meta">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li>Artikel</li>
            </ul>
            <h2>{{ $article->title }}</h2>
        </div>
    </div>
    <!-- End Page Title Section -->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container padding-top">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Content Side -->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">

                    <div class="blog-detail">
                        <div class="inner-box">
                            <div class="image">
                                @if($article->image_url)
                                    <img src="{{ asset('storage/' . $article->image_url) }}" alt="{{ $article->title }}" />
                                @else
                                    <img src="https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg" alt="{{ $article->title }}" />
                                @endif
                            </div>
                            <div class="lower-content">
                                <div class="post-info"><span class="theme_color">{{ $article->category->name ?? 'Uncategorized' }}</span> -  {{ $article->published_at ? $article->published_at->format('F jS, Y') : $article->created_at->format('F jS, Y') }} by <i>Sledge</i></div>

                                <div class="mt-4">
                                    {!! preg_replace('/<(ul|ol)\b[^>]*>/i', '<$1 class="list-style-one">', $article->content) !!}
                                </div>

                                <!-- Post Share Options-->
                                <div class="post-share-options">
                                    <div class="tags">
                                        @if(!empty($article->tags) && is_array($article->tags))
                                            @foreach($article->tags as $tag)
                                                <a href="#" class="my-1">{{ $tag }}</a>
                                            @endforeach
                                        @else
                                            <a href="#">AI Generated</a> <a href="#">{{ $article->category->name ?? 'Uncategorized' }}</a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Related Projects -->
                    @if($relatedArticles->count() > 0)
                    <div class="related-projects">
                        <div class="title-box">
                            <h3>Related Posts</h3>
                        </div>
                        <div class="row clearfix">

                            @foreach($relatedArticles as $related)
                            <!-- News Block Four -->
                            <div class="news-block-four col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="image">
                                        <a href="{{ route('articles.details', $related->slug) }}">
                                            @if($related->image_url)
                                                <img src="{{ asset('storage/' . $related->image_url) }}" alt="{{ $related->title }}" />
                                            @else
                                                <img src="https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg" alt="{{ $related->title }}" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="lower-content">
                                        <div class="title">{{ $related->category->name ?? 'Uncategorized' }}</div>
                                        <h4><a href="{{ route('articles.details', $related->slug) }}">{{ $related->title }}</a></h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    @endif

                </div>
                @include('section.articles.sidebar')

            </div>
        </div>
    </div>
@endsection
