@extends('website.layouts.main')
@section('title', 'Home')
@section('meta_description', 'Discover the best global fashion trends. Shop stylish clothing for men & women with fast worldwide delivery.')
@section('meta_keywords', 'fashion store, clothing shop, global fashion, men fashion, women fashion, ecommerce clothing')
@section('content')

<!-- Main Slider Start -->
<div class="ec-main-slider section">
    <div class="position-relative">
        <img src="{{ asset('website/assets/images/banner/01.png') }}" class="ec-slide-bg" alt="">
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
                        <a href="{{ route('products.index') }}" class="btn btn-lg">
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
        <img src="{{ asset('website/assets/images/banner/02.png') }}" class="ec-slide-bg" alt="">
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
                        <a href="{{ route('products.index') }}" class="btn btn-lg">
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
                            <img src="website/assets/images/icon/arrow_right.svg" alt="" class="">
                        </a>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            @include('website.partials.product-cards')
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
