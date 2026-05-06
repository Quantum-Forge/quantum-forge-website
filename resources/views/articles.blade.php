@extends('layouts.app')

@section('content')
    <!-- Page Title Section -->
    <div class="page-title-section">
        <div class="auto-container">
            <ul class="post-meta">
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li>Artikel</li>
            </ul>
            <h2><span>Artikel</span> Terbaru</h2>
        </div>
    </div>
    <!-- End Page Title Section -->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container padding-top">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Content Side -->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">

                    <div class="our-blogs">
                        <!-- News Block Three -->
                        <div class="news-block-three">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="#">
                                        <img style="height: 188px; object-fit: cover;" src="{{ asset('build/assets/images/resource/news-1.jpg') }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="" />
                                    </a>
                                </div>
                                <div class="title">Technology</div>
                                <h4>
                                    <a href="#">Contoh Judul Artikel Pertama</a>
                                </h4>
                                <div class="post-date">
                                    January 10th, 2024 by
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>

                        <!-- News Block Three -->
                        <div class="news-block-three">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="#">
                                        <img style="height: 169px; object-fit: cover;" src="{{ asset('build/assets/images/resource/news-2.jpg') }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="" />
                                    </a>
                                </div>
                                <div class="title">Software</div>
                                <h4>
                                    <a href="#">Contoh Judul Artikel Kedua</a>
                                </h4>
                                <div class="post-date">
                                    February 15th, 2024 by
                                    <span>Penulis</span>
                                </div>
                            </div>
                        </div>

                        <!-- News Block Three -->
                        <div class="news-block-three">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="#">
                                        <img style="height: 169px; object-fit: cover;" src="{{ asset('build/assets/images/resource/news-3.jpg') }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="" />
                                    </a>
                                </div>
                                <div class="title">Programming</div>
                                <h4>
                                    <a href="#">Contoh Judul Artikel Ketiga</a>
                                </h4>
                                <div class="post-date">
                                    March 20th, 2024 by
                                    <span>Editor</span>
                                </div>
                            </div>
                        </div>

                        <!-- Dummy Content Tambahan agar halaman lebih panjang dari sidebar -->
                        <div class="news-block-three">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="#">
                                        <img style="height: 169px; object-fit: cover;" src="{{ asset('build/assets/images/resource/news-1.jpg') }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="" />
                                    </a>
                                </div>
                                <div class="title">AI & Machine Learning</div>
                                <h4>
                                    <a href="#">Contoh Judul Artikel Keempat</a>
                                </h4>
                                <div class="post-date">
                                    April 10th, 2024 by
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>

                        <div class="news-block-three">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="#">
                                        <img style="height: 169px; object-fit: cover;" src="{{ asset('build/assets/images/resource/news-2.jpg') }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="" />
                                    </a>
                                </div>
                                <div class="title">Web Development</div>
                                <h4>
                                    <a href="#">Contoh Judul Artikel Kelima</a>
                                </h4>
                                <div class="post-date">
                                    May 5th, 2024 by
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>

                        <div class="news-block-three">
                            <div class="inner-box">
                                <div class="image">
                                    <a href="#">
                                        <img style="height: 169px; object-fit: cover;" src="{{ asset('build/assets/images/resource/news-3.jpg') }}" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/previews/022/059/000/non_2x/no-image-available-icon-vector.jpg';" alt="" />
                                    </a>
                                </div>
                                <div class="title">Mobile Apps</div>
                                <h4>
                                    <a href="#">Contoh Judul Artikel Keenam</a>
                                </h4>
                                <div class="post-date">
                                    June 12th, 2024 by
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="styled-pagination">
                        <ul class="clearfix">
                            <li class="prev">
                                <a href="#">
                                    <span class="ti-angle-left"></span>
                                </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li class="next">
                                <a href="#">
                                    <span class="ti-angle-right"></span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                @include('section.articles.sidebar')

            </div>
        </div>
    </div>
@endsection
