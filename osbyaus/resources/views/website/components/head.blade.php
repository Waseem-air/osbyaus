<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    {{-- ===================== --}}
    {{-- Dynamic Page Title --}}
    {{-- ===================== --}}
    <title>@yield('title', 'Global Fashion Store - Trendy Clothing for Men & Women')</title>

    {{-- ===================== --}}
    {{-- Dynamic SEO Tags --}}
    {{-- ===================== --}}
    <meta name="description" content="@yield('meta_description', 'Shop the latest fashion clothing, shoes, accessories, and new trends for men & women worldwide. Discover premium quality outfits at affordable prices.')" />

    <meta name="keywords" content="@yield('meta_keywords', 'fashion, clothing, ecommerce, online shopping, mens wear, womens wear, trendy outfits, global fashion store, apparel, accessories')" />

    <meta name="author" content="YourBrandName">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('website/assets/images/logo/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('website/assets/images/logo/favicon.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('website/assets/images/logo/favicon.png') }}" />

    {{-- ================================ --}}
    {{-- CSS Plugins --}}
    {{-- ================================ --}}
    <link rel="stylesheet" href="{{ asset('website/assets/css/vendor/ecicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/countdownTimer.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/css/plugins/nouislider.css') }}" />

    {{-- ================================ --}}
    {{-- Main Style --}}
    {{-- ================================ --}}
    <link rel="stylesheet" href="{{ asset('website/assets/css/style.css') }}" />

    {{-- ================================ --}}
    {{-- Extra Styles (Child Pages) --}}
    {{-- ================================ --}}
    @yield('styles')

</head>
