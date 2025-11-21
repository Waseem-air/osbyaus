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

/* Pending Status */
.order-badge.pending {
    background-color: #FFA52F !important;
    color: white !important;
}

.icon-calendar-order {
    font-size: 20px;
    color: #FFA52F;
}
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <h1>Orders Details</h1>

            <!-- ================= ORDER HEADER SECTION ================= -->
            <div class="row mt-5">
                <div class="col-12 wg-box-1 p-3">

                    <!-- Order ID Row -->
                    <div class="d-flex align-items-center mb-4 flex-wrap">
                        <h4 class="m-0">Order ID: #6743</h4>

                        <span class="order-badge pending ms-3">
                            Pending
                        </span>
                    </div>

                    <!-- Calendar + Buttons Row -->
                    <div class="row align-items-center">

                        <!-- LEFT: Calendar Icon + Date -->
                        <div class="col-12 col-md-6 d-flex align-items-center mb-3 mb-md-0">
                            <i class="fi fi-rr-calendar icon-calendar-order me-2"></i>
                            <span class="fw-bold">Order Date: 22 Jan 2025</span>
                        </div>

                        <!-- RIGHT: Buttons -->
                        <div class="col-12 col-md-6 d-flex justify-content-md-end gap-2 flex-wrap">

                            <!-- Status Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Change Status
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                    <li><a class="dropdown-item" href="#">Confirmed</a></li>
                                    <li><a class="dropdown-item" href="#">Shipped</a></li>
                                    <li><a class="dropdown-item" href="#">Delivered</a></li>
                                </ul>
                            </div>

                            <!-- Print Button -->
                            <button class="btn btn-outline-dark">
                                <i class="fi fi-rr-print me-1"></i> Print
                            </button>

                            <!-- Save Button -->
                            <button class="btn btn-dark">
                                <i class="fi fi-rr-disk me-1"></i> Save
                            </button>

                        </div>

                    </div> <!-- row end -->

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
