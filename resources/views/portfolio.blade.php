@extends('layouts.app')

@section('content')
<!-- Page Title Section -->
    <div class="page-title-section">
    	<div class="auto-container">
			<ul class="post-meta">
				<li><a href="{{ route('home') }}">Beranda</a></li>
				<li>Proyek</li>
			</ul>
			<h2><span>Terbaru</span> Dari Proyek Kami</h2>
		</div>
	</div>
	<!-- End Page Title Section -->

    @php
        $paginationClass = $portfolios->total() <= $portfolios->perPage() ? 'd-none' : '';
    @endphp

    <!-- Start Project Details -->
    <div class="project-section section-padding">
        <div class="auto-container">
            <div class="row clearfix">
                @foreach ($portfolios as $portfolio)
                    <div class="team-block col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                            <div class="image">
                                <a href="{{ route('portfolio.details', ['id' => $portfolio->id]) }}"><img src="{{ $portfolio->images1_url }}" alt=""></a>
                                <!-- Social Box -->
                                <ul class="social-box">
                                    <li><a href="https://api.whatsapp.com/send/?phone=6285163619381&text=%22Hi+Quantum%2C+saya+tertarik+untuk+menggunakan+jasa+IT+dari+Anda.+Bolehkah+saya+mendapatkan+informasi+lebih+lanjut%3F+Terima+kasih%21%22&type=phone_number&app_absent=0" class="icofont-whatsapp"></a></li>
                                    <li><a href="https://www.instagram.com/quantumitco/" class="icofont-instagram"></a></li>
                                    <li><a href="https://www.linkedin.com/company/quantumforge-mks/" class="icofont-linkedin"></a></li>
                                </ul>
                            </div>
                            <div class="lower-box mt-0">
                                <h4><a href="{{ route('portfolio.details', ['id' => $portfolio->id]) }}">{{ $portfolio->title }}</a></h4>
                                <div class="designation">{{ $portfolio->category }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

             <!-- Pagination -->
            <div class="styled-pagination d-flex justify-content-center {{ $paginationClass }}">
                <ul class="clearfix">
                    @if (! $portfolios->onFirstPage())
                        <li class="previous"><a href="{{ $portfolios->previousPageUrl() }}"><span class="ti-angle-left"></span> </a></li>
                    @endif

                    @for ($i = 1; $i <= $portfolios->lastPage(); $i++)
                        <li class="{{ $i == $portfolios->currentPage() ? 'active' : '' }}"><a href="{{ $portfolios->url($i) }}">{{ $i }}</a></li>
                    @endfor

                    @if ($portfolios->hasMorePages())
                        <li class="next"><a href="{{ $portfolios->nextPageUrl() }}"><span class="ti-angle-right"></span> </a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- End Project Details -->


@endsection
