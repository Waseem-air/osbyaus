@extends('website.layouts.main')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-12 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list text-left">
                                <li class="ec-breadcrumb-item"><a href="{{ route('home') }}"><i class="fi-rr-home"></i></a></li>
                                <li class="ec-breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                <li class="ec-breadcrumb-item"><a href="{{ route('customer.orders.index') }}">Order History</a></li>
                                <li class="ec-breadcrumb-item active">Order Details</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Vendor dashboard section -->
    <section class="ec-page-content ec-vendor-dashboard section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('customer.components.sidebar')

                <div class="ec-shop-rightside col-xl-9 col-md-12">
                    <div class="ec-vendor-dashboard space-bottom-30">
                        <div class="ec-vendor-dashboard-card p-30">
                            <div class="ec-vendor-card-header px-0 pt-0">
                                <div class="ec-vendor-card-header-inner">
                                    <h5>Order Details</h5>
                                    <p>{{ $order->created_at->format('F d, Y') }} · {{ $order->items->count() }} Products</p>
                                </div>
                                <div class="ec-header-btn">
                                    <a class="btn text-dark" href="{{ route('customer.orders.index') }}">Back to List</a>
                                </div>
                            </div>
                            <div class="ec-vendor-card-body">
                                <div class="order-summary">
                                    <!-- Address Area Start -->
                                    <div class="row">
                                        <div class="col-lg-8 mb-3">
                                            <div class="address-card">
                                                <div class="card billing-card">
                                                    <div class="card-header">
                                                        <h3>Billing Address</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="mb-4">
                                                            <h5>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</h5>
                                                            <p>
                                                                {{ $order->billing_address }},
                                                                {{ $order->billing_city }},
                                                                {{ $order->billing_state }}
                                                                {{ $order->billing_postal_code }},
                                                                {{ $order->billing_country }}
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p>Email</p>
                                                            <h5>{{ $order->billing_email }}</h5>
                                                        </div>
                                                        <div>
                                                            <p>Phone</p>
                                                            <h5>{{ $order->billing_phone }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($order->shipping_address)
                                                    <div class="card shipping-card">
                                                        <div class="card-header">
                                                            <h3>Shipping Address</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="mb-4">
                                                                <h5>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</h5>
                                                                <p>
                                                                    {{ $order->shipping_address }},
                                                                    {{ $order->shipping_city }},
                                                                    {{ $order->shipping_state }}
                                                                    {{ $order->shipping_postal_code }},
                                                                    {{ $order->shipping_country }}
                                                                </p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <p>Email</p>
                                                                <h5>{{ $order->shipping_email }}</h5>
                                                            </div>
                                                            <div>
                                                                <p>Phone</p>
                                                                <h5>{{ $order->shipping_phone }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- Address Section End -->
                                        <div class="col-lg-4 mb-3">
                                            <div class="card-total">
                                                <div class="card-header">
                                                    <div>
                                                        <h5>Order ID:</h5>
                                                        <h3>#{{ $order->order_number }}</h3>
                                                    </div>
                                                    <div class="card-total-divider"></div>
                                                    <div>
                                                        <h5>Payment Method:</h5>
                                                        <h3>{{ ucfirst($order->payment_method) }}</h3>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <ul>
                                                        <li><a>Subtotal:</a> {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->subtotal, 2) }}</li>
                                                        <li><a>Tax:</a> {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->tax_amount, 2) }}</li>
                                                        <li><a>Shipping:</a> {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->shipping_amount, 2) }}</li>
                                                        <li><a>Total</a> {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Address Area End -->

                                    <div class="row">
                                        <div class="ec-trackorder-inner p-0 border-0">
                                            <div class="ec-trackorder-bottom">
                                                <div class="ec-progress-track">
                                                    <ul id="ec-progressbar">

                                                        @php
                                                            // Define order progress levels
                                                            $stepLevels = [
                                                                'pending'    => 0,
                                                                'confirmed'  => 1,
                                                                'processing' => 1,
                                                                'shipped'    => 2,
                                                                'delivered'  => 3,
                                                                'cancelled'  => 0,
                                                            ];

                                                            // Get current step index
                                                            $currentIndex = $stepLevels[$order->status] ?? 0;
                                                        @endphp

                                                        {{-- Step 0: Order Received --}}
                                                        <li class="step0 {{ $currentIndex >= 0 ? 'active' : '' }}">
                                                            <span class="ec-progressbar-track"></span>
                                                            <span class="ec-track-title">Order received</span>
                                                        </li>

                                                        {{-- Step 1: Processing --}}
                                                        <li class="step2 {{ $currentIndex >= 1 ? 'active' : '' }}">
                                                            <span class="ec-progressbar-track"></span>
                                                            <span class="ec-track-title">Processing</span>
                                                        </li>

                                                        {{-- Step 2: On the way --}}
                                                        <li class="step3 {{ $currentIndex >= 2 ? 'active' : '' }}">
                                                            <span class="ec-progressbar-track"></span>
                                                            <span class="ec-track-title">On the way</span>
                                                        </li>

                                                        {{-- Step 3: Delivered --}}
                                                        <li class="step4 {{ $currentIndex >= 3 ? 'active' : '' }}">
                                                            <span class="ec-progressbar-track"></span>
                                                            <span class="ec-track-title">Delivered</span>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Products Section -->
                                    <div class="row">
                                        @foreach($order->items as $item)
                                            <div class="col-lg-6 col-sm-12 mb-4">
                                                <div class="product-item text-center">

                                                    {{-- Product Image --}}
                                                    @if($item->product && $item->product->mainImage)
                                                        <img src="{{ asset($item->product->mainImage->image_path) }}"
                                                             alt="{{ $item->product_name }}"
                                                             style="max-height: 200px; object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('assets/images/product/03.png') }}"
                                                             alt="Product Image"
                                                             style="max-height: 200px; object-fit: cover;">
                                                    @endif

                                                    {{-- Product Info --}}
                                                    <div class="product-info text-start mt-3">
                                                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                            {{ $item->product_name }}
                                                        </p>
                                                        @if($item->variant_details)
                                                            <small class="text-muted small">{{ $item->variant_details }}</small>
                                                        @endif
                                                        {{-- Inner price & quantity row --}}
                                                        <div class="product-item-inner d-flex justify-content-between align-items-center">
                                                            <h2>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($item->price, 2) }}</h2>
                                                            <p class="mb-0">x {{ $item->quantity }}</p>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                    <!-- Order Actions -->
                                    @if(in_array($order->status, ['pending', 'confirmed']))
                                        <div class="row mt-4">
                                            <div class="col-12 text-end">
                                                <form action="{{ route('customer.orders.cancel', $order->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?')">
                                                        Cancel Order
                                                    </button>
                                                </form>
                                                <a href="{{ route('customer.orders.invoice', $order->id) }}" class="btn btn-dark ms-2">
                                                    Download Invoice
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Vendor dashboard section -->
@endsection
