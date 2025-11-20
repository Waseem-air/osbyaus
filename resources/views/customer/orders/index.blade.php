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
                                <li class="ec-breadcrumb-item active">Order History</li>
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
                        <div class="ec-vendor-dashboard-card">
                            <div class="ec-vendor-card-header">
                                <h5>Order History</h5>
                                <div class="ec-header-btn">
                                    <span class="text-muted">Total Orders: {{ $orders->total() }}</span>
                                </div>
                            </div>
                            <div class="ec-vendor-card-body">
                                <div class="ec-vendor-card-table">
                                    @if($orders->count() > 0)
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
                                            @foreach($orders as $order)
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

                                        <!-- Pagination -->
                                        @if($orders->hasPages())
                                            <div class="mt-4">
                                                {{ $orders->links() }}
                                            </div>
                                        @endif

                                    @else
                                        <div class="text-center py-5">
                                            <div class="mb-4">
                                                <i class="fi-rr-shopping-cart" style="font-size: 4rem; color: #ddd;"></i>
                                            </div>
                                            <h5 class="text-muted">No orders found</h5>
                                            <p class="text-muted mb-4">You haven't placed any orders yet.</p>
                                            <a href="{{ route('products.index') }}" class="btn btn-dark">Start Shopping</a>
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
