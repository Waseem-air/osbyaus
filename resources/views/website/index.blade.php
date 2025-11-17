@extends('website.layouts.main')
@section('title', 'Home')
@section('meta_description', 'Discover the best global fashion trends. Shop stylish clothing for men & women with fast worldwide delivery.')
@section('meta_keywords', 'fashion store, clothing shop, global fashion, men fashion, women fashion, ecommerce clothing')
@section('content')

<!-- Main Slider Start -->
<div class="ec-main-slider section">
    <div class="position-relative">
        <img src="website/assets/images/banner/01.png" class="ec-slide-bg" alt="">
        <div class="container align-self-center">
            <div class="row">
                <div class="col-12">
                    <div class="ec-slide-content">
                        <h2 class="ec-slide-stitle">Flat Sale</h2>
                        <h1 class="ec-slide-title">50% OFF</h1>
                        <div class="ec-slide-scontent">
                            <h5>Ready To Wear</h5>
                            <p>
                                Explore our curated collection of trendy outfits and timeless classics. Your next
                                favorite look is just a click away!
                            </p>
                        </div>
                        <a href="products.html" class="btn btn-lg">
                            Shop Now
                            <i class="fi-rr-arrow-small-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->

<!-- Main Slider Start -->
<div class="ec-main-slider slider-2 mt-1 section">
    <div class="position-relative">
        <img src="website/assets/images/banner/02.png" class="ec-slide-bg" alt="">
        <div class="container align-self-center">
            <div class="row">
                <div class="col-12">
                    <div class="ec-slide-content">
                        <h2 class="ec-slide-stitle">Flat Sale</h2>
                        <h1 class="ec-slide-title">50% OFF</h1>
                        <div class="ec-slide-scontent">
                            <h5>Ready To Wear</h5>
                            <p>
                                Explore our curated collection of trendy outfits and timeless classics. Your next
                                favorite look is just a click away!
                            </p>
                        </div>
                        <a href="products.html" class="btn btn-lg">
                            Shop Now
                            <i class="fi-rr-arrow-small-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->


<!-- Popular Products Section Start -->
<section class="section ec-exe-spe-section section-space-ptb-100 section-space-mt section-space-mb-100">
    <div class="container">
        <div class="row">
            <!-- Popular Products Section Start -->
            <div class="ec-exe-section col-lg-12 col-md-12 col-sm-12">
                <div class="col-md-12 text-left">
                    <div class="section-title mb-6 d-flex justify-content-between">
                        <h2 class="ec-title">Popular This Week</h2>
                        <a href="{{ route('products.index') }}" class="ec-stitle">View All
                            <img src="website/assets/images/icon/arrow_right.svg" alt="">
                        </a>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="ec-product-content p-0">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="{{ route('product.detail', $product->slug) }}" class="image sale-img">
                                                @if($product->images->count() > 0)
                                                    <img class="main-image" src="{{ asset($product->images->first()->image_path) }}" alt="{{ $product->name }}" />
                                                @else
                                                    <img class="main-image" src="website/assets/images/product/default-product.jpg" alt="{{ $product->name }}" />
                                                @endif
                                            </a>
                                            <div class="ec-pro-actions">
                                                @if($product->categories->count() > 0)
                                                    <span class="badge bg-white">{{ $product->categories->first()->name }}</span>
                                                @endif
                                            </div>
                                            @if($product->discount_price && $product->discount_price < $product->price)
                                                <div class="ec-pro-actions-sale">
                                                    @php
                                                        $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                                    @endphp
                                                    <span class="badge bg-white">{{ $discountPercent }}% OFF</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="{{ route('product.detail', $product->slug) }}">
                                            <h6 class="ec-pro-stitle">{{ $product->name }}</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">
                                            {{ $product->embellishment ? $product->embellishment . ' | ' : '' }}
                                            {{ $product->fabric ? $product->fabric . ' | ' : '' }}
                                            {{ $product->cut ? $product->cut . ' Cut' : '' }}
                                        </p>
                                        <div class="ec-pro-rat-price align-items-center">
                                        <span class="ec-price">
                                            @if($product->discount_price && $product->discount_price < $product->price)
                                                <span class="old-price">{{ App\Helpers\AppHelper::currency_symbol() }}.{{ number_format($product->price, 2) }}</span>
                                                <span class="new-price">{{ App\Helpers\AppHelper::currency_symbol() }}.{{ number_format($product->discount_price, 2) }}</span>
                                            @else
                                                <span class="new-price">{{ App\Helpers\AppHelper::currency_symbol() }}.{{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            @foreach($product->sizes as $size)
                                                <div class="form-check ec-pro-size-btn {{ $size->is_active ? '' : 'empty' }}">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           id="size_{{ $product->id }}_{{ $size->id }}"
                                                        {{ !$size->is_active ? 'disabled' : '' }}>
                                                    <label class="form-check-label" for="size_{{ $product->id }}_{{ $size->id }}">
                                                        {{ $size->short_code ?? $size->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
{{--                                        @if($product->colors->count() > 0)--}}
{{--                                            <div class="ec-pro-color-wrapper mt-2">--}}
{{--                                                <div class="d-flex justify-content-center gap-2">--}}
{{--                                                    @foreach($product->colors as $color)--}}
{{--                                                        <span class="color-swatch"--}}
{{--                                                              style="background-color: {{ $color->hex_code }};--}}
{{--                                                         width: 20px;--}}
{{--                                                         height: 20px;--}}
{{--                                                         border-radius: 50%;--}}
{{--                                                         display: inline-block;--}}
{{--                                                         border: 1px solid #ddd;"--}}
{{--                                                              title="{{ $color->name }}"></span>--}}
{{--                                                    @endforeach--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Popular Products Section End -->
        </div>
    </div>
</section>
<!-- Popular Products Section End -->
@endsection
