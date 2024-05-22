<!-- Header Top -->
<div class="header-top">
            <div class="auto-container">
                <div class="inner-container clearfix">
					<!-- Top Left -->
					<div class="top-left">
						<!-- Info List -->
						<ul class="info-list">
							<li><a href="mailto:hello@consulte.co"><span class="icon icofont-envelope"></span> hello@consulte.co</a></li>
							<li><a href="tel:+1212-226-3126"><span class="icon icofont-phone"></span> +1212-226-3126</a></li>
							<li><a href="contact.php"><span class="icon icofont-clock-time"></span> Mon - Sat: 8.00 - 17.00, Sunday Closed</a></li>
						</ul>
					</div>
					
					<!-- Top Right -->
                    <div class="top-right pull-right">
						<!-- Social Box -->
						<ul class="social-box">
							<li class="share">Our Social</li>
							<li><a href="https://twitter.com/" class="icofont-twitter"></a></li>
							<li><a href="http://facebook.com/" class="icofont-whatsapp"></a></li>
							<li><a href="https://www.instagram.com/" class="icofont-instagram"></a></li>
							<li><a href="https://rss.com/" class="fas fa-whatsapp"></a></li>
							<li><a href="https://www.youtube.com/" class="icofont-play-alt-1"></a></li>
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
                    	<div class="logo"><a href="index.php"><img src="images/logo.png" alt="" title=""></a></div>
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
                                    <li class="<?php echo ($current_page == 'index.php') ? 'current' : ''; ?>"><a href="index.php">Home</a></li>
                                    <li class="<?php echo ($current_page == 'about.php') ? 'current' : ''; ?>"><a href="about.php">About</a></li>
                                    <li class="dropdown <?php echo ($current_page == 'service.php' || $current_page == 'service-detail.php') ? 'current' : ''; ?>"><a href="#">Service</a>
                                        <ul>
                                            <li class="<?php echo ($current_page == 'service.php') ? 'current' : ''; ?>"><a href="service.php">Service</a></li>
                                            <li class="<?php echo ($current_page == 'service-detail.php') ? 'current' : ''; ?>"><a href="service-detail.php">Service Detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown <?php echo ($current_page == 'project.php' || $current_page == 'project-details.php') ? 'current' : ''; ?>"><a href="#">Projects</a>
                                        <ul>
                                            <li class="<?php echo ($current_page == 'project.php') ? 'current' : ''; ?>"><a href="project.php">Project</a></li>
                                            <li class="<?php echo ($current_page == 'project-details.php') ? 'current' : ''; ?>"><a href="project-details.php">Project Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown <?php echo ($current_page == 'blog.php' || $current_page == 'blog-detail.php') ? 'current' : ''; ?>"><a href="#">Blog</a>
                                        <ul class="from-right">
                                            <li class="<?php echo ($current_page == 'blog.php') ? 'current' : ''; ?>"><a href="blog.php">Our Blog</a></li>
                                            <li class="<?php echo ($current_page == 'blog-detail.php') ? 'current' : ''; ?>"><a href="blog-detail.php">Blog Detail</a></li>
                                        </ul>
                                    </li>
                                    <li class="<?php echo ($current_page == 'contact.php') ? 'current' : ''; ?>"><a href="contact.php">Contact</a></li>
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
                <div class="nav-logo"><a href="index.php"><img src="images/logo.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            </nav>
        </div><!-- End Mobile Menu -->