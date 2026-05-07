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
								<img src="{{ asset('images/resource/news-9.jpg') }}" alt="" />
							</div>
							<div class="lower-content">
								<div class="post-info"><span class="theme_color">business</span> -  December 14th, 2020 by <i>Admin</i></div>
								<p>Most times, ideacide happens without us even realizing it. A possible off-the-wall idea or solution appears like a blip and disappears without us even realizing. As a result, some of our best stuff is suppressed before even getting out into the world. Whether it’s because we’re too critical or because we recoil at the impending pain of change, the disruption of normalcy, self-censoring arises out of fear. Welsh novelist Sarah Waters sums it up eloquently: “Midway through writing a novel, I have regularly experienced moments of bowel-curdling terror, as I contemplate the drivel on the screen before me and see beyond it, in quick succession, the derisive reviews, the friends’ embarrassment, the failing career, the dwindling income, the repossessed house, the divorce…” We know self-censoring by many names. Carl Jung called it our “inner critic.” Michael Ray and Rochelle Myers called it the “voice of judgment” in their classic book, in Business, based on a popular course they co-taught at Stanford University the derisive reviews, the friends’ embarrassment, the failing career, the dwindling income, the repossessed </p>
								<div class="middle-image">
									<img src="{{ asset('images/resource/news-10.jpg') }}" alt="" />
								</div>
								<h4>Gathered Was Isn’t Fruitful Every</h4>
								<p>Give void had the creature man evening two be for heaven won’t you’re may. Subdue him. Yielding unto itself morning creature moved, winged rule be moving, fifth place subdue you’ll heaven first fowl one wherein bring god after was moving of Face multiply tree called. Subdue first said made living tree you’re two beast, moved, every. Evening their us seas.</p>
								<blockquote>
									<div class="blockquote-text"><span class="quote icofont-quote-left"></span>Our greatest weakness lies in giving up. <br> The most certain way to succeed is always to <br> try just one more time.</div>
								</blockquote>
								<p>Both of these assumptions, of course, could be entirely false. Self-censoring is firmly rooted in our experiences with mistakes in the past and not the present. The brain messages arising from those experiences can be deceptive. </p>
								
								<!-- Post Share Options-->
								<div class="post-share-options">
									<div class="tags"><a href="#">Structure</a> <a href="#">Envato</a> <a href="#">Premium</a></div>
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
							
							<!-- News Block Four -->
							<div class="news-block-four col-lg-6 col-md-6 col-sm-12">
								<div class="inner-box">
									<div class="image">
										<a href="blog-detail.html"><img src="{{ asset('images/resource/news-4.jpg') }}" alt="" /></a>
									</div>
									<div class="lower-content">
										<div class="title">business</div>
										<h4><a href="blog-detail.html">Problems About Social Insurance For Truck Drivers</a></h4>
									</div>
								</div>
							</div>
							
							<!-- News Block Four -->
							<div class="news-block-four col-lg-6 col-md-6 col-sm-12">
								<div class="inner-box">
									<div class="image">
										<a href="blog-detail.html"><img src="{{ asset('images/resource/news-5.jpg') }}" alt="" /></a>
									</div>
									<div class="lower-content">
										<div class="title">News</div>
										<h4><a href="blog-detail.html">5 Steps To Build Strategy Planning</a></h4>
									</div>
								</div>
							</div>
							
						</div>
					</div>

                </div>
                @include('section.articles.sidebar')

            </div>
        </div>
    </div>
@endsection
