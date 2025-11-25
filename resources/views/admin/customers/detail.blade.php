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
    .tab-buttons .tab-btn {
        background: transparent;
        border: none;
        padding: 10px 15px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        border-bottom: 3px solid transparent;
    }

    .tab-buttons .tab-btn.active {
        color: #94010E;
        border-bottom: 3px solid #94010E;
    }

    .tab-content {
        padding: 10px 0;
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
                            <div class="col-md-4 d-flex align-items-center gap-3 border-end py-3 px-3">
                                <img src="{{ asset('admin/images/customer-img.png') }}"
                                     alt="Customer"
                                     width="60" height="60">

                                <div class="d-flex flex-column">
                                    <h6 class="fw-bold mb-1">Robert Fox</h6>
                                    <p class="mb-0 text-muted">robert@gmail.com</p>
                                </div>
                            </div>

                            <!-- Personal Info -->
                            <div class="col-md-4 border-end py-3 px-3">
                                <p class="mb-2 fw-bold">PERSONAL INFORMATION</p>
                                <div class="d-flex mt-3">
                                    <!-- Labels -->
                                    <div class="me-3 profile-info-left">
                                        <p class="mb-2">Contact Number</p>
                                        <p class="mb-2">Gender</p>
                                        <p class="mb-2">Date of Birth</p>
                                        <p class="mb-0">Member Since</p>
                                    </div>

                                    <!-- Values -->
                                    <div class="profile-info-right">
                                        <p class="mb-2">(201) 555-0124</p>
                                        <p class="mb-2">Male</p>
                                        <p class="mb-2">1 Jan, 1985</p>
                                        <p class="mb-0">3 March, 2023</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping + Stats -->
                            <div class="col-md-4 py-3 px-3">
                                <!-- Shipping Address -->
                                <p class="mb-2">Shipping Address</p>
                                <div class="profile-info-left mb-4">
                                    <p class="mb-0">3517 W. Gray St. Utica, Pennsylvania 57867</p>
                                </div>

                                <!-- Stats -->
                                <div class="d-flex justify-content-between">
                                    <div class="text-center">
                                        <h6 class="mb-0">150</h6>
                                        <p class="mb-0">Total Order</p>
                                    </div>
                                    <div class="text-center">
                                        <h6 class="mb-0">140</h6>
                                        <p class="mb-0">Completed</p>
                                    </div>
                                    <div class="text-center">
                                        <h6 class="mb-0">10</h6>
                                        <p class="mb-0">Canceled</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Full width line -->
                        <hr class="m-0">

                        <!-- ================= TABS ================= -->
                        <div class="d-flex justify-content-around mt-3 tab-buttons flex-wrap">
                            <button class="tab-btn active" data-tab="all">All Orders</button>
                            <button class="tab-btn" data-tab="completed">Completed</button>
                            <button class="tab-btn" data-tab="canceled">Canceled</button>
                        </div>

                        <hr class="mt-2 mb-3">

                        <!-- ================= TAB CONTENT ================= -->
                        <div id="tab-all" class="tab-content">
                            <p>Showing all orders here...</p>
                        </div>

                        <div id="tab-completed" class="tab-content d-none">
                            <p>Showing completed orders...</p>
                        </div>

                        <div id="tab-canceled" class="tab-content d-none">
                            <p>Showing canceled orders...</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Toast container -->
<div class="toast-container"></div>

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
</script>

@endsection
