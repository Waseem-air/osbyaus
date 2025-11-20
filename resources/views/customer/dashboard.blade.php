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
                                <li class="ec-breadcrumb-item active">Dashboard</li>
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
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard space-bottom-30">
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="ec-vendor-dashboard-card-profile">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->first_name }}">
                                    @else
                                        <img src="{{ asset('website/assets/images/logo/logo.svg') }}" alt="{{ Auth::user()->first_name }}">
                                    @endif
                                    <div>
                                        <h3>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                                        <p>Customer</p>
                                    </div>
                                    <div class="ec-profile-btn">
                                        <a class="btn text-dark" href="{{ route('customer.profile.edit') }}">Edit Profile</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="ec-vendor-dashboard-card-address">
                                    <h5>Billing Address</h5>
                                    @if($latestOrder)
                                        <div class="mb-4">
                                            <h3>{{ $latestOrder->billing_first_name }} {{ $latestOrder->billing_last_name }}</h3>
                                            <p>
                                                {{ $latestOrder->billing_address }},
                                                {{ $latestOrder->billing_city }},
                                                {{ $latestOrder->billing_state }}
                                                {{ $latestOrder->billing_postal_code }}
                                            </p>
                                        </div>
                                        <div class="mb-1">
                                            <h4>{{ $latestOrder->billing_email }}</h4>
                                            <h4>{{ $latestOrder->billing_phone }}</h4>
                                        </div>
                                    @else
                                        <div class="mb-4">
                                            <h3>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                                            <p>No address information available</p>
                                        </div>
                                        <div class="mb-1">
                                            <h4>{{ Auth::user()->email }}</h4>
                                            <h4>{{ Auth::user()->phone ?? 'No phone number' }}</h4>
                                        </div>
                                    @endif
                                    <div class="ec-address-btn">
                                        <a class="btn text-dark ps-0" href="{{ route('customer.addresses.index') }}">Edit Address</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ec-vendor-dashboard-card">
                            <div class="ec-vendor-card-header">
                                <h5>Recent Order History</h5>
                                <div class="ec-header-btn">
                                    <a class="btn text-dark" href="{{ route('customer.orders.index') }}">View All</a>
                                </div>
                            </div>
                            <div class="ec-vendor-card-body">
                                <div class="ec-vendor-card-table">
                                    @if($recentOrders->count() > 0)
                                        <table class="table ec-table">
                                            <thead>
                                            <tr>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($recentOrders as $order)
                                                <tr>
                                                    <td scope="row"><span>#{{ $order->order_number }}</span></td>
                                                    <td><span>{{ $order->created_at->format('d M Y') }}</span></td>
                                                    <td><span><strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}</strong></span></td>
                                                    <td>
                                    <span class="
                                        @if($order->status == 'delivered') text-success
                                        @elseif($order->status == 'cancelled') text-danger
                                        @elseif($order->status == 'shipped') text-warning
                                        @else text-dark @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                                    </td>
                                                    <td>
                                    <span>
                                        <a class="btn view-detail" href="{{ route('customer.orders.show', $order->id) }}">
                                            View Details
                                        </a>
                                    </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center py-5">
                                            <p class="text-muted">No orders found</p>
                                            <a href="{{ route('home') }}" class="btn btn-dark mt-2">Start Shopping</a>
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
