<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Quantum Forge - Software House Makassar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheets -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
</head>
<body>

<div class="loading-area">
    <div class="spinner-grow text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="page-wrapper">
    <!-- Main Header -->
    <header class="main-header {{ (request()->routeIs('portfolio.details') || request()->routeIs('portfolio') ||  request()->routeIs('news') || request()->routeIs('contact') || request()->routeIs('section.blog.mobile_app') || request()->routeIs('section.blog.web_app')) ? 'style-three' : '' }}">
        @include('partials.header')
    </header>
    <!-- End Main Header -->

    <!-- Page Content -->
    @yield('content')

    <!-- Main Footer -->
    <footer class="main-footer">
        @include('partials.footer')
    </footer>
</div>

@include('partials.searchPopup')

<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('js/appear.js') }}"></script>
<script src="{{ asset('js/owl.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/parallax.min.js') }}"></script>
<script src="{{ asset('js/tilt.jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/validate.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
