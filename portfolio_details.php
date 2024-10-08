<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Quantum Forge - Software House in Makassar || Buahatiku MIS</title>
<meta name="description" content="Buah Hatiku adalah sebuah aplikasi berbasis web yang dirancang khusus untuk digunakan oleh admin dan terapis yang memiliki hak akses khusus. Aplikasi ini memungkinkan admin untuk mengelola data anak terapi, mengatur jadwal terapi, dan mengakses informasi penting terkait dengan terapi autisme"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="canonical" href="https://quantumitco.com/" />

<!-- Stylesheets -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<!-- Open Graph (OG) meta tags are snippets of code that control how URLs are displayed when shared on social media  -->
<meta property="og:locale" content="id" />
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

// Get portfolio ID from URL
$id = isset($_GET['id']) ? $_GET['id'] : 1;

// Find portfolio data by ID
$portfolio = null;
foreach ($portfolios as $p) {
    if ($p['id'] == $id) {
        $portfolio = $p;
        break;
    }
}

// If portfolio not found, redirect or show error
if (!$portfolio) {
    echo "<p>Portfolio not found</p>!";
    exit;

}

// Determine if the link is null
$linkClass = is_null($portfolio['link']) ? 'd-none' : '';
?>

    <!-- Start Project Details -->
    <div class="project-section section-padding">
        <div class="auto-container">
            <div class="row">

                <!-- Portfolio Left -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="work-left work-details">
                        <div class="portfolio-main-info">
                            <h2 class="title"><?= $portfolio['title'] ?></h2>
                            <!-- Start Details List -->
                            <div class="work-details-list mt-60">
                                <div class="details-list">
                                    <label>Tanggal</label>
                                    <span><?= $portfolio['date'] ?></span>
                                </div>
                                <div class="details-list">
                                    <label>Klien</label>
                                    <span><?= $portfolio['clients'] ?></span>
                                </div>
                                <div class="details-list">
                                    <label>Kategori</label>
                                    <span><a href="#"><?= $portfolio['category'] ?></a></span>
                                </div>
                                <div class="details-list">
                                    <label>Kota</label>
                                    <span><?= $portfolio['kota'] ?></span>
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
                                        <p><?= $portfolio['description_proyek'] ?></p>
                                    </div>
                                    <div class="work-btn <?= $linkClass ?>">
                                        <a class="theme-btn btn-style-one" href="<?= $portfolio['link'] ?>" target="_blank"><span class="txt">Go to link</span></a>
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
                        <img class="w-100" src="<?= $portfolio['images1'] ?>" alt="finance">
                    </div>
                </div>
            </div>

            <!-- Start Digital Marketion Area -->
            <div class="row mt-lg-100">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="digital-marketing">
                        <h3 class="heading heading-h3"><?= $portfolio['heading'] ?></h3>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12 offset-lg-1">
                    <div class="digital-marketing mt-30">
                        <div class="inner">
                            <p><?= $portfolio['description2'] ?></p>
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
                            <img class="w-100" src="<?= $portfolio['images2'] ?>" alt="finance">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mt-50">
                        <div class="thumbnail">
                            <img class="w-100" src="<?= $portfolio['images3'] ?>" alt="finance">
                        </div>
                    </div>
                    <div class="col-lg-12 mtb-30">
                        <div class="thumbnail">
                            <img class="w-100" src="<?= $portfolio['images4'] ?>" alt="finance">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Gallery Area -->
        </div>
    </div>
    <!-- Start Project Details -->

	
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