@extends("admin.layout.main")
@section('content')

<style>
/* ================= BADGES ================= */
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

.order-badge.pending { background-color: #FFA52F !important; color: white !important; }
.order-badge.confirmed { background-color: #17a2b8 !important; color: white !important; }
.order-badge.shipped { background-color: #007bff !important; color: white !important; }
.order-badge.delivered { background-color: #28a745 !important; color: white !important; }
.order-badge.cancelled { background-color: #dc3545 !important; color: white !important; }

/* ================= ICON ================= */
.icon-calendar-order {
    font-size: 20px;
    color: #FFA52F;
}

/* ================= BUTTONS ================= */
.btn-action {
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.btn-print,
.btn-save {
    background-color: #EEEEEE;
    color: black;
}

/* ================= CARDS ================= */
.order-card {
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border: 1px solid #eaeaea;
    margin-bottom: 20px;
}

.order-card-header {
    padding: 15px 20px;
    font-weight: 600;
    font-size: 18px;
}

.order-card-date {
    font-weight: 600;
    font-size: 18px;
}

.order-card-body {
    padding: 20px;
}

/* ================= PRODUCTS TABLE ================= */
.order-items-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
}

.order-items-table th,
.order-items-table td {
    padding: 12px 15px;
    border: none !important;
}

.order-items-table thead tr,
.order-items-table tbody tr,
.order-items-table tfoot tr {
    border-bottom: 1px solid #DBDADE;
}

.order-items-table thead th,
.order-items-table tbody td,
.order-items-table tfoot td {
    border: none !important;
}

/* Align Total column to the end */
.order-items-table th:nth-child(4),
.order-items-table td:nth-child(4) {
    text-align: right;
}

/* ================= RESPONSIVE ================= */
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

/* ================= CUSTOMER CARD ================= */
.customer-card {
    background: transparent !important;
    border: 1px solid #E7E7E3 !important;
    border-radius: 12px;
}

.customer-img {
    width: 56px;
    height: 56px;
    object-fit: cover;
}

.view-profile-btn {
    height: 32px;
    background-color: #94010E !important;
    color: white !important;
    font-weight: 500;
    font-size: 14px;
    border-radius: 8px;
}



/* ================= CHECKBOX ================= */
.custom-check {
    width: 20px !important;
    height: 20px !important;
    cursor: pointer;
}

.custom-check:checked {
    background-color: #94010E !important;
    border-color: #94010E !important;
}

/* ================= ORDER SUMMARY TABLE ================= */
.order-table-1 {
    width: 100%;
    border-collapse: collapse;
    font-size: 16px;
    margin-top: 20px;
}

.order-table-1 td {
    padding: 12px 15px;
    /* Remove all borders */
    border: none !important;
}

.order-table-1 tr:last-child td {
    font-weight: bold;
    font-size: 18px;
    color: #94010E;
}

.order-table-1 tr:last-child {
    /* Remove border top */
    border-top: none !important;
}

.order-table-1 .label {
    text-align: left;
    color: #666;
}

.order-table-1 .value {
    text-align: right;
    font-weight: 500;
}

/* ================= PRODUCTS CARD LAYOUT ================= */
.products-card-container {
    display: flex;
    flex-direction: column;
}

.products-table-container {
    width: 100%;
}

.order-summary-container {
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
}

.order-summary-wrapper {
    width: 100%;
    max-width: 400px;
}

@media (max-width: 576px) {
    .order-table-1 {
        font-size: 16px;
    }
    
    .order-table-1 td {
        padding: 10px 12px;
    }
    
    .order-table-1 tr:last-child td {
        font-size: 17px;
    }
    
    .order-summary-container {
        justify-content: center;
    }
    
    .order-summary-wrapper {
        max-width: 100%;
    }
    
    /* Ensure products table maintains 100% width on mobile */
    .order-items-table {
        width: 100%;
        min-width: 100%;
    }
}
.p-img{
    width:60px;
    height:60px;
}
.notes-textarea {
    resize: none;  /* user cannot resize */
    cursor: not-allowed; /* optional, shows readonly cursor */
}

</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <h1 class="mb-4">Order Details</h1>

            <!-- ================= ORDER HEADER ================= -->
            <div class="row">
                <div class="col-12">
                    <div class="order-card">

                        <div class="order-card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div class="d-flex align-items-center flex-wrap mb-2 mb-md-0">
                                <h4 class="m-0 me-3">Order ID: #6743</h4>
                                <span class="order-badge pending">Pending</span>
                            </div>
                        </div>

                        <div class="order-card-body">

                            <div class="row align-items-center">
                                <div class="col-12 col-md-6 mb-3 mb-md-0 order-card-date">
                                    <i class="fi fi-rr-calendar icon-calendar-order me-2"></i>
                                    <span class="fw-bold">Order Date: 22 Jan 2025</span>
                                </div>

                                <div class="col-12 col-md-6 d-flex justify-content-md-end flex-wrap gap-2">
                                   <button class="btn btn-print btn-action">
                                        <i class="icon-printer icon-btn me-2"></i>
                                    </button>



                                    <button class="btn btn-save btn-action">
                                        <i class="fi fi-rr-disk me-2"></i> Save
                                    </button>
                                </div>
                            </div>

                            <!-- ========= CUSTOMER & INFO CARDS ========= -->
                            <div class="row mt-5">
                                <!-- CUSTOMER CARD -->
                                <div class="col-sm-4 ">
                                    <div class="customer-card card shadow-none">
                                        <div class="card-body">
                                            <div class="d-flex mb-3">
                                                <img src="{{ asset('admin/images/p-1.svg') }}" class="customer-img  me-3" alt="Customer">
                                                <div>
                                                    <h5 class="m-0 fw-bold mb-3">Customer</h5>
                                                    <p class="mb-3">Full Name: Shristi Singh</p>
                                                    <p class="mb-3">Email: shristi@gmail.com</p>
                                                    <p class="mb-3">Phone: +91 904 231 1212</p>
                                                </div>
                                            </div>
                                            <button class="btn view-profile-btn w-100">View Profile</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- ORDER INFO CARD -->
                                <div class="col-sm-4 mt-3 mt-sm-0">
                                    <div class="customer-card card shadow-none">
                                        <div class="card-body">
                                            <div class="d-flex  mb-3">
                                                <img src="{{ asset('admin/images/p-2.svg') }}" class="customer-img me-3" alt="Customer">
                                                <div>
                                                    <h5 class="m-0 fw-bold mb-3">Order Info</h5>
                                                    <p class="mb-3">Shipping: Next express</p>
                                                    <p class="mb-3">Payment Method: Paypal</p>
                                                    <p class="mb-3">Status: Pending</p>
                                                </div>
                                            </div>
                                            <button class="btn view-profile-btn w-100">Download Info</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- DELIVER TO CARD -->
                                <div class="col-sm-4 mt-3 mt-sm-0">
                                    <div class="customer-card card shadow-none">
                                        <div class="card-body">
                                            <div class="d-flex  mb-3">
                                                <img src="{{ asset('admin/images/p-2.svg') }}" class="customer-img  me-3" alt="Customer">
                                                <div>
                                                    <h5 class="m-0 fw-bold mb-3">Deliver to</h5>
                                                    <p class="mb-3">Full Name: Shristi Singh</p>
                                                    <p class="mb-2">Address: Dharam Colony, Palam Vihar, Gurgaon, Haryana</p>
                                                </div>
                                            </div>
                                            <button class="btn view-profile-btn w-100">View Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ========= PAYMENT + NOTE SECTION ========= -->
                            <div class="row mt-5">
                                <!-- PAYMENT CARD -->
                                <div class="col-sm-4">
                                    <div class="customer-card card shadow-none h-100">
                                        <div class="card-body">
                                            <h5 class="m-0 fw-bold mb-3">Payment Details</h5>
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" style="width:55px;" class="me-3" alt="MasterCard">
                                                <div>
                                                    <p class="mb-2">Master Card **** **** 6557</p>
                                                </div>
                                            </div>
                                            <p class="mb-2">Business Name: Shristi Sin</p>
                                            <p class="mb-2">Phone: +91 904 231 1212</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- NOTE AREA -->
                                <div class="col-sm-8">
                                    <div class="shadow-none h-100">
                                        <div class="card-body">
                                            <h5 class="fw-bold mb-3">Notes</h5>
                                            <div class="form-control notes-textarea" style="height: 100px; overflow-y: auto;">
                                                Add notes here...
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

            <!-- ================= PRODUCTS TABLE & ORDER SUMMARY ================= -->
            <div class="row">
                <div class="col-12">
                    <div class="order-card">
                        <div class="order-card-header">Products</div>
                        <div class="order-card-body products-card-container">
                            
                            <!-- Products Table -->
                            <div class="products-table-container">
                                <div class="table-responsive">
                                    <table class="order-items-table">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Item Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- PRODUCT ROW 1 -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" class="custom-check me-3">
                                                        <div class="rounded me-3 ">
                                                            <img src="{{ asset('admin/images/p-image.svg') }}" alt="" class="p-img">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0">Wireless Bluetooth Headphones</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>$99.99</td>
                                                <td>1</td>
                                                <td>$99.99</td>
                                            </tr>

                                            <!-- PRODUCT ROW 2 -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" class="custom-check me-3">
                                                        <div class="rounded me-3 p-img">
                                                            <img src="{{ asset('admin/images/p-image.svg') }}" alt="" class="p-img">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0">Wireless Bluetooth Headphones</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>$99.99</td>
                                                <td>1</td>
                                                <td>$99.99</td>
                                            </tr>

                                            <!-- PRODUCT ROW 3 -->
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <input type="checkbox" class="custom-check me-3">
                                                        <div class="rounded me-3 p-img">
                                                            <img src="{{ asset('admin/images/p-image.svg') }}" alt="" class="p-img">
                                                        </div>
                                                        <div>
                                                            <p class="mb-0">Wireless Bluetooth Headphones</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>$99.99</td>
                                                <td>1</td>
                                                <td>$99.99</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Order Summary Table -->
                            <div class="order-summary-container">
                                <div class="order-summary-wrapper">
                                    <table class="order-table-1">
                                        <tr>
                                            <td class="label">Subtotal</td>
                                            <td class="value">Rs. 3,201</td>
                                        </tr>
                                        <tr>
                                            <td class="label">Tax (20%)</td>
                                            <td class="value">Rs. 640</td>
                                        </tr>
                                        <tr>
                                            <td class="label">Discount</td>
                                            <td class="value">0</td>
                                        </tr>
                                        <tr>
                                            <td class="label">Shipping Rate</td>
                                            <td class="value">0</td>
                                        </tr>
                                        <tr>
                                            <td class="label">Total</td>
                                            <td class="value">Rs. 16,884</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection