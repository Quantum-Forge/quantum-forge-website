@extends('layouts.app')

@section('content')

<!-- Service Banner Section -->
<section class="service-banner-section" data-bg-image="{{ asset('images/background/intro-1.png') }}">
    <div class="auto-container">
			<div class="content-box">
				<h2>Apakah <span>Kamu</span> Mencari <span>Software House</span> ?</h2>
				<div class="text">Kami membantu Anda dengan layanan pengembangan perangkat lunak berkualitas tinggi untuk merancang dan mengembangkan aplikasi web atau aplikasi mobile yang dibuat khusus untuk memenuhi kebutuhan bisnis unik Anda. Hubungi kami untuk konsultasi gratis.</div>
				<a href="contact.php" class="theme-btn btn-style-one"><span class="txt">Hubungi Kami</span></a>
			</div>

		</div>
</section>


	<!-- CTA Section Start -->
	<div class="cta-section" data-bg-image="{{ asset('images/background/cta-bg.png') }}">
		<div class="auto-container">
			<div class="row align-items-center">
				<div class="col-lg-7">
					<!-- CTA Content Start -->
					<div class="cta-content">
						<h3 class="title"><span class="text-bold">Hubungi kami sekarang!</span></h3>
						<p>Kami menyediakan dukungan khusus untuk setiap pertanyaan Anda</p>
					</div>
					<!-- CTA Content End -->
				</div>
				<div class="col-lg-5">
					<!-- CTA Phone Number Start -->
					<a target="_blank" href="https://api.whatsapp.com/send/?phone=6285163619381&text=%22Hi+Quantum%2C+saya+tertarik+untuk+menggunakan+jasa+IT+dari+Anda.+Bolehkah+saya+mendapatkan+informasi+lebih+lanjut%3F+Terima+kasih%21%22&type=phone_number&app_absent=0" class="cta-phone text-lg-end text-strat">
						<h2 class="title">+62 851 636 19 381</h2>
					</a>
					<!-- CTA Phone Number Start -->
				</div>
			</div>
		</div>
	</div>

    @include('section.service')
    @include('section.consultation')
    @include('section.provider')

    @include('section.news')


@endsection
