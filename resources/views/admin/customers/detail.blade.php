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
        background-color: #f8f9fa;
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
    
    .status-canceled {
        color: #dc3545;
        font-weight: 500;
    }
    
    .detail-table {
        background-color: #f8f9fa;
        border-radius: 6px;
        margin-top: 10px;
    }
    
    .detail-table table {
        font-size: 14px;
    }
    
    .detail-table table th {
        background-color: #e9ecef;
        border-bottom: 1px solid #E9E7FD;
        padding: 8px 12px;
    }
    
    .detail-table table td {
        border-bottom: 1px solid #E9E7FD;
        padding: 8px 12px;
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
    }
    
    .action-btn:hover {
        background-color: #5a6268;
    }
    
    .print-icon {
        color: #6c757d;
        cursor: pointer;
    }
    
    .print-icon:hover {
        color: #0d6efd;
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
    
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }
        
        .order-table table {
            font-size: 14px;
        }
        
        .order-table table th,
        .order-table table td {
            padding: 8px 10px;
        }
        
        .action-btn {
            padding: 3px 6px;
            font-size: 0.8rem;
        }
        
        /* Ensure dropdowns work on mobile */
        .dropdown-menu {
            position: absolute !important;
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
    
    .form-search {
        flex: 1;
        min-width: 300px;
    }
    
    .form-search fieldset {
        position: relative;
        margin: 0;
    }
    
    .form-search input {
        width: 100%;
        padding: 10px 40px 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
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
                                <img src="{{ asset('admin/images/customer-img.png') }}" 
                                     alt="Customer" 
                                     width="60" height="60">
                                <div class="d-flex flex-column mt-2">
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
                                        <p class="mb-2 mt-3">Contact Number</p>
                                        <p class="mb-2 mt-3">Gender</p>
                                        <p class="mb-2 mt-3">Date of Birth</p>
                                        <p class="mb-0 mt-3">Member Since</p>
                                    </div>

                                    <!-- Values -->
                                    <div class="profile-info-right">
                                        <p class="mb-2 mt-3">(201) 555-0124</p>
                                        <p class="mb-2 mt-3">Male</p>
                                        <p class="mb-2 mt-3">1 Jan, 1985</p>
                                        <p class="mb-0 mt-3">3 March, 2023</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping + Stats -->
                            <div class="col-md-4 py-3 px-3">
                                <!-- Shipping Address -->
                                <p class="mb-2">Shipping Address</p>
                                <div class="profile-info-left mb-4 mt-4">
                                    <p class="mb-0 ">3517 W. Gray St. Utica, Pennsylvania 57867</p>
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
                        <div class="tab-buttons mt-3">
                            <button class="tab-btn active" data-tab="all">All Orders</button>
                            <button class="tab-btn" data-tab="completed">Completed</button>
                            <button class="tab-btn" data-tab="canceled">Canceled</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="search-bar-container mb-2">
                <!-- Search Form -->
                <form class="form-search" id="searchForm">
                    <fieldset class="name">
                        <input type="text" 
                               placeholder="Search customers..." 
                               id="customerSearch"
                               name="search" 
                               value="{{ request('search') }}">
                        <button type="submit" class="search-icon">
                            <i class="icon-search"></i>
                        </button>
                    </fieldset>
                </form>

                <!-- Add New Button -->
                <button class="tf-button style-1 w208" 
                        data-bs-toggle="modal" 
                        data-bs-target="#addCategoryModal">
                    <i class="icon-plus"></i> Add New Category
                </button>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- ================= TAB CONTENT ================= -->
                    <div id="tab-all" class="tab-content">
                         <div class="table-responsive order-table">
                    <table class="table table-hover mb-0">
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
                            <tr>
                                <td>#6548</td>
                                <td>2 min ago</td>
                                <td>$654</td>
                                <td>CC</td>
                                <td><span class="status-completed">Completed</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm action-btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item view-details" href="#" 
                                                   data-bs-toggle="collapse" 
                                                   data-bs-target="#orderDetails6548"
                                                   aria-expanded="false" 
                                                   aria-controls="orderDetails6548">
                                                    View Details
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Cancel</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- Order Details Table (Collapsed by default) -->
                            <tr class="collapse" id="orderDetails6548" data-bs-parent=".table">
                                <td colspan="6" class="p-0">
                                    <div class="detail-table m-2 p-3">
                                        <h6 class="mb-3">Order Details for #6548</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>SKU</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Disc.</th>
                                                        <th>Total</th>
                                                        <th>Print</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>#6548</td>
                                                        <td>Main Paislay 3 Piece</td>
                                                        <td>$999.29</td>
                                                        <td>x1</td>
                                                        <td>5%</td>
                                                        <td>Rs. 9,978</td>
                                                        <td><i class="fas fa-print print-icon"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>#6549</td>
                                                        <td>Casual Shirt</td>
                                                        <td>$49.99</td>
                                                        <td>x2</td>
                                                        <td>10%</td>
                                                        <td>Rs. 89.98</td>
                                                        <td><i class="fas fa-print print-icon"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>#6550</td>
                                                        <td>Formal Trousers</td>
                                                        <td>$79.99</td>
                                                        <td>x1</td>
                                                        <td>0%</td>
                                                        <td>Rs. 79.99</td>
                                                        <td><i class="fas fa-print print-icon"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Additional order rows would go here -->
                            <tr>
                                <td>#6549</td>
                                <td>5 min ago</td>
                                <td>$324</td>
                                <td>PayPal</td>
                                <td><span class="status-completed">Completed</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm action-btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                            <li>
                                                <a class="dropdown-item view-details" href="#" 
                                                   data-bs-toggle="collapse" 
                                                   data-bs-target="#orderDetails6549"
                                                   aria-expanded="false" 
                                                   aria-controls="orderDetails6549">
                                                    View Details
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Cancel</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <!-- Order Details for #6549 -->
                            <tr class="collapse" id="orderDetails6549" data-bs-parent=".table">
                                <td colspan="6" class="p-0">
                                    <div class="detail-table m-2 p-3">
                                        <h6 class="mb-3">Order Details for #6549</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>SKU</th>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Disc.</th>
                                                        <th>Total</th>
                                                        <th>Print</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>#6549</td>
                                                        <td>Summer Dress</td>
                                                        <td>$59.99</td>
                                                        <td>x1</td>
                                                        <td>15%</td>
                                                        <td>Rs. 50.99</td>
                                                        <td><i class="fas fa-print print-icon"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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

    // Fix for dropdown details - close dropdown when clicking view details
    document.querySelectorAll('.view-details').forEach(item => {
        item.addEventListener('click', function() {
            // Close the dropdown menu
            const dropdown = this.closest('.dropdown-menu');
            const dropdownInstance = bootstrap.Dropdown.getInstance(dropdown.closest('.dropdown').querySelector('.dropdown-toggle'));
            if (dropdownInstance) {
                dropdownInstance.hide();
            }
        });
    });

    // Initialize all dropdowns
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl)
    });

    // Initialize all collapses
    var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
    var collapseList = collapseElementList.map(function (collapseEl) {
        return new bootstrap.Collapse(collapseEl, {
            toggle: false
        })
    });
</script>
@endsection