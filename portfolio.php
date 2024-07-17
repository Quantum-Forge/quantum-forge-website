<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Quantum Forge - Software House in Makassar || Buahatiku MIS</title>
<meta name="description" content="Buah Hatiku adalah sebuah aplikasi berbasis web yang dirancang khusus untuk digunakan oleh admin dan terapis yang memiliki hak akses khusus. Aplikasi ini memungkinkan admin untuk mengelola data anak terapi, mengatur jadwal terapi, dan mengakses informasi penting terkait dengan terapi autisme"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="canonical" href="Replace_with_your_PAGE_URL" />

<!-- Stylesheets -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Quantum Forge - Software House in Makassar || Buahatiku MIS" />

<!-- For the og:image content, replace the # with a link of an image -->

<meta property="og:description" content="Buah Hatiku adalah sebuah aplikasi berbasis web yang dirancang khusus untuk digunakan oleh admin dan terapis yang memiliki hak akses khusus. Aplikasi ini memungkinkan admin untuk mengelola data anak terapi, mengatur jadwal terapi, dan mengakses informasi penting terkait dengan terapi autisme" />

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Add site Favicon -->
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">
<meta name="msapplication-TileImage" content="images/favicon.png" />


</head>

<body>

<div class="loading-area">
        <div class="spinner-grow text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

<div class="page-wrapper">
 	
    <!-- Main Header-->
    <header class="main-header style-three">
		<?php include ('layout/header.php')?>		
    </header>
    <!--End Main Header -->
	
	<!-- Page Title Section -->
    <div class="page-title-section">
    	<div class="auto-container">
			<ul class="post-meta">
				<li><a href="index.php">Beranda</a></li>
				<li>Proyek</li>
			</ul>
			<h2><span>Terbaru</span> Dari Proyek Kami</h2>
		</div>
	</div>
	<!-- End Page Title Section -->
	
    <?php
    // Load JSON data
    $json = file_get_contents('portfolio.json');
    $data = json_decode($json, true);
    $portfolios = $data['portfolio'];
    
    // Pagination variables
    $perPage = 6; // Number of items per page
    $totalItems = count($portfolios);
    $totalPages = ceil($totalItems / $perPage);
    
    // Get current page from URL, default is 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, min($totalPages, $page)); // Ensure page is within valid range
    
    // Calculate the offset and limit for the current page
    $offset = ($page - 1) * $perPage;
    $portfoliosOnPage = array_slice($portfolios, $offset, $perPage);
    
    // Determine if pagination should be hidden
    $paginationClass = $totalItems <= $perPage ? 'd-none' : '';
    ?>

    <!-- Start Project Details -->
    <div class="project-section section-padding">
        <div class="auto-container">
            <div class="row clearfix">
                <?php foreach ($portfoliosOnPage as $portfolio): ?>
                    <div class="team-block col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                            <div class="image">
                                <a href="portfolio_details.php?id=<?= $portfolio['id'] ?>"><img src="<?= $portfolio['images1'] ?>" alt=""></a>
                                <!-- Social Box -->
                                <ul class="social-box">
                                    <li><a href="https://api.whatsapp.com/send/?phone=6285163619381&text=%22Hi+Quantum%2C+saya+tertarik+untuk+menggunakan+jasa+IT+dari+Anda.+Bolehkah+saya+mendapatkan+informasi+lebih+lanjut%3F+Terima+kasih%21%22&type=phone_number&app_absent=0" class="icofont-whatsapp"></a></li>
                                    <li><a href="https://www.instagram.com/quantumitco/" class="icofont-instagram"></a></li>
                                    <li><a href="https://www.linkedin.com/company/quantumforge-mks/" class="icofont-linkedin"></a></li>
                                </ul>
                            </div>
                            <div class="lower-box mt-0">
                                <h4><a href="portfolio_details.php?id=<?= $portfolio['id'] ?>"><?= $portfolio['title'] ?></a></h4>
                                <div class="designation"><?= $portfolio['category'] ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
             <!-- Pagination -->
            <div class="styled-pagination d-flex justify-content-center <?= $paginationClass ?>">
                <ul class="clearfix">
                    <?php if ($page > 1): ?>
                        <li class="previous"><a href="?page=<?= $page - 1 ?>"><span class="ti-angle-left"></span> </a></li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="<?= $i == $page ? 'active' : '' ?>"><a href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                        <li class="next"><a href="?page=<?= $page + 1 ?>"><span class="ti-angle-right"></span> </a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Project Details -->


	
	<!-- Main Footer -->
    <footer class="main-footer style-two">
		<?php include ('layout/footer.php') ?>
	</footer>
	
</div>
<!--End pagewrapper-->

<?php include ('layout/search_popup.php')?>


<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/appear.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/parallax.min.js"></script>
<script src="js/tilt.jquery.min.js"></script>
<script src="js/jquery.paroller.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/script.js"></script>

</body>
</html>