@extends('layouts.app')

@section('content')
<!-- Map Section -->
	<div class="map-section">
		<div class="contact-map-area">
		<iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15896.689160711181!2d119.5107791!3d-5.0758079!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefdad009d4c73%3A0xa29683b491666860!2sQuantum%20Forge%20Software%20Makassar!5e0!3m2!1sid!2sid!4v1719051022059!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
	<!-- End Map Section -->

	<!-- Contact Page Section -->
	<div class="contact-page-section">
		<div class="auto-container">
			<!-- Contact Info Boxed -->
			<div class="contact-info-boxed">
				<div class="row clearfix">

					<!-- Column -->
					<div class="column col-lg-6 col-md-6 col-sm-12">
						<h2>Makassar, <span>Sulawesi Selatan</span></h2>
						<div class="text">Jl. Ir. Sutami No.85, Bulurokeng, Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90242</div>
						<div class="email">Email: <a href="mailto:support@quantumitco.com">support@quantumitco.com</a></div>
					</div>

					<!-- Column -->
					<div class="column col-lg-6 col-md-6 col-sm-12">
						<div class="call">Telp WA:<br><a href="https://api.whatsapp.com/send/?phone=6285163619381&text=%22Hi+Quantum%2C+saya+tertarik+untuk+menggunakan+jasa+IT+dari+Anda.+Bolehkah+saya+mendapatkan+informasi+lebih+lanjut%3F+Terima+kasih%21%22&type=phone_number&app_absent=0">+62 851 636 19 381</a></div>
						<ul class="location-list">
							<li><span>Work Hours:</span>Senin - Jumat: 9.00 - 18.00 WITA</li>
						</ul>
					</div>

				</div>
			</div>

			<!-- Form Boxed -->
			<div class="form-boxed">
				<div class="sec-title centered">
					<div class="title">kontak kami</div>
					<h2>Kami Disini <span>Membantu Anda</span></h2>
				</div>

				<div class="boxed-inner">
					<!-- Contact Form -->
					<div class="contact-form">
						<!-- Contact Form -->
						<form method="post" action="php/whatsapp.php" id="contact-form">
							<div class="row clearfix">
								<div class="col-lg-4 col-md-6 col-sm-12 form-group">
									<input type="text" name="name" placeholder="Name *" required>
								</div>

								<div class="col-lg-4 col-md-6 col-sm-12 form-group">
									<input type="text" name="phone" placeholder="Phone Number *" required>
								</div>

								<div class="col-lg-4 col-md-12 col-sm-12 form-group">
									<select name="topic" required>
										<option value="">Choose topic</option>
										<option value="Web Development">Web Development</option>
										<option value="Mobile Development">Mobile Development</option>
										<option value="Others">Lainnya</option>
									</select>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 form-group">
									<textarea name="message" placeholder="Message"></textarea>
								</div>

								<div class="col-lg-12 col-md-12 col-sm-12 text-center form-group">
									<button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="txt">Kirim Pesan</span></button>
								</div>

							</div>
						</form>
						<p class="form-messege"></p>

					</div>
					<!--End Contact Form -->
				</div>

			</div>

		</div>
	</div>
	<!-- End Blog Detail Section -->
@endsection
