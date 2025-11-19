@extends('website.layouts.main')
@section('title', 'Payment Cancelled')
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
                                <li class="ec-breadcrumb-item"><a href="{{ route('cart.index') }}">Shopping Cart</a></li>
                                <li class="ec-breadcrumb-item"><a href="{{ route('checkout.index') }}">Checkout</a></li>
                                <li class="ec-breadcrumb-item active">Payment Cancelled</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            <h4 class="mb-0"><i class="fi-rr-cross-circle"></i> Payment Cancelled</h4>
                        </div>
                        <div class="card-body py-5">
                            <div class="mb-4">
                                <i class="fi-rr-cross-circle" style="font-size: 4rem; color: #dc3545;"></i>
                            </div>
                            <h3 class="text-danger mb-3">Payment Process Cancelled</h3>
                            <p class="lead mb-4">{{ session('error') ?? 'Your payment was cancelled. You can try again with your existing cart items.' }}</p>

                            <div class="alert alert-info text-start">
                                <h6><i class="fi-rr-info"></i> Note:</h6>
                                <p class="mb-0">Your cart items have been preserved. You can return to your cart and complete the checkout process when you're ready.</p>
                            </div>

                            <div class="mt-5">
                                <div class="d-flex gap-3 justify-content-center flex-wrap">
                                    <a href="{{ route('cart.index') }}" class="btn btn-dark btn-lg">
                                        <i class="fi-rr-shopping-cart"></i> Return to Cart
                                    </a>
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-lg">
                                        <i class="fi-rr-shopping-bag"></i> Continue Shopping
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
