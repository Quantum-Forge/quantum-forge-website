@extends('layouts.app')

@section('content')
<!-- Service Banner Section -->
	<div class="service-banner-section" data-bg-image="images/background/intro-2.png">
		<div class="auto-container">
			<div class="content-box">
				<h2>Pemimpin <span>Software House</span> di <span>Indonesia</span></h2>
				<div class="text">Pengembangan aplikasi web dan mobile dengan kualitas terbaik. Pendiri kami dari sekelompok profesional teknologi yang bersemangat untuk membawa perubahan positif melalui inovasi digital dengan sentuhan desain, kualitas, dan keahlian.</div>
				<a href="contact.php" class="theme-btn btn-style-one"><span class="txt">Hubungi Kami</span></a>

				<!-- Lower Box -->
				<div class="lower-box clearfix">
					<div class="pull-left">
						<div class="book">
							<span class="icon icofont-phone"></span>
							Pesan layanan <br> melalui telepon
						</div>
					</div>
					<div class="pull-right">
						<a class="phone" href="https://wa.me/6285163619381">+62 851 636 19 381</a>
					</div>
				</div>

			</div>

		</div>
	</div>
	<!-- End Service Banner Section -->

	<!-- About Section Two -->
	<div class="about-section-two">
		<div class="auto-container">
			<div class="inner-container">
				<div class="row align-items-center clearfix">

					<!-- Image Column -->
					<div class="image-column col-lg-6">
						<div class="about-image">
							<div class="about-inner-image">
								<img src="images/about/3.png" alt="about">
							</div>
						</div>
					</div>

					<!-- Content Column -->
					<div class="content-column col-lg-6 col-md-12 col-sm-12 mb-0">
						<div class="inner-column">
							<div class="sec-title">
								<h2><span>Visi</span> Kami</h2>
							</div>
							<div class="text">
								<p>
									<ul class="list-style-one">
										<li>Menjadi pemimpin global dalam pengembangan perangkat lunak, menginspirasi inovasi, dan mendorong transformasi digital di seluruh dunia.</li>
									</ul>
								</p>
							</div>
						</div>
					</div>

					<!-- Content Column -->
					<div class="content-column col-lg-6 col-md-12 col-sm-12 mb-0">
						<div class="inner-column">
							<div class="sec-title">
								<h2><span>Misi</span> Kami</h2>
							</div>
							<div class="text">
								<p>
									<ul class="list-style-one">
										<li>Memberikan solusi perangkat lunak yang luar biasa dan dapat diandalkan kepada klien.</li>
										<li>Mendorong pertumbuhan bisnis melalui teknologi inovatif.</li>
										<li>Menyediakan lingkungan kerja yang mendukung kreativitas dan perkembangan profesional.</li>
									</ul>
								</p>
							</div>
						</div>
					</div>

					<!-- Image Column -->
					<div class="image-column col-lg-6">
						<div class="about-image">
							<div class="about-inner-image">
								<img src="images/about/2.png" alt="about">
							</div>
						</div>
					</div>

					<!-- Image Column -->
					<div class="image-column col-lg-6">
						<div class="about-image">
							<div class="about-inner-image">
								<img src="images/about/1.png" alt="about">
							</div>
						</div>
					</div>

					<!-- Content Column -->
					<div class="content-column col-lg-6 col-md-12 col-sm-12 mb-0">
						<div class="inner-column">
							<div class="sec-title">
								<h2><span>Nilai</span> Kami</h2>
							</div>
							<div class="text">
								<p>
									<ul class="list-style-one">
										<li><b>Inovasi</b>: Kami selalu mencari cara baru dan lebih baik untuk menyelesaikan masalah</li>
										<li><b>Kualitas</b>: Kami berkomitmen untuk menyediakan produk dan layanan yang memenuhi standar tertinggi.</li>
										<li><b>Kolaborasi</b>: Kami percaya bahwa kerjasama adalah kunci keberhasilan.</li>
										<li><b>Integritas</b>: Kami menjalankan bisnis kami dengan transparansi dan kejujuran.</li>
									</ul>
								</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- End About Section Two -->
    @include('section.consultation')
    @include('section.testimonial')
    @include('section.sponsor')
@endsection
