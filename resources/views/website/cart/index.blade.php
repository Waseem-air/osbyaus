@extends('website.layouts.main')
@section('title', 'Shopping Cart')
@section('meta_description', 'Review your shopping cart items')
@section('meta_keywords', 'cart, shopping cart, items, checkout')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-12 col-sm-12">
                            <ul class="ec-breadcrumb-list text-left">
                                <li class="ec-breadcrumb-item"><a href="{{ route('home') }}"><i class="fi-rr-home"></i> Home</a></li>
                                <li class="ec-breadcrumb-item active">Shopping Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Cart Section Start -->
    <section class="ec-page-content cart_page section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <div class="table-content cart-table-content">
                                    <div id="cart-items-container">
                                        @include('website.cart.partials.cart-items', ['cart' => $cart])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- cart content End -->
                </div>

                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block border-0">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Cart Total</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">
                                        <div>
                                            <span class="text-left">Subtotal</span>
                                            <span class="text-right" id="cart-subtotal">
                                            {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($cart->subtotal ?? 0, 2) }}
                                        </span>
                                        </div>
                                        <div>
                                            <span class="text-left">Shipping</span>
                                            <span class="text-right">
                                            <span class="text-left">(Free Delivery)</span>
                                            {{ App\Helpers\AppHelper::currency_symbol() }}0.00
                                        </span>
                                        </div>
                                        <div class="ec-cart-summary-total">
                                            <span class="text-left">Total Amount</span>
                                            <span class="text-right-total" id="cart-total">
                                            {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($cart->total ?? 0, 2) }}
                                        </span>
                                        </div>

                                        @auth
                                            <div>
                                                <a href="{{ route('checkout') }}" class="btn btn-dark py-2 mt-4 w-100 h-100">
                                                    Proceed to checkout <i class="ecicon eci-angle-right ms-2"></i>
                                                </a>
                                            </div>
                                        @else
                                            <div>
                                                <button type="button" class="btn btn-dark py-2 mt-4 w-100 h-100"
                                                        onclick="showLoginModal()">
                                                    Login to Checkout <i class="ecicon eci-angle-right ms-2"></i>
                                                </button>
                                     </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Ec Cart Section End -->


    <!-- Related Products Section Start -->
    @if($relatedPopular->count() > 0)
        <section class="section ec-exe-spe-section section-space-mt section-space-mb-100" style="margin-bottom: 220px !important;">
            <div class="container">
                <div class="row">
                    <div class="ec-exe-section col-lg-12 col-md-12 col-sm-12">
                        <div class="col-md-12 text-left">
                            <div class="section-title mb-6 d-flex justify-content-between">
                                <h2 class="ec-title">Related Products</h2>
                                <a href="{{ route('products.index') }}" class="ec-stitle">View All
                                    <img src="{{ asset('website/assets/images/icon/arrow_right.svg') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($relatedPopular as $relatedProduct)
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="ec-product-content p-0">
                                        <div class="ec-product-inner hot-sale-card">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image hot-sale-img">
                                                    <a href="{{ route('product.detail', $relatedProduct->slug) }}"
                                                       class="image sale-img">
                                                        @if($relatedProduct->images->count() > 0)
                                                            <img class="main-image"
                                                                 src="{{ asset($relatedProduct->images->first()->image_path) }}"
                                                                 alt="{{ $relatedProduct->name }}"/>
                                                        @else
                                                            <img class="main-image"
                                                                 src="{{ asset('website/assets/images/product/default-product.jpg') }}"
                                                                 alt="{{ $relatedProduct->name }}"/>
                                                        @endif
                                                    </a>
                                                    <div class="ec-pro-actions">
                                                        @if($relatedProduct->categories->count() > 0)
                                                            <span
                                                                class="badge bg-white">{{ $relatedProduct->categories->first()->name }}</span>
                                                        @endif
                                                    </div>
                                                    @if($relatedProduct->discount_price && $relatedProduct->discount_price < $relatedProduct->price)
                                                        <div class="ec-pro-actions-sale">
                                                            @php
                                                                $discountPercent = round((($relatedProduct->price - $relatedProduct->discount_price) / $relatedProduct->price) * 100);
                                                            @endphp
                                                            <span
                                                                class="badge bg-white">{{ $discountPercent }}% OFF</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="ec-pro-content text-center">
                                                <a href="{{ route('product.detail', $relatedProduct->slug) }}">
                                                    <h6 class="ec-pro-stitle">{{ $relatedProduct->name }}</h6>
                                                </a>
                                                <p class="ec-pro-subtitle">
                                                    {{ $relatedProduct->embellishment ? $relatedProduct->embellishment . ' | ' : '' }}
                                                    {{ $relatedProduct->fabric ? $relatedProduct->fabric . ' | ' : '' }}
                                                    {{ $relatedProduct->cut ? $relatedProduct->cut . ' Cut' : '' }}
                                                </p>
                                                <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                @if($relatedProduct->discount_price && $relatedProduct->discount_price < $relatedProduct->price)
                                                    <span class="old-price">{{ App\Helpers\AppHelper::currency_symbol() }}.{{ number_format($relatedProduct->price, 2) }}</span>
                                                    <span class="new-price">{{ App\Helpers\AppHelper::currency_symbol() }}.{{ number_format($relatedProduct->discount_price, 2) }}</span>
                                                @else
                                                    <span class="new-price">{{ App\Helpers\AppHelper::currency_symbol() }}.{{ number_format($relatedProduct->price, 2) }}</span>
                                                @endif
                                            </span>
                                                </div>
                                                <div class="ec-pro-size-wrapper">
                                                    @foreach($relatedProduct->sizes->take(4) as $size)
                                                        <div
                                                            class="form-check ec-pro-size-btn {{ $size->is_active ? '' : 'empty' }}">
                                                            <input class="form-check-input"
                                                                   type="checkbox"
                                                                   id="rel_size_{{ $relatedProduct->id }}_{{ $size->id }}"
                                                                {{ !$size->is_active ? 'disabled' : '' }}>
                                                            <label class="form-check-label"
                                                                   for="rel_size_{{ $relatedProduct->id }}_{{ $size->id }}">
                                                                {{ $size->short_code ?? $size->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Related Products Section End -->

    <!-- Login Modal -->
    @include('website.cart.partials.loginModal')
@endsection
<!-- ======================== -->
<!-- Vendor JS -->
<!-- ======================== -->
<script src="{{ asset('website/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('website.cart.partials.cart-page-ajax')
