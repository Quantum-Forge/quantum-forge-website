<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Quantum Forge - Software House Makassar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1A73E8">
    <meta name="msapplication-TileColor" content="#1A73E8">
    <!-- Stylesheets -->
    @vite(['resources/css/app.css'])

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
    <header class="main-header {{ (request()->routeIs('portfolio.details') || request()->routeIs('portfolio') ||  request()->routeIs('articles') || request()->routeIs('contact') || request()->routeIs('section.blog.mobile_app') || request()->routeIs('section.blog.web_app')) ? 'style-three' : '' }}">
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
@vite(['resources/js/app.js'])

</body>
</html>
