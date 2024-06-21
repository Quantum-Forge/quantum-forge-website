<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Quantum Forge - Software House in Makassar</title>
<meta name="description" content="Consulte is a free Bootstrap HTML Template for Investment Company"/>
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
<meta property="og:title" content="Consulte - Investment Company Bootstrap HTML Template" />

<!-- For the og:image content, replace the # with a link of an image -->

<meta property="og:description" content="Consulte is a free Bootstrap HTML Template for Investment Company" />

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Add site Favicon -->
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">
<meta name="msapplication-TileImage" content="images/favicon.png" />


</head>

<body>

<div class="loading-area">
        <div class="spinner-border text-primary" role="status">
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
				<li>Berita</li>
			</ul>
			<h2><span>Latest</span> From Our Press</h2>
		</div>
	</div>
	<!-- End Page Title Section -->
	<?php include 'php/api_news.php'; // Memuat data berita dari API?>
	<!-- Sidebar Page Container -->
	<div class="sidebar-page-container padding-top">
		<div class="auto-container">
			<div class="row clearfix">
				<!-- Content Side -->
				<div class="content-side col-lg-12">
					<div class="our-blogs">
						<?php
						if (isset($newsData['articles']) && !empty($newsData['articles'])):
							foreach ($newsData['articles'] as $article):
								if (!empty($article['urlToImage'])):
									?>
									<!-- News Block Three -->
									<div class="news-block-three">
										<div class="inner-box">
											<div class="image">
												<a href="<?php echo $article['url']; ?>" target="_blank">
													<img style="width: 300px; height: 169px;" src="<?php echo $article['urlToImage']; ?>" alt="" />
												</a>
											</div>
											<div class="title"><?php echo htmlspecialchars($article['source']['name']); ?></div>
											<h4><a href="<?php echo $article['url']; ?>" target="_blank">
													<?php echo htmlspecialchars($article['title']); ?>
												</a></h4>
											<div class="post-date">
												<?php echo date('F jS, Y', strtotime($article['publishedAt'])); ?> by 
												<span><?php echo htmlspecialchars($article['author'] ?: 'Unknown'); ?></span>
											</div>
										</div>
									</div>
									<?php
								endif;
							endforeach;
						else:
							echo "<p>No news available at the moment.</p>";
						endif;
						?>
					</div>
					<?php
					$startPage = max(1, min($page - 1, ceil($newsData['totalResults'] / 5) - 3));
					$endPage = min($startPage + 3, ceil($newsData['totalResults'] / 5));

					if ($endPage < 4) {
						$startPage = 1;
						$endPage = min(4, ceil($newsData['totalResults'] / 5));
					}
					?>

					<!-- Pagination -->
					<div class="styled-pagination">
						<ul class="clearfix">
							<?php if ($page > 1): ?>
								<li class="prev">
									<a href="news.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($query); ?>">
										<span class="ti-angle-left"></span>
									</a>
								</li>
							<?php endif; ?>

							<?php for ($i = $startPage; $i <= $endPage; $i++): ?>
								<li class="<?php echo ($i == $page) ? 'active' : ''; ?>">
									<a href="news.php?page=<?php echo $i; ?>&search=<?php echo urlencode($query); ?>">
										<?php echo $i; ?>
									</a>
								</li>
							<?php endfor; ?>

							<?php if ($page < ceil($newsData['totalResults'] / 5)): ?>
								<li class="next">
									<a href="news.php?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($query); ?>">
										<span class="ti-angle-right"></span>
									</a>
								</li>
							<?php endif; ?>

							
						</ul>
					</div>

				</div>

				
			</div>
		</div>
	</div>
	
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