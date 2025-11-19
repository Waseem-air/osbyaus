@extends('website.layouts.main')
@section('title', 'Order Confirmed - Thank You')
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
                                <li class="ec-breadcrumb-item active">Order Confirmed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <section class="ec-page-content order-success section-space-p">
        <div class="container">
            <!-- Order Success Content Start -->
            <div class="ec-ordersuccess-content col-md-9 mx-auto">
                <div class="row">
                    <div class="col-lg-6 d-grid justify-content-center align-items-center">
                        <div class="order-img-wrapper">
                            <img src="{{ asset('website/assets/images/product/17.png') }}" alt="Order Success">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ec-ordersuccess-item mt-md-0 mt-4">
                            <h1>Your order has been confirmed successfully!</h1>
                            <p>
                                Enter your order number below to easily track the status of your shipment and stay
                                updated on your delivery!
                            </p>
                            <div class="ec-ordersuccess-item-inner">
                                <div class="row">
                                    <div class="col-6">
                                        <span>
                                            <h5>Order Number</h5>
                                            <h1>#{{ $order->order_number }}</h1>
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span>
                                            <h5>Status</h5>
                                            <h1 class="text-success">{{ ucfirst($order->status) }}</h1>
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span>
                                            <h5>Order Date</h5>
                                            <h1>{{ $order->created_at->format('F d, Y') }}</h1>
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span>
                                            <h5>Expected Delivery</h5>
                                            <h1>{{ $order->created_at->addDays(5)->format('F d, Y') }}</h1>
                                        </span>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="order-summary-card p-3 bg-light rounded">
                                            <h6 class="mb-3">Order Summary:</h6>
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong>Items Total:</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->subtotal, 2) }}
                                                </div>
                                            </div>
                                            @if($order->shipping_amount > 0)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <strong>Shipping:</strong>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->shipping_amount, 2) }}
                                                    </div>
                                                </div>
                                            @endif
                                            @if($order->tax_amount > 0)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <strong>Tax:</strong>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->tax_amount, 2) }}
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row mt-2 pt-2 border-top">
                                                <div class="col-6">
                                                    <strong>Total Paid:</strong>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="shipping-info">
                                            <h6>Shipping Address:</h6>
                                            <p class="mb-1">
                                                {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                                                {{ $order->shipping_address }}<br>
                                                {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}<br>
                                                {{ $order->shipping_country }}
                                            </p>
                                            <p class="mb-0">
                                                <i class="fi-rr-phone-call"></i> {{ $order->shipping_phone }}<br>
                                                <i class="fi-rr-envelope"></i> {{ $order->shipping_email }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <div class="d-flex gap-3 flex-wrap">
                                            <a href="{{ route('products.index') }}" class="btn btn-dark back-btn">
                                                <i class="ecicon eci-angle-left"></i> Continue Shopping
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order Success Content end -->
        </div>
    </section>

@endsection
