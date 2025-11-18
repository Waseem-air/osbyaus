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

                                            <div>
                                                <p class="text-center mt-2 small text-muted">
                                                    Please login to proceed with checkout
                                                </p>
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

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login Required</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-dark w-100" id="loginBtn">
                            <span class="login-text">Login</span>
                            <span class="loading-text d-none">
                            <i class="fi-rr-spinner spinner me-2"></i> Logging in...
                        </span>
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">Don't have an account?
                            <a href="{{ route('register') }}" class="text-dark">Register here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<!-- ======================== -->
<!-- Vendor JS -->
<!-- ======================== -->
<script src="{{ asset('website/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('website.cart.partials.cart-page-ajax')
