<!-- Header Top -->
<div class="header-top d-none d-md-block">
    <div class="auto-container">
        <div class="inner-container clearfix">
            <!-- Top Left -->
            <div class="top-left">
                <!-- Info List -->
                <ul class="info-list">
                    <li><a href="mailto:support@quantumitco.com"><span class="icon icofont-envelope"></span> support@quantumitco.com</a></li>
                    <li><a href="https://wa.me/6285163619381"><span class="icon icofont-phone"></span> +6285163619381</a></li>
                    <li><a href="contact.php"><span class="icon icofont-clock-time"></span> Senin - Jumat: 9.00 - 18.00 WITA</a></li>
                </ul>
            </div>

            <!-- Top Right -->
            <div class="top-right pull-right">
                <!-- Social Box -->
                <ul class="social-box">
                    <li class="share">Our Social</li>
                    <li><a href="https://api.whatsapp.com/send/?phone=6285163619381&text=%22Hi+Quantum%2C+saya+tertarik+untuk+menggunakan+jasa+IT+dari+Anda.+Bolehkah+saya+mendapatkan+informasi+lebih+lanjut%3F+Terima+kasih%21%22&type=phone_number&app_absent=0" class="fab fa-whatsapp"></a></li>
                    <li><a href="https://www.instagram.com/quantumitco/" class="fab fa-instagram"></a></li>
                    <li><a href="https://discord.gg/hRazTHsBe8" class="fab fa-discord"></a></li>
                    <li><a href="https://www.linkedin.com/company/quantumforge-mks/" class="fab fa-linkedin"></a></li>
                </ul>
            </div>

        </div>
    </div>
</div>

    	<!-- Header Upper -->
        <div class="header-upper">
        	<div class="auto-container">
            	<div class="inner-container clearfix">

                	<div class="pull-left logo-box">
                    	<div class="logo"><a href="index.php"><img class="py-3 img-fluid" width="175" height="80" src="images/logo.png" alt="" title=""></a></div>
                    </div>

                   	<div class="nav-outer pull-left clearfix">
						<!-- Main Menu -->
						<nav class="main-menu navbar-expand-md">
							<div class="navbar-header">
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>

							<?php
                            // Ambil nama file dari URL
                            $current_page = basename($_SERVER['PHP_SELF']);
                            ?>

                            <!-- Navbar Code -->
                            <div class="navbar-collapse show collapse clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="{{ request()->routeIs('home') ? 'current' : '' }}"><a href="{{ route('home') }}">Beranda</a></li>
                                    <li class="{{ request()->routeIs('about') ? 'current' : '' }}"><a href="{{ route('about') }}">Tentang</a></li>
                                    <li class="dropdown {{ request()->routeIs('section.blog.mobile_app') || request()->routeIs('section.blog.web_app') ? 'current' : '' }}"><a href="#">Layanan</a>
                                        <ul style="width: 295px !important;">
                                            <li class="{{ request()->routeIs('section.blog.mobile_app') ? 'current' : '' }}"><a href="{{ route('section.blog.mobile_app') }}">Mobile App Development</a></li>
                                            <li class="{{ request()->routeIs('section.blog.web_app') ? 'current' : '' }}"><a href="{{ route('section.blog.web_app') }}">Web App Development</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ request()->routeIs('portfolio') ? 'current' : '' }}"><a href="{{ route('portfolio') }}">Proyek</a></li>
                                    <li class="{{ request()->routeIs('news') ? 'current' : '' }}"><a href="{{ route('news') }}">Berita</a></li>
                                    <li class="{{ request()->routeIs('contact') ? 'current' : '' }}"><a href="{{ route('contact') }}">Kontak</a></li>
                                </ul>
                            </div>


						</nav>

					</div>

					<!-- Outer Box -->
					<div class="outer-box">
						<!-- Search Btn -->
						<div class="search-box-btn search-box-outer"><span class="icon icofont-search"></span></div>
						<!-- Mobile Navigation Toggler -->
                        <div class="mobile-nav-toggler"><span class="icon ti-menu"></span></div>
					</div>

                </div>
            </div>
        </div>
        <!--End Header Upper-->

		<!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="icon lnr lnr-cross"></span></div>

            <nav class="menu-box">
                <div class="nav-logo"><a href="index.php"><img width="175" height="80" src="images/logo.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            </nav>
        </div><!-- End Mobile Menu -->
