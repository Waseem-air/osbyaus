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

                <div class="ec-shop-rightside col-xl-9 col-md-12">
                    <div class="ec-vendor-dashboard space-bottom-30">
                        <!-- Statistics Cards -->
                        <div class="row mb-4">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Total Orders</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fi-rr-shopping-bag fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Pending Orders</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingOrders }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fi-rr-time-past fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Completed Orders</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedOrders }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fi-rr-check-circle fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Wishlist Items</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $wishlistCount }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fi-rr-heart fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Orders & Latest Order -->
                        <div class="row">
                            <!-- Recent Orders -->
                            <div class="col-xl-8 col-lg-7">
                                <div class="ec-vendor-dashboard-card p-30">
                                    <div class="ec-vendor-card-header">
                                        <h5>Recent Orders</h5>
                                        <a href="{{ route('customer.orders.index') }}" class="btn btn-sm btn-dark">View All</a>
                                    </div>
                                    <div class="ec-vendor-card-body">
                                        @if($recentOrders->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Order #</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($recentOrders as $order)
                                                        <tr>
                                                            <td>#{{ $order->order_number }}</td>
                                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                            <td>
                                                                <span class="badge badge-{{ $order->status == 'delivered' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                                                    {{ ucfirst($order->status) }}
                                                                </span>
                                                            </td>
                                                            <td>{{  }}{{ number_format($order->total_amount, 2) }}</td>
                                                            <td>
                                                                <a href="{{ route('customer.orders.show', $order->id) }}" class="btn btn-sm btn-outline-dark">View</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="text-center text-muted">No orders found.</p>
                                            <div class="text-center">
                                                <a href="{{ route('home') }}" class="btn btn-dark">Start Shopping</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Latest Order Summary -->
                            <div class="col-xl-4 col-lg-5">
                                @if($latestOrder)
                                    <div class="ec-vendor-dashboard-card p-30">
                                        <div class="ec-vendor-card-header">
                                            <h5>Latest Order</h5>
                                        </div>
                                        <div class="ec-vendor-card-body">
                                            <div class="order-summary">
                                                <h6>#{{ $latestOrder->order_number }}</h6>
                                                <p class="text-muted">Placed on {{ $latestOrder->created_at->format('M d, Y') }}</p>

                                                <div class="order-items">
                                                    @foreach($latestOrder->items->take(2) as $item)
                                                        <div class="d-flex align-items-center mb-2">
                                                            @if($item->product && $item->product->mainImage)
                                                                <img src="{{ asset('storage/' . $item->product->mainImage->image_path) }}"
                                                                     alt="{{ $item->product_name }}"
                                                                     class="img-fluid rounded"
                                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                                            @else
                                                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                                     style="width: 50px; height: 50px;">
                                                                    <i class="fi-rr-box"></i>
                                                                </div>
                                                            @endif
                                                            <div class="ms-3">
                                                                <p class="mb-0 small">{{ Str::limit($item->product_name, 20) }}</p>
                                                                <p class="mb-0 text-muted small">Qty: {{ $item->quantity }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if($latestOrder->items->count() > 2)
                                                        <p class="text-muted small">+{{ $latestOrder->items->count() - 2 }} more items</p>
                                                    @endif
                                                </div>

                                                <div class="order-total mt-3 pt-3 border-top">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>Total:</strong>
                                                        <strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($latestOrder->total_amount, 2) }}</strong>
                                                    </div>
                                                </div>

                                                <div class="mt-3">
                                                    <a href="{{ route('customer.orders.show', $latestOrder->id) }}" class="btn btn-dark btn-sm w-100">View Order Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Quick Stats -->
                                <div class="ec-vendor-dashboard-card p-30 mt-4">
                                    <div class="ec-vendor-card-header">
                                        <h5>Quick Stats</h5>
                                    </div>
                                    <div class="ec-vendor-card-body">
                                        <div class="quick-stats">
                                            <div class="stat-item d-flex justify-content-between mb-2">
                                                <span>This Month:</span>
                                                <strong>{{ $monthlyOrders }} orders</strong>
                                            </div>
                                            <div class="stat-item d-flex justify-content-between mb-2">
                                                <span>Total Spent:</span>
                                                <strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($totalSpent, 2) }}</strong>
                                            </div>
                                            <div class="stat-item d-flex justify-content-between">
                                                <span>Member Since:</span>
                                                <strong>{{ Auth::user()->created_at->format('M Y') }}</strong>
                                            </div>
                                        </div>
                                    </div>
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
