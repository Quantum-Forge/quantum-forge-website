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
        $linkClass = is_null($portfolio->link) ? 'd-none' : '';
    @endphp

    <!-- Start Project Details -->
    <div class="project-section section-padding">
        <div class="auto-container">
            <div class="row">

                <!-- Portfolio Left -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="work-left work-details">
                        <div class="portfolio-main-info">
                            <h2 class="title">{{ $portfolio->title }}</h2>
                            <!-- Start Details List -->
                            <div class="work-details-list mt-60">
                                <div class="details-list">
                                    <label>Tanggal</label>
                                    <span>{{ optional($portfolio->date)->format('d/m/Y') ?? $portfolio->date }}</span>
                                </div>
                                <div class="details-list">
                                    <label>Klien</label>
                                    <span>{{ $portfolio->clients }}</span>
                                </div>
                                <div class="details-list">
                                    <label>Kategori</label>
                                    <span><a href="#">{{ $portfolio->category?->name ?? $portfolio->category }}</a></span>
                                </div>
                                <div class="details-list">
                                    <label>Kota</label>
                                    <span>{{ $portfolio->kota }}</span>
                                </div>
                            </div>
                            <!-- End Details List -->
                            <!-- Start Work Share -->
                            <div class="work-share section-padding-top-70">
                                <h6 class="heading heading-h6">Documentation</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Work Right -->
                <div class="col-lg-7 col-md-6 offset-lg-1 col-12">
                    <div class="work-left work-details mt-lg-30">
                        <div class="work-main-info">
                            <div class="work-content">
                                <h6 class="title">DESKRIPSI PROYEK</h6>
                                <div class="desc mt-40">
                                    <div class="content mb-25">
                                        <p>{{ $portfolio->description_proyek }}</p>
                                    </div>
                                    <div class="work-btn {{ $linkClass }}">
                                        <a class="theme-btn btn-style-one" href="{{ $portfolio->link }}" target="_blank"><span class="txt">Go to link</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start Thumbnail -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="custom-column-thumbnail mt-lg-70">
                        <img class="w-100" src="{{ $portfolio->images1_url }}" alt="finance">
                    </div>
                </div>
            </div>

            <!-- Start Digital Marketion Area -->
            <div class="row mt-lg-100">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="digital-marketing">
                        <h3 class="heading heading-h3">{{ $portfolio->heading }}</h3>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 offset-lg-1">
                    <div class="digital-marketing mt-30">
                        <div class="inner">
                            <p>{{ $portfolio->description2 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Digital Marketion Area -->

            <!-- Start Gallery Area -->
            <div class="custom-layout-gallery mt-lg-100">
                <div class="row mb-n30">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="thumbnail">
                            <img class="w-100" src="{{ $portfolio->images2_url }}" alt="finance">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mt-50">
                        <div class="thumbnail">
                            <img class="w-100" width="573" height="614" src="{{ $portfolio->images3_url }}" alt="finance">
                        </div>
                    </div>
                    <div class="col-lg-12 mtb-30">
                        <div class="thumbnail">
                            <img class="w-100" width="573" height="614" src="{{ $portfolio->images4_url }}" alt="finance">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Gallery Area -->
        </div>
    </div>
    <!-- Start Project Details -->

@endsection
