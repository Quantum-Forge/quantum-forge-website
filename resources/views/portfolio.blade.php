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
        // Copy data dari portfolio.json ke dalam array PHP
        $portfolios = [
            [
                'id' => 1,
                'title' => 'Buahatiku-MIS',
                'date' => '01/09/2023',
                'clients' => 'Mr. A',
                'category' => 'Web Application',
                'kota' => 'Makassar, Indonesia',
                'description_proyek' => 'Buah Hatiku adalah sebuah aplikasi berbasis web yang dirancang khusus untuk digunakan oleh admin dan terapis yang memiliki hak akses khusus. Aplikasi ini memungkinkan admin untuk mengelola data anak terapi, mengatur jadwal terapi, dan mengakses informasi penting terkait dengan terapi autisme. Terapis yang merupakan pemilik dari pusat terapi juga dapat menggunakan aplikasi ini untuk mencatat perkembangan pasien, merencanakan sesi terapi, dan berkomunikasi dengan admin serta orang tua pasien. Dengan fokus pada keamanan dan keberlangsungan layanan terapi, aplikasi ini memberikan solusi yang efisien dan terpercaya bagi penyedia layanan terapi autisme.',
                'link' => null,
                'images1' => 'images/project/buahatiku/bh-01.png',
                'heading' => 'Yayasan Terapi Autistik Buahatiku.',
                'description2' => 'Yayasan Terapi Autistik Buahatiku didirikan untuk memberikan dukungan dan layanan terapi bagi anak-anak dengan autisme di Makassar. Buahatiku menyediakan berbagai program terapi individual yang dirancang khusus untuk kebutuhan unik setiap anak. Layanan Buahatiku meliputi terapi wicara, okupasi, dan perilaku, yang dilakukan oleh tim profesional terlatih. Buahatiku juga menyediakan dukungan bagi keluarga, memberikan edukasi dan sumber daya agar mereka dapat mendukung perkembangan anak-anak mereka dengan lebih baik. Misi Buahatiku adalah membantu setiap anak autistik mencapai potensi penuh mereka dalam lingkungan yang mendukung dan inklusif.',
                'images2' => 'images/project/buahatiku/bh-02.png',
                'images3' => 'images/project/buahatiku/bh-03.png',
                'images4' => 'images/project/buahatiku/bh-04.png',
            ],
            [
                'id' => 2,
                'title' => 'Siagamedika-CMS',
                'date' => '17/08/2023',
                'clients' => 'Mr. B',
                'category' => 'CMS, Website',
                'kota' => 'Makassar, Indonesia',
                'description_proyek' => 'Siagamedika CMS adalah sebuah sistem manajemen konten yang dirancang khusus untuk menampilkan produk alat-alat kesehatan milik PT Siagamedika Abadi Karya. Sistem ini bertujuan untuk memudahkan pengelolaan informasi Produk, Mengoptimalkan SEO, integrasi Whatsapp chat dan layanan promosi produk dengan lebih efisien dan efektif. Dalam pengembangan Siagamedika CMS, Pihak Quantum Forge membantu Software House Rumah Pintar dalam mendesain UI dan sistemnya. Kolaborasi ini bertujuan untuk menciptakan antarmuka yang intuitif dan fungsional, serta memastikan sistem berjalan dengan optimal.',
                'link' => 'https://ptsiagamedika.com/',
                'images1' => 'images/project/siagamedika/sm-01.png',
                'heading' => 'PT Siagamedika Abadi Karya.',
                'description2' => 'PT. Siaga Medika adalah perusahaan ritel alat kesehatan dan kedokteran serta laboratorium yang sedang berdiri di tanggal 10 Bulan Oktober tahun 2010 di Makassar. PT Siaga Medika mempunyai jam terbang tinggi dan siap untuk berkomptetisi di derasnya persaingan alat kesehatan saat ini.',
                'images2' => 'images/project/siagamedika/sm-02.png',
                'images3' => 'images/project/siagamedika/sm-03.png',
                'images4' => 'images/project/siagamedika/sm-04.png',
            ],
            [
                'id' => 3,
                'title' => 'Sistem Keranjang RICO',
                'date' => '07/07/2023',
                'clients' => 'Mr. T',
                'category' => 'Cart System, Landing Page',
                'kota' => 'Makassar, Indonesia',
                'description_proyek' => 'Landing Page RICO adalah proyek pengembangan halaman arahan untuk produk air minum kemasan RICO. Proyek ini mencakup sistem keranjang belanja yang langsung di arahkan ke Whatsapp kantor untuk memudahkan pembelian produk secara langsung. Halaman arahan ini dirancang untuk memberikan informasi lengkap tentang produk RICO, memudahkan navigasi pengguna, dan meningkatkan pengalaman berbelanja secara keseluruhan. Quantum Forge Software Makassar membantu dalam desain dan pengembangan sistem ini untuk memastikan tampilan yang menarik dan fungsionalitas yang optimal.',
                'link' => 'https://ricosegar.com/',
                'images1' => 'images/project/ricosegar/rico-01.png',
                'heading' => 'PT Antariksa Prakarsa Utama.',
                'description2' => 'PT. Antariksa Prakarsa Utama adalah distributor makanan yang telah berpengalaman selama 35 tahun. Perusahaan ini dikenal karena komitmennya terhadap kualitas dan kepuasan pelanggan, serta memiliki jaringan distribusi yang luas dan efisien. Dengan pengalaman yang luas dalam industri makanan, PT Antariksa Prakarsa Utama terus berinovasi untuk memenuhi kebutuhan pasar yang terus berkembang.',
                'images2' => 'images/project/ricosegar/rico-02.png',
                'images3' => 'images/project/ricosegar/rico-03.png',
                'images4' => 'images/project/ricosegar/rico-04.png',
            ],
        ];

        // Pagination variables (mengikuti logika legacy)
        $perPage = 6; // Number of items per page
        $totalItems = count($portfolios);
        $totalPages = (int) ceil($totalItems / $perPage);

        // Get current page from query string, default is 1
        $page = (int) request()->integer('page', 1);
        $page = max(1, min($totalPages, $page)); // Ensure page is within valid range

        // Calculate the offset and limit for the current page
        $offset = ($page - 1) * $perPage;
        $portfoliosOnPage = array_slice($portfolios, $offset, $perPage);

        // Determine if pagination should be hidden
        $paginationClass = $totalItems <= $perPage ? 'd-none' : '';
    @endphp

    <!-- Start Project Details -->
    <div class="project-section section-padding">
        <div class="auto-container">
            <div class="row clearfix">
                @foreach ($portfoliosOnPage as $portfolio)
                    <div class="team-block col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
                            <div class="image">
                                <a href="{{ route('portfolio.details', ['id' => $portfolio['id']]) }}"><img src="{{ $portfolio['images1'] }}" alt=""></a>
                                <!-- Social Box -->
                                <ul class="social-box">
                                    <li><a href="https://api.whatsapp.com/send/?phone=6285163619381&text=%22Hi+Quantum%2C+saya+tertarik+untuk+menggunakan+jasa+IT+dari+Anda.+Bolehkah+saya+mendapatkan+informasi+lebih+lanjut%3F+Terima+kasih%21%22&type=phone_number&app_absent=0" class="icofont-whatsapp"></a></li>
                                    <li><a href="https://www.instagram.com/quantumitco/" class="icofont-instagram"></a></li>
                                    <li><a href="https://www.linkedin.com/company/quantumforge-mks/" class="icofont-linkedin"></a></li>
                                </ul>
                            </div>
                            <div class="lower-box mt-0">
                                <h4><a href="{{ route('portfolio.details', ['id' => $portfolio['id']]) }}">{{ $portfolio['title'] }}</a></h4>
                                <div class="designation">{{ $portfolio['category'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

             <!-- Pagination -->
            <div class="styled-pagination d-flex justify-content-center {{ $paginationClass }}">
                <ul class="clearfix">
                    @if ($page > 1)
                        <li class="previous"><a href="?page={{ $page - 1 }}"><span class="ti-angle-left"></span> </a></li>
                    @endif

                    @for ($i = 1; $i <= $totalPages; $i++)
                        <li class="{{ $i == $page ? 'active' : '' }}"><a href="?page={{ $i }}">{{ $i }}</a></li>
                    @endfor

                    @if ($page < $totalPages)
                        <li class="next"><a href="?page={{ $page + 1 }}"><span class="ti-angle-right"></span> </a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- End Project Details -->


@endsection
