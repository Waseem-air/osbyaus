<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    {{-- ===================== --}}
    {{-- Dynamic Page Title --}}
    {{-- ===================== --}}
    <title>{{ config('app.name', 'OsByAus') }} | @yield('title')</title>
    {{-- ===================== --}}
    {{-- Dynamic SEO Tags --}}
    {{-- ===================== --}}
    <meta name="description" content="@yield('meta_description', 'Shop the latest fashion clothing, shoes, accessories, and new trends for men & women worldwide. Discover premium quality outfits at affordable prices.')"/>
    <meta name="keywords" content="@yield('meta_keywords', 'fashion, clothing, ecommerce, online shopping, mens wear, womens wear, trendy outfits, global fashion store, apparel, accessories')"/>
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('/website/assets/images/logo/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('/website/assets/images/logo/favicon.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('/website/assets/images/logo/favicon.png') }}"/>

    {{-- ================================ --}}
    {{-- CSS Plugins --}}
    {{-- ================================ --}}
    <link rel="stylesheet" href="{{ asset('/website/assets/css/vendor/ecicons.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/swiper-bundle.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/jquery-ui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/countdownTimer.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/slick.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/website/assets/css/plugins/nouislider.css') }}"/>

    {{-- ================================ --}}
    {{-- Main Style --}}
    {{-- ================================ --}}
    <link rel="stylesheet" href="{{ asset('/website/assets/css/style.css') }}"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <style>/* ERROR TEXT — light red */
        .invalid-feedback {
            color: #d9534f !important; /* light red */
            font-size: 14px;
            margin-top: 2px;
        }

        /* ERROR INPUT — fitted soft red border & bg */
        .auth-input.is-invalid {
            border-color: #f5b5b5 !important; /* soft red border */
            box-shadow: none !important;
        }
        .eci-arrow-up{
            margin-top:10px!important;
        }
        /* OPTIONAL: spacing correction */
        .auth-form .col-12.mb-3 {
            margin-bottom: 18px !important;
        }

        /* Add to your main CSS file */
        .fi-rr-spinner.spinner {
            animation: spin 1s linear infinite;
            display: inline-block;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

         .fi-rr-spinner.spinner {
             animation: spin 1s linear infinite;
             display: inline-block;
         }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .cart-count-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #000;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }
        .ec-side-cart {
            z-index: 9999;
        }
        .ec-side-cart-overlay.ec-close {
            opacity: 1;
            visibility: visible;
        }
        .size-badge-custom {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            color: #6c757d;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 4px;
            display: inline-block;
        }
        .size-badge-custom:hover {
            background: #e9ecef;
            border-color: #6c757d;
        }

        /* ------------------------- */
        /* SWEETALERT2 — CUSTOM THEME */
        /* ------------------------- */

        .swal2-container {
            z-index: 999999 !important; /* Highest priority above any overlay */
        }
         .swal2-html-container {
             font-size: 14px !important;
             color: #000000 !important;
         }
        /* Success / Error icons minimal black-white */
        .swal2-icon.swal2-success,
        .swal2-icon.swal2-error,
        .swal2-icon.swal2-warning {
            border-color: #000 !important;
            color: #000 !important;
        }


        /* Buttons */
        .swal2-confirm {
            background: #000 !important;
            color: #fff !important;
            border-radius: 6px !important;
            padding: 8px 20px !important;
        }

        .swal2-cancel {
            background: #e1e1e1 !important;
            color: #000 !important;
            border-radius: 6px !important;
            padding: 8px 20px !important;
        }

        .ec-size-from input {
            width: 100% !important;
        }
        .eccart-pro-items li .ec-pro-content .remove-cart-item {
  line-height: 1.5;
  position: absolute;
  top: 0;
  right: 0;
  padding: 0 9px;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 34px;
  width: 34px;
  color: #D0D0D0;
  border: 1px solid #F2F2F2;
  border-radius: 8px;
  font-size: 18px;
}

.eccart-pro-items li .ec-pro-content .remove-cart-item:hover {
  color: #94010E;
}

    </style>

    {{-- ================================ --}}
    {{-- Extra Styles (Child Pages) --}}
    {{-- ================================ --}}
    @stack('styles')

</head>
