@extends("admin.layout.main")
@section('content')

<style>
    .order-card {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border: 1px solid #eaeaea;
        margin-bottom: 25px;
        overflow: hidden;
    }

    /* Tabs Styling */
    .tab-buttons {
        display: flex;
        width: 100%;
    }
    
    .tab-buttons .tab-btn {
        background: transparent;
        border: none;
        padding: 12px 20px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        width: 140px;
        flex: none;
        transition: all 0.3s ease;
    }

    .tab-buttons .tab-btn:hover {
        background-color: #f8f9fa;
    }

    .tab-buttons .tab-btn.active {
        color: #94010E;
        border-bottom: 3px solid #94010E;
        background-color: #fff;
    }

    .tab-content {
        padding: 20px 0;
    }

    .profile-info-left p {
        font-weight: 400;
        font-style: normal;
        font-size: 13px;
        line-height: 100%;
        letter-spacing: 0px;
        color: black;
    }

    .profile-info-right p {
        font-weight: 600;
        font-style: normal;
        font-size: 13px;
        line-height: 100%;
        letter-spacing: 0px;
        color: black;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .tab-buttons {
            flex-direction: column;
        }
        
        .tab-buttons .tab-btn {
            flex: none;
            width: 100%;
            border-bottom: 1px solid #eaeaea;
            border-radius: 0;
        }
        
        .tab-buttons .tab-btn.active {
            border-bottom: 3px solid #94010E;
        }
    }

    @media (max-width: 767px) {
        .order-card .row > [class*='col-'] {
            border-right: none !important;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 15px !important;
            margin-bottom: 15px;
        }
        .order-card .d-flex.justify-content-between {
            flex-wrap: wrap;
        }
    }
    
    .order-table {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .table-responsive {
        border-radius: 8px;
    }
    
    /* Table font size 16px and border bottom styling */
    .order-table table {
        font-size: 16px;
    }
    
    .order-table table th,
    .order-table table td {
        border-bottom: 1px solid #E9E7FD;
        vertical-align: middle;
    }
    
    .order-table table thead th {
        font-weight: 600;
        border-bottom: 2px solid #E9E7FD;
        padding: 12px 15px;
    }
    
    .order-table table tbody td {
        padding: 12px 15px;
    }
    
    .status-completed {
        color: #198754;
        font-weight: 500;
    }
    
    .status-pending {
        color: #ffc107;
        font-weight: 500;
    }
    
    .status-processing {
        color: #0d6efd;
        font-weight: 500;
    }
    
    .status-canceled {
        color: #dc3545;
        font-weight: 500;
    }
    
    .status-refunded {
        color: #6c757d;
        font-weight: 500;
    }
    
    .detail-table {
        border-radius: 6px;
        margin-top: 10px;
        background-color: #f8f9fa;
    }
    
    .detail-table table {
        font-size: 14px;
    }
    
    .detail-table table th {
        border-bottom: 1px solid #E9E7FD;
        padding: 8px 12px;
        background-color: #e9ecef;
    }
    
    .detail-table table td {
        border-bottom: 1px solid #E9E7FD;
        padding: 8px 12px;
        background-color: white;
    }
    
    .dropdown-toggle::after {
        display: none;
    }
    
    .action-btn {
        padding: 5px 10px;
        border-radius: 4px;
        background-color: #6c757d;
        color: white;
        border: none;
        cursor: pointer;
    }
    
    .action-btn:hover {
        background-color: #5a6268;
    }
    
    .print-icon {
        color: #6c757d;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.2s ease;
    }
    
    .print-icon:hover {
        color: #94010E;
        transform: scale(1.1);
    }
    
    /* Fix for dropdown menu positioning */
    .dropdown-menu {
        z-index: 1000;
    }
    
    /* Fix for collapse animation */
    .collapse:not(.show) {
        display: none;
    }
    
    .collapsing {
        height: 0;
        overflow: hidden;
        transition: height 0.35s ease;
    }
    
    /* Order Summary Styles - DIV VERSION */
    .order-summary-wrapper {
        width: 100%;
        max-width: 300px;
        margin-left: auto;
        margin-top: 10px;
        margin-right: 190px;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }
    
    .summary-item:last-child {
        border-bottom: none;
    }
    
    .summary-label {
        text-align: left;
        font-weight: 400;
        font-size: 14px;
        color: #6c757d;
    }
    
    .summary-value {
        text-align: right;
        font-weight: 600;
        font-size: 14px;
        color: #2c3e50;
    }
    
    .summary-total .summary-value {
        font-size: 18px;
        color: #94010E;
        font-weight: 700;
    }
    
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .order-summary-wrapper {
            max-width: 100%;
            margin-right: 0;
        }
        
        .order-table table {
            font-size: 14px;
        }
        
        /* FIXED: Set 144px width for each column on mobile */
        .order-table table th,
        .order-table table td {
            min-width: 144px;
            max-width: 144px;
            width: 144px;
            padding: 8px 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        /* Make table horizontally scrollable on mobile */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .action-btn {
            padding: 3px 6px;
            font-size: 0.8rem;
        }
        
        .summary-label,
        .summary-value {
            font-size: 13px;
        }
        
        .summary-total .summary-value {
            font-size: 16px;
        }
        
        /* Ensure dropdowns work on mobile */
        .dropdown-menu {
            position: absolute !important;
        }
        
        /* Adjust for collapsed rows */
        .collapse td {
            min-width: 100% !important;
            max-width: 100% !important;
            width: 100% !important;
        }
        
        /* Adjust detail table for mobile */
        .detail-table table th,
        .detail-table table td {
            min-width: auto !important;
            max-width: none !important;
            width: auto !important;
            white-space: normal;
        }
    }
    
    /* Desktop styles - no fixed width */
    @media (min-width: 769px) {
        .order-table table th,
        .order-table table td {
            min-width: auto;
            max-width: none;
            width: auto;
            white-space: normal;
        }
    }
    
    /* Search bar styling */
    .search-bar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
    }
    
    .tf-button.style-1 {
        background-color: #94010E;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }
    
    .tf-button.style-1:hover {
        background-color: #7a000b;
    }
    
    .order-table table {
        font-size: 16px;
    }
    
    .order-table table th,
    .order-table table td {
        border-bottom: 1px solid #E9E7FD;
    }
    
    .order-table table thead th {
        border-bottom: 1px solid #E9E7FD;
    }
    
    .detail-table table th,
    .detail-table table td {
        border-bottom: 1px solid #E9E7FD;
    }
    
    .customer-profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #f0f0f0;
    }
    
    .no-orders {
        text-align: center;
        padding: 40px;
        color: #6c757d;
    }
    
    .no-orders i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #dee2e6;
    }
    
    /* Dropdown arrow icon styling */
    .dropdown-arrow-icon {
        font-size: 12px;
        transition: transform 0.2s;
    }
    
    .action-btn.active .dropdown-arrow-icon {
        transform: rotate(180deg);
    }
    
    /* Remove dropdown menu styling since we're not using it */
    .dropdown-menu {
        display: none !important;
    }
    
    /* Print button styling */
    .print-btn {
        background: none;
        border: none;
        padding: 5px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .print-btn:hover {
        transform: scale(1.1);
    }
    
    .print-btn i {
        color: #6c757d;
        font-size: 16px;
    }
    
    .print-btn:hover i {
        color: #94010E;
    }
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <h1 class="mb-4">Customer Detail</h1>

            <div class="row">
                <div class="col-12">
                    <div class="order-card">

                        <!-- ================= HEADER 3 COLUMNS ================= -->
                        <div class="row py-3 gx-3">

                            <!-- Customer Info -->
                            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center text-center border-end py-3 px-3">
                                @if($customer->profile_photo)
                                    <img src="{{ asset($customer->profile_photo) }}" 
                                         alt="{{ $customer->full_name }}" 
                                         class="customer-profile-img">
                                @else
                                    <img src="{{ asset('admin/images/customer-img.png') }}" 
                                         alt="{{ $customer->full_name }}" 
                                         class="customer-profile-img">
                                @endif
                                <div class="d-flex flex-column mt-2">
                                    <h6 class="fw-bold mb-1">{{ $customer->full_name }}</h6>
                                    <p class="mb-0 text-muted">{{ $customer->email }}</p>
                                </div>
                            </div>

                            <!-- Personal Info -->
                            <div class="col-md-4 border-end py-3 px-3">
                                <p class="mb-2 fw-bold">PERSONAL INFORMATION</p>
                                <div class="d-flex mt-3">
                                    <!-- Labels -->
                                    <div class="me-3 profile-info-left">
                                        <p class="mb-2 mt-3">Contact Number</p>
                                        <p class="mb-2 mt-3">Gender</p>
                                        <p class="mb-2 mt-3">Date of Birth</p>
                                        <p class="mb-0 mt-3">Member Since</p>
                                    </div>

                                    <!-- Values -->
                                    <div class="profile-info-right">
                                        <p class="mb-2 mt-3">{{ $customer->phone ?? 'N/A' }}</p>
                                        <p class="mb-2 mt-3">
                                            @if($customer->gender)
                                                {{ ucfirst($customer->gender) }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                        <p class="mb-2 mt-3">
                                            @if($customer->dob)
                                                {{ \Carbon\Carbon::parse($customer->dob)->format('d M, Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                        <p class="mb-0 mt-3">
                                            {{ $customer->created_at->format('d M, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping + Stats -->
                            <div class="col-md-4 py-3 px-3">
                                <!-- Shipping Address -->
                                <p class="mb-2">Shipping Address</p>
                                <div class="profile-info-left mb-4 mt-4">
                                    <p class="mb-0">
                                        @if($customer->address)
                                            {{ $customer->address }}, 
                                            @if($customer->city) {{ $customer->city }}, @endif
                                            @if($customer->state) {{ $customer->state }}, @endif
                                            @if($customer->country) {{ $customer->country }} @endif
                                            @if($customer->postal_code) {{ $customer->postal_code }} @endif
                                        @else
                                            No address provided
                                        @endif
                                    </p>
                                </div>

                                <!-- Stats -->
                                <div class="d-flex justify-content-between">
                                    <div class="text-center">
                                        <h6 class="mb-0">{{ $customer->orders->count() }}</h6>
                                        <p class="mb-0">Total Order</p>
                                    </div>
                                    <div class="text-center">
                                        <h6 class="mb-0">{{ $customer->orders()->where('status', 'completed')->count() }}</h6>
                                        <p class="mb-0">Completed</p>
                                    </div>
                                    <div class="text-center">
                                        <h6 class="mb-0">{{ $customer->orders()->where('status', 'canceled')->count() }}</h6>
                                        <p class="mb-0">Canceled</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Full width line -->
                        <hr class="m-0">

                        <!-- ================= TABS ================= -->
                        <div class="tab-buttons mt-3">
                            <button class="tab-btn active" data-tab="all">All Orders</button>
                            <button class="tab-btn" data-tab="completed">Completed</button>
                            <button class="tab-btn" data-tab="canceled">Canceled</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- ================= TAB CONTENT ================= -->
                    <div id="tab-all" class="tab-content">
                        @if($customer->orders->count() > 0)
                            <div class="table-responsive order-table">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Created</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customer->orders as $order)
                                        <tr>
                                            <td>#{{ $order->order_number }}</td>
                                            <td>
                                                {{ $order->created_at->diffForHumans() }}
                                                <br>
                                                <small class="text-muted">
                                                    {{ $order->created_at->format('d M, Y h:i A') }}
                                                </small>
                                            </td>
                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                @if($order->payment_method == 'stripe')
                                                    <span class="badge bg-primary">Stripe</span>
                                                @elseif($order->payment_method == 'paypal')
                                                    <span class="badge bg-info">PayPal</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($order->payment_method) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @switch($order->status)
                                                    @case('completed')
                                                        <span class="status-completed">Completed</span>
                                                        @break
                                                    @case('pending')
                                                        <span class="status-pending">Pending</span>
                                                        @break
                                                    @case('processing')
                                                        <span class="status-processing">Processing</span>
                                                        @break
                                                    @case('canceled')
                                                        <span class="status-canceled">Canceled</span>
                                                        @break
                                                    @case('refunded')
                                                        <span class="status-refunded">Refunded</span>
                                                        @break
                                                    @default
                                                        <span class="text-capitalize">{{ $order->status }}</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <!-- Removed dropdown - Now just a toggle button -->
                                                <button class="btn btn-sm action-btn toggle-details-btn d-flex align-items-center gap-1" 
                                                        type="button" 
                                                        data-order-id="{{ $order->id }}">
                                                     <i class="fas fa-chevron-down dropdown-arrow-icon ms-1"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Order Details Table (Collapsed by default) -->
                                        <tr class="collapse" id="orderDetails{{ $order->id }}">
                                            <td colspan="6" class="p-0">
                                                <div class="detail-table m-2 p-3">
                                                    @if($order->items->count() > 0)
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Product</th>
                                                                        <th>Price</th>
                                                                        <th>Qty</th>
                                                                        <th>Total</th>
                                                                        <th>Print</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($order->items as $index => $item)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>
                                                                            {{ $item->product_name }}
                                                             
                                                                           
                                                                        </td>
                                                                        <td>${{ number_format($item->price, 2) }}</td>
                                                                        <td>x{{ $item->quantity }}</td>
                                                                        <td>${{ number_format($item->total, 2) }}</td>
                                                                        <td>
                                                                            <button class="print-btn" onclick="printItem({{ $item->id }})" title="Print Item">
                                                                                <i class="fas fa-print print-icon"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        
                                                        <!-- Order Summary -->
                                                        <div class="order-summary-wrapper">
                                                            <div class="summary-item">
                                                                <div class="summary-label">Subtotal</div>
                                                                <div class="summary-value">${{ number_format($order->subtotal, 2) }}</div>
                                                            </div>
                                                            @if($order->tax_amount > 0)
                                                            <div class="summary-item">
                                                                <div class="summary-label">Tax</div>
                                                                <div class="summary-value">${{ number_format($order->tax_amount, 2) }}</div>
                                                            </div>
                                                            @endif
                                                            @if($order->shipping_amount > 0)
                                                            <div class="summary-item">
                                                                <div class="summary-label">Shipping</div>
                                                                <div class="summary-value">${{ number_format($order->shipping_amount, 2) }}</div>
                                                            </div>
                                                            @endif
                                                            <div class="summary-item summary-total">
                                                                <div class="summary-label">Total</div>
                                                                <div class="summary-value">${{ number_format($order->total_amount, 2) }}</div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Print Order Button -->
                                                        <!-- <div class="d-flex justify-content-end mt-3">
                                                            <button class="btn btn-outline-primary btn-sm" onclick="printOrder({{ $order->id }})">
                                                                <i class="fas fa-print me-2"></i> Print Order #{{ $order->order_number }}
                                                            </button>
                                                        </div> -->
                                                    @else
                                                        <p class="text-center text-muted">No items found in this order.</p>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="no-orders">
                                <i class="fas fa-shopping-cart"></i>
                                <h4>No Orders Yet</h4>
                                <p>This customer hasn't placed any orders yet.</p>
                            </div>
                        @endif
                    </div>

                    <div id="tab-completed" class="tab-content d-none">
                        @php
                            $completedOrders = $customer->orders()->where('status', 'completed')->get();
                        @endphp
                        
                        @if($completedOrders->count() > 0)
                            <div class="table-responsive order-table">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Completed Date</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($completedOrders as $order)
                                        <tr>
                                            <td>#{{ $order->order_number }}</td>
                                            <td>{{ $order->updated_at->format('d M, Y') }}</td>
                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                            <td>{{ ucfirst($order->payment_method) }}</td>
                                            <td><span class="status-completed">Completed</span></td>
                                            <td>
                                                <button class="btn btn-sm action-btn toggle-details-btn d-flex align-items-center gap-1" 
                                                        type="button" 
                                                        data-order-id="{{ $order->id }}">
                                                    Actions <i class="fas fa-chevron-down dropdown-arrow-icon ms-1"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Order Details Table for Completed Orders -->
                                        <tr class="collapse" id="orderDetails{{ $order->id }}">
                                            <td colspan="6" class="p-0">
                                                <div class="detail-table m-2 p-3">
                                                    @if($order->items->count() > 0)
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Product</th>
                                                                        <th>Price</th>
                                                                        <th>Qty</th>
                                                                        <th>Total</th>
                                                                        <th>Print</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($order->items as $index => $item)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>
                                                                            {{ $item->product_name }}
                                                                        </td>
                                                                        <td>${{ number_format($item->price, 2) }}</td>
                                                                        <td>x{{ $item->quantity }}</td>
                                                                        <td>${{ number_format($item->total, 2) }}</td>
                                                                        <td>
                                                                            <button class="print-btn" onclick="printItem({{ $item->id }})" title="Print Item">
                                                                                <i class="fas fa-print print-icon"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        
                                                        <!-- Order Summary -->
                                                        <div class="order-summary-wrapper">
                                                            <div class="summary-item">
                                                                <div class="summary-label">Subtotal</div>
                                                                <div class="summary-value">${{ number_format($order->subtotal, 2) }}</div>
                                                            </div>
                                                            @if($order->tax_amount > 0)
                                                            <div class="summary-item">
                                                                <div class="summary-label">Tax</div>
                                                                <div class="summary-value">${{ number_format($order->tax_amount, 2) }}</div>
                                                            </div>
                                                            @endif
                                                            @if($order->shipping_amount > 0)
                                                            <div class="summary-item">
                                                                <div class="summary-label">Shipping</div>
                                                                <div class="summary-value">${{ number_format($order->shipping_amount, 2) }}</div>
                                                            </div>
                                                            @endif
                                                            <div class="summary-item summary-total">
                                                                <div class="summary-label">Total</div>
                                                                <div class="summary-value">${{ number_format($order->total_amount, 2) }}</div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Print Order Button -->
                                                        <div class="d-flex justify-content-end mt-3">
                                                            <button class="btn btn-outline-primary btn-sm" onclick="printOrder({{ $order->id }})">
                                                                <i class="fas fa-print me-2"></i> Print Order #{{ $order->order_number }}
                                                            </button>
                                                        </div>
                                                    @else
                                                        <p class="text-center text-muted">No items found in this order.</p>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="no-orders">
                                <i class="fas fa-check-circle"></i>
                                <h4>No Completed Orders</h4>
                                <p>This customer has no completed orders yet.</p>
                            </div>
                        @endif
                    </div>

                    <div id="tab-canceled" class="tab-content d-none">
                        @php
                            $canceledOrders = $customer->orders()->where('status', 'canceled')->get();
                        @endphp
                        
                        @if($canceledOrders->count() > 0)
                            <div class="table-responsive order-table">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Canceled Date</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($canceledOrders as $order)
                                        <tr>
                                            <td>#{{ $order->order_number }}</td>
                                            <td>{{ $order->updated_at->format('d M, Y') }}</td>
                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                            <td>{{ ucfirst($order->payment_method) }}</td>
                                            <td><span class="status-canceled">Canceled</span></td>
                                            <td>
                                                <button class="btn btn-sm action-btn toggle-details-btn d-flex align-items-center gap-1" 
                                                        type="button" 
                                                        data-order-id="{{ $order->id }}">
                                                    Actions <i class="fas fa-chevron-down dropdown-arrow-icon ms-1"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Order Details Table for Canceled Orders -->
                                        <tr class="collapse" id="orderDetails{{ $order->id }}">
                                            <td colspan="6" class="p-0">
                                                <div class="detail-table m-2 p-3">
                                                    @if($order->items->count() > 0)
                                                        <div class="table-responsive">
                                                            <table class="table table-sm table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Product</th>
                                                                        <th>Price</th>
                                                                        <th>Qty</th>
                                                                        <th>Total</th>
                                                                        <th>Print</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($order->items as $index => $item)
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>
                                                                            {{ $item->product_name }}
                                                                        </td>
                                                                        <td>${{ number_format($item->price, 2) }}</td>
                                                                        <td>x{{ $item->quantity }}</td>
                                                                        <td>${{ number_format($item->total, 2) }}</td>
                                                                        <td>
                                                                            <button class="print-btn" onclick="printItem({{ $item->id }})" title="Print Item">
                                                                                <i class="fas fa-print print-icon"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        
                                                        <!-- Order Summary -->
                                                        <div class="order-summary-wrapper">
                                                            <div class="summary-item">
                                                                <div class="summary-label">Subtotal</div>
                                                                <div class="summary-value">${{ number_format($order->subtotal, 2) }}</div>
                                                            </div>
                                                            @if($order->tax_amount > 0)
                                                            <div class="summary-item">
                                                                <div class="summary-label">Tax</div>
                                                                <div class="summary-value">${{ number_format($order->tax_amount, 2) }}</div>
                                                            </div>
                                                            @endif
                                                            @if($order->shipping_amount > 0)
                                                            <div class="summary-item">
                                                                <div class="summary-label">Shipping</div>
                                                                <div class="summary-value">${{ number_format($order->shipping_amount, 2) }}</div>
                                                            </div>
                                                            @endif
                                                            <div class="summary-item summary-total">
                                                                <div class="summary-label">Total</div>
                                                                <div class="summary-value">${{ number_format($order->total_amount, 2) }}</div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Print Order Button -->
                                                        <div class="d-flex justify-content-end mt-3">
                                                            <button class="btn btn-outline-primary btn-sm" onclick="printOrder({{ $order->id }})">
                                                                <i class="fas fa-print me-2"></i> Print Order #{{ $order->order_number }}
                                                            </button>
                                                        </div>
                                                    @else
                                                        <p class="text-center text-muted">No items found in this order.</p>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="no-orders">
                                <i class="fas fa-times-circle"></i>
                                <h4>No Canceled Orders</h4>
                                <p>This customer has no canceled orders.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast container -->
<div class="toast-container"></div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

<script>
    // Tabs Functionality
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active from all buttons
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Hide all contents
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('d-none'));

            // Show selected tab
            document.getElementById('tab-' + this.dataset.tab).classList.remove('d-none');
        });
    });

    // Handle toggle details button click
    document.addEventListener('click', function(e) {
        if (e.target.closest('.toggle-details-btn')) {
            const button = e.target.closest('.toggle-details-btn');
            const orderId = button.getAttribute('data-order-id');
            const collapseElement = document.getElementById(`orderDetails${orderId}`);
            const collapseInstance = bootstrap.Collapse.getInstance(collapseElement) || 
                                    new bootstrap.Collapse(collapseElement, { toggle: true });
            
            // Close all other open collapses in the same tab
            const currentTab = button.closest('.tab-content');
            if (currentTab) {
                currentTab.querySelectorAll('.collapse.show').forEach(collapse => {
                    if (collapse.id !== `orderDetails${orderId}`) {
                        const otherInstance = bootstrap.Collapse.getInstance(collapse);
                        if (otherInstance) {
                            otherInstance.hide();
                        }
                    }
                });
            }
            
            // Toggle the current collapse
            collapseInstance.toggle();
            
            // Toggle active class on button
            button.classList.toggle('active');
        }
    });

    // Initialize all collapses
    var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
    var collapseList = collapseElementList.map(function (collapseEl) {
        return new bootstrap.Collapse(collapseEl, {
            toggle: false
        })
    });

    // Print Item Function
    function printItem(itemId) {
        showToast(`Printing item ${itemId}...`, 'info');
        // Add your print logic here
        // Example: window.open(`/admin/order-items/${itemId}/print`, '_blank');
    }

    // Print Order Function
    function printOrder(orderId) {
        showToast(`Printing order ${orderId}...`, 'info');
        // Add your print logic here
        // Example: window.open(`/admin/orders/${orderId}/print`, '_blank');
    }

    // Toast notification function
    function showToast(message, type = 'info') {
        const toastContainer = document.querySelector('.toast-container');
        const toastId = 'toast-' + Date.now();
        
        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-bg-${type} border-0`;
        toast.id = toastId;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
        
        toastContainer.appendChild(toast);
        
        const bsToast = new bootstrap.Toast(toast, {
            delay: 3000
        });
        bsToast.show();
        
        // Remove toast after it's hidden
        toast.addEventListener('hidden.bs.toast', function () {
            toast.remove();
        });
    }
</script>
@endsection