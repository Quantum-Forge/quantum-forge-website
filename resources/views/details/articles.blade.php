@extends('layouts.app')

@section('content')
    <!-- Page Title Section -->
    <div class="page-title-section style-two">
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

                    <div class="blog-detail">
						<div class="inner-box">
							<div class="image">
								<img src="{{ $article->featured_image_url ?? '' }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="" />
							</div>
							<div class="lower-content">
								<div class="post-info"><span class="theme_color">{{ $article->keywords[0] ?? 'Artikel' }}</span> -  {{ optional($article->published_at)->format('F jS, Y') }} by <i>{{ $article->author?->name ?? 'Admin' }}</i></div>
								<h3>{{ $article->title }}</h3>
								{!! $article->html !!}
								
								<!-- Post Share Options-->
								<div class="post-share-options">
									<div class="tags">
										@foreach(($article->keywords ?? []) as $keyword)
											<a href="#">{{ $keyword }}</a>
										@endforeach
									</div>
								</div>
								
							</div>
						</div>
					</div>
					
					<!-- Related Projects -->
					<div class="related-projects">
						<div class="title-box">
							<h3>Related Posts</h3>
						</div>
						<div class="row clearfix">
							@foreach($relatedArticles as $related)
								<div class="news-block-four col-lg-6 col-md-6 col-sm-12">
									<div class="inner-box">
										<div class="image">
											<a href="{{ route('articles.show', $related) }}">
												<img src="{{ $related->featured_image_url ?? '' }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="" />
											</a>
										</div>
										<div class="lower-content">
											<div class="title">{{ $related->keywords[0] ?? 'Artikel' }}</div>
											<h4><a href="{{ route('articles.show', $related) }}">{{ $related->title }}</a></h4>
										</div>
									</div>
								</div>
							@endforeach
							
						</div>
					</div>

                </div>
                @include('section.articles.sidebar')

            </div>
        </div>
    </div>
@endsection
