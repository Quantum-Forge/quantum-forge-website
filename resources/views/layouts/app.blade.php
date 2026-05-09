<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Quantum Forge - Software House Makassar')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Quantum Forge adalah Software House di Makassar yang menyediakan layanan Web Development, Mobile App, UI/UX Design, IT Consulting, dan strategi Digital Marketing.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Software House Makassar, Web Development, Mobile App, Digital Marketing, IT Consultant, Jasa Pembuatan Website')">
    <meta name="author" content="Quantum Forge">
    <meta name="robots" content="index, follow">
    <meta name="google-adsense-account" content="{{ config('services.adsense.client_id') }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Quantum Forge - Software House Makassar')">
    <meta property="og:description" content="@yield('meta_description', 'Quantum Forge adalah Software House di Makassar yang menyediakan layanan Web Development, Mobile App, UI/UX Design, IT Consulting, dan strategi Digital Marketing.')">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Quantum Forge - Software House Makassar')">
    <meta property="twitter:description" content="@yield('meta_description', 'Quantum Forge adalah Software House di Makassar yang menyediakan layanan Web Development, Mobile App, UI/UX Design, IT Consulting, dan strategi Digital Marketing.')">
    <meta property="twitter:image" content="@yield('og_image', asset('images/logo.png'))">

    <!-- Schema Markup -->
    @yield('schema_markup')

    @if(config('services.adsense.enabled') && config('services.adsense.client_id') && request()->routeIs('articles.details'))
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ config('services.adsense.client_id') }}" crossorigin="anonymous"></script>
    @endif

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
    <header class="main-header 
    {{ (request()->routeIs('portfolio.details') || 
        request()->routeIs('portfolio') ||
        request()->routeIs('articles') ||   
        request()->routeIs('articles.details') || 
        request()->routeIs('contact') || 
        request()->routeIs('section.blog.mobile_app') || 
        request()->routeIs('section.blog.web_app')) ? 'style-three' : '' }}">
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
