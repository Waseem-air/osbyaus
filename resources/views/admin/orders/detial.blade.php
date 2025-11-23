@extends("admin.layout.main")
@section('content')

<style>
.order-badge {
    font-weight: 600;
    border-radius: 6px;
    height: 32px;
    width: 90px;
    font-size: 14px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
}

/* Status Badges */
.order-badge.pending {
    background-color: #FFA52F !important;
    color: white !important;
}

.order-badge.confirmed {
    background-color: #17a2b8 !important;
    color: white !important;
}

.order-badge.shipped {
    background-color: #007bff !important;
    color: white !important;
}

.order-badge.delivered {
    background-color: #28a745 !important;
    color: white !important;
}

.order-badge.cancelled {
    background-color: #dc3545 !important;
    color: white !important;
}

.icon-calendar-order {
    font-size: 20px;
    color: #FFA52F;
}

/* Button Styling */
.btn-action {
    height: 40px;
    min-width: 140px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 500;
}

.btn-print {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    color: #495057;
}

.btn-print:hover {
    background-color: #e9ecef;
    border-color: #adb5bd;
}

.btn-save {
    background-color: #343a40;
    border-color: #343a40;
    color: white;
}

.btn-save:hover {
    background-color: #23272b;
    border-color: #1d2124;
}

/* Card Styling */
.order-card {
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    border: 1px solid #eaeaea;
    margin-bottom: 20px;
}

.order-card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #eaeaea;
    padding: 15px 20px;
    font-weight: 600;
    font-size: 18px;
}

.order-card-body {
    padding: 20px;
}

/* Table Styling */
.order-items-table {
    width: 100%;
    border-collapse: collapse;
}

.order-items-table th {
    background-color: #f8f9fa;
    padding: 12px 15px;
    text-align: left;
    font-weight: 600;
    border-bottom: 1px solid #dee2e6;
}

.order-items-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #eaeaea;
}

.order-items-table tr:last-child td {
    border-bottom: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .btn-action {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .order-items-table {
        display: block;
        overflow-x: auto;
    }
    
    .order-card-header {
        padding: 12px 15px;
        font-size: 16px;
    }
    
    .order-card-body {
        padding: 15px;
    }
}
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <h1 class="mb-4">Order Details</h1>

            <!-- ================= ORDER HEADER SECTION ================= -->
            <div class="row">
                <div class="col-12">
                    <div class="order-card">
                        <div class="order-card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div class="d-flex align-items-center flex-wrap mb-2 mb-md-0">
                                <h4 class="m-0 me-3">Order ID: #6743</h4>
                                <span class="order-badge pending">
                                    Pending
                                </span>
                            </div>
                            <div class="d-flex align-items-center">
                                
                            </div>
                        </div>
                        
                        <div class="order-card-body">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6 mb-3 mb-md-0">
                                    <i class="fi fi-rr-calendar icon-calendar-order me-2"></i>
                                <span class="fw-bold">Order Date: 22 Jan 2025</span>
                                </div>
                                
                                <div class="col-12 col-md-6 d-flex justify-content-md-end flex-wrap gap-2">
                                    <!-- Status Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle btn-action" type="button" data-bs-toggle="dropdown">
                                            Change Status
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Pending</a></li>
                                            <li><a class="dropdown-item" href="#">Confirmed</a></li>
                                            <li><a class="dropdown-item" href="#">Shipped</a></li>
                                            <li><a class="dropdown-item" href="#">Delivered</a></li>
                                            <li><a class="dropdown-item" href="#">Cancelled</a></li>
                                        </ul>
                                    </div>

                                    <!-- Print Button -->
                                    <button class="btn btn-print btn-action">
                                        <i class="fi fi-rr-print me-2"></i> Print
                                    </button>

                                    <!-- Save Button -->
                                    <button class="btn btn-save btn-action">
                                        <i class="fi fi-rr-disk me-2"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= ORDER ITEMS SECTION ================= -->
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="order-card">
                        <div class="order-card-header">
                            Order Items
                        </div>
                        <div class="order-card-body p-0">
                            <div class="table-responsive">
                                <table class="order-items-table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded me-3" style="width: 50px; height: 50px;"></div>
                                                    <div>
                                                        <p class="mb-0 fw-bold">Wireless Bluetooth Headphones</p>
                                                        <small class="text-muted">Color: Black</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$99.99</td>
                                            <td>1</td>
                                            <td>$99.99</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded me-3" style="width: 50px; height: 50px;"></div>
                                                    <div>
                                                        <p class="mb-0 fw-bold">Smartphone Case</p>
                                                        <small class="text-muted">Color: Blue</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$19.99</td>
                                            <td>2</td>
                                            <td>$39.98</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-light rounded me-3" style="width: 50px; height: 50px;"></div>
                                                    <div>
                                                        <p class="mb-0 fw-bold">USB-C Charging Cable</p>
                                                        <small class="text-muted">Length: 6ft</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$12.99</td>
                                            <td>1</td>
                                            <td>$12.99</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ================= ORDER SUMMARY SECTION ================= -->
                <div class="col-12 col-lg-4">
                    <div class="order-card">
                        <div class="order-card-header">
                            Order Summary
                        </div>
                        <div class="order-card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>$152.96</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping:</span>
                                <span>$9.99</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax:</span>
                                <span>$12.35</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3 fw-bold">
                                <span>Total:</span>
                                <span>$175.30</span>
                            </div>
                            
                            <div class="mt-4">
                                <h6 class="text-muted mb-2">Shipping Address</h6>
                                <p class="mb-1">John Doe</p>
                                <p class="mb-1">123 Main Street</p>
                                <p class="mb-1">Apt 4B</p>
                                <p class="mb-1">New York, NY 10001</p>
                                <p class="mb-0">United States</p>
                            </div>
                            
                            <div class="mt-4">
                                <h6 class="text-muted mb-2">Billing Address</h6>
                                <p class="mb-1">Same as shipping address</p>
                            </div>
                            
                            <div class="mt-4">
                                <h6 class="text-muted mb-2">Payment Method</h6>
                                <p class="mb-0">Credit Card (**** **** **** 1234)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= ORDER NOTES SECTION ================= -->
            <div class="row">
                <div class="col-12">
                    <div class="order-card">
                        <div class="order-card-header">
                            Order Notes
                        </div>
                        <div class="order-card-body">
                            <div class="mb-3">
                                <label for="orderNotes" class="form-label">Add Note</label>
                                <textarea class="form-control" id="orderNotes" rows="3" placeholder="Add internal notes about this order..."></textarea>
                            </div>
                            <button class="btn btn-dark btn-action">
                                <i class="fi fi-rr-plus me-2"></i> Add Note
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection