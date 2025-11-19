@extends("admin.layout.main")
@section('content')

<style>
/* ================= TAB BUTTONS ================= */
.custom-tab-btns {
    display: flex;
    width: 100%;
    gap: 10px;
}

.custom-tab-btns .tab-btn {
    width: 25%; /* 4 tabs in a row */
    text-align: center;
    padding: 10px 0;
    background: #ffffff;
    border-radius: 14px;
    cursor: pointer;
    font-weight: 500;
    font-size: 16px;
    transition: 0.3s;
    border: 1px solid #e0e0e0;
}

.custom-tab-btns .tab-btn:hover {
    background-color: #f8f9fa;
}

.custom-tab-btns .tab-btn.active {
    background-color: #94010E1A;
    font-weight: 600;
    color: #94010E;
    border-color: #94010E;
}

/* ================= CARD ================= */
.custom-tab-card {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    border-top: none;
    margin-bottom: 20px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
}

/* ================= TABLE STYLING ================= */
.custom-tab-card .table-responsive {
    overflow-x: auto;
}

.custom-tab-card table {
    width: 100%;
    font-size: 16px;
    border: none;
    border-collapse: collapse;
}

/* Table header */
.custom-tab-card table thead th {
     border-bottom: 1px solid #f0f0f0;
    border: none;
    text-align: left;
    padding: 12px 10px;
    font-weight: 600;
}

/* Table body */
.custom-tab-card table tbody td {
    border: none;
    padding: 12px 10px;
    border-bottom: 1px solid #f0f0f0;
}

/* Profit badge */
.profit-badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    background-color: transparent;
}

/* Dropdown styling */
.form-select-no-border {
    border: none;
    padding: 6px 12px;
    font-size: 14px;
    color: #fff;
    border-radius: 8px;
    min-width: 120px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-clip: padding-box;
    transition: background-color 0.3s;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 8px center;
    background-size: 16px;
}

.form-select-no-border:focus {
    outline: none;
    box-shadow: none;
    border: none;
}

.status-pending { 
    background-color: #FFA52F; 
}

.status-confirmed { 
    background-color: #0FB7FF; 
}

.status-shipped { 
    background-color: #010101; 
}

.status-delivered { 
    background-color: #28a745; 
}

/* Search and Filter Bar */
/* .search-bar-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    margin-top: 20px;
} */

/* .form-search {
    flex: 1;
    max-width: 400px;
}

.form-search fieldset.name {
    position: relative;
    margin: 0;
} */

/* .form-search fieldset.name input {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
} */

/* Date Range Filter */
.date-range-filter {
    display: flex;
    align-items: center;
    gap: 10px;
}

.date-range-input {
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    background-color: white;
    cursor: pointer;
}

.date-range-input:hover {
    border-color: #94010E;
}

/* Action Dropdown */
.action-dropdown {
    position: relative;
    display: inline-block;
}

.action-btn {
    margin:13px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f8f9fa;
    border: 1px solid #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
}

.action-btn:hover {
    background: #94010E;
    color: white;
    border-color: #94010E;
}

.action-menu {
    position: absolute;
    right: 0;
    top: 100%;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    min-width: 150px;
    z-index: 1000;
    display: none;
}

.action-menu.show {
    display: block;
}

.action-menu a {
    display: block;
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s;
    border-bottom: 1px solid #f0f0f0;
}

.action-menu a:last-child {
    border-bottom: none;
}

.action-menu a:hover {
    background-color: #f8f9fa;
    color: #94010E;
}

/* Pagination */
.pagination {
    margin-top: 20px;
}

.page-link {
    color: #94010E;
    border: 1px solid #e0e0e0;
    padding: 8px 12px;
}

.page-item.active .page-link {
    background-color: #94010E;
    border-color: #94010E;
}

.page-link:hover {
    color: #7a000c;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .custom-tab-btns {
        flex-direction: column;
    }
    
    .custom-tab-btns .tab-btn {
        width: 100%;
    }
    
    .search-bar-container {
        flex-direction: column;
        align-items: stretch;
    }
    
    .form-search {
        max-width: 100%;
    }
    
    
    .custom-tab-card table thead th,
    .custom-tab-card table tbody td {
        width:140px;
        padding: 8px 5px;
        font-size: 15px;
    }
    
    .form-select-no-border {
        min-width: 100px;
        font-size: 13px;
        padding: 5px 10px;
    }
}

</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <!-- ================= ORDER TABS ================= -->
            <div class="row">
                <div class="col-12 wg-box-1">
                    <div class="custom-tab-btns mb-0">
                        <button class="tab-btn active" data-bs-toggle="tab" data-bs-target="#allOrders">All Orders (441)</button>
                        <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#shipping">Shipping (100)</button>
                        <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#completed">Completed (300)</button>
                        <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#cancel">Cancel (41)</button>
                    </div>
                </div>
            </div>
            
            <!-- Search and Filter Bar -->
            <div class="search-bar-container mt-5">
                <!-- Search Form -->
                <form class="form-search w-25" id="searchFormMobile">
                                <fieldset class="name d-flex">
                                    <input type="text" placeholder="Search customers..." id="customerSearchMobile"
                                           name="search" value="{{ request('search') }}" class="flex-grow-1">
                                    <button type="submit" class="search-icon">
                                        <i class="icon-search"></i>
                                    </button>
                                </fieldset>
                            </form>

                <!-- Date Range Filter -->
<div class="dropdown ">
    <button class="tf-button style-2 w-100" id="dateRangeFilterBtnMobile" data-bs-toggle="dropdown">
        Filter by Date Range <i class="icon-chevron-down"></i>
    </button>
    <div class="dropdown-content">
        <a href="#" data-range="today">Today</a>
        <a href="#" data-range="yesterday">Yesterday</a>
        <a href="#" data-range="this_week">This Week</a>
        <a href="#" data-range="last_week">Last Week</a>
        <a href="#" data-range="this_month">This Month</a>
        <a href="#" data-range="last_month">Last Month</a>
        <a href="#" data-range="custom">Custom Range</a>
    </div>
</div>

            </div>

            <!-- ================= ORDER TAB CONTENT ================= -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="allOrders">
                            <div class="custom-tab-card">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Created</th>
                                                <th>Customer</th>
                                                <th>Order Time</th>
                                                <th>Total</th>
                                                <th>Profit</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#001</td>
                                                <td>2 min ago</td>
                                                <td>John Doe</td>
                                                <td>2 hours ago</td>
                                                <td>$120.00</td>
                                                <td><span class="profit-badge">$50 (42%)</span></td>
                                                <td>
                                                    <select class="form-select-no-border status-pending">
                                                        <option value="pending" class="status-pending" selected>Pending</option>
                                                        <option value="confirmed" class="status-confirmed">Confirmed</option>
                                                        <option value="shipped" class="status-shipped">Shipped</option>
                                                        <option value="delivered" class="status-delivered">Delivered</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="action-dropdown">
                                                        <button class="action-btn">
                                                            <i class="icon-more-vertical"></i>
                                                        </button>
                                                        <div class="action-menu">
                                                            <a href="#"><i class="icon-eye"></i> View Details</a>
                                                            <a href="#"><i class="icon-edit"></i> Edit Order</a>
                                                            <a href="#" class="text-danger"><i class="icon-trash-2"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#002</td>
                                                <td>2 min ago</td>
                                                <td>Jane Smith</td>
                                                <td>5 hours ago</td>
                                                <td>$250.00</td>
                                                <td><span class="profit-badge">$100 (40%)</span></td>
                                                <td>
                                                    <select class="form-select-no-border status-confirmed">
                                                        <option value="pending" class="status-pending">Pending</option>
                                                        <option value="confirmed" class="status-confirmed" selected>Confirmed</option>
                                                        <option value="shipped" class="status-shipped">Shipped</option>
                                                        <option value="delivered" class="status-delivered">Delivered</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="action-dropdown">
                                                        <button class="action-btn">
                                                            <i class="icon-more-vertical"></i>
                                                        </button>
                                                        <div class="action-menu">
                                                            <a href="#"><i class="icon-eye"></i> View Details</a>
                                                            <a href="#"><i class="icon-edit"></i> Edit Order</a>
                                                            <a href="#" class="text-danger"><i class="icon-trash-2"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#003</td>
                                                <td>2 min ago</td>
                                                <td>Ali Khan</td>
                                                <td>1 day ago</td>
                                                <td>$80.00</td>
                                                <td><span class="profit-badge">$30 (37.5%)</span></td>
                                                <td>
                                                    <select class="form-select-no-border status-shipped">
                                                        <option value="pending" class="status-pending">Pending</option>
                                                        <option value="confirmed" class="status-confirmed">Confirmed</option>
                                                        <option value="shipped" class="status-shipped" selected>Shipped</option>
                                                        <option value="delivered" class="status-delivered">Delivered</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="action-dropdown">
                                                        <button class="action-btn">
                                                            <i class="icon-more-vertical"></i>
                                                        </button>
                                                        <div class="action-menu">
                                                            <a href="#"><i class="icon-eye"></i> View Details</a>
                                                            <a href="#"><i class="icon-edit"></i> Edit Order</a>
                                                            <a href="#" class="text-danger"><i class="icon-trash-2"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#004</td>
                                                <td>5 min ago</td>
                                                <td>Robert Brown</td>
                                                <td>3 hours ago</td>
                                                <td>$180.00</td>
                                                <td><span class="profit-badge">$85 (47%)</span></td>
                                                <td>
                                                    <select class="form-select-no-border status-delivered">
                                                        <option value="pending" class="status-pending">Pending</option>
                                                        <option value="confirmed" class="status-confirmed">Confirmed</option>
                                                        <option value="shipped" class="status-shipped">Shipped</option>
                                                        <option value="delivered" class="status-delivered" selected>Delivered</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="action-dropdown">
                                                        <button class="action-btn">
                                                            <i class="icon-more-vertical"></i>
                                                        </button>
                                                        <div class="action-menu">
                                                            <a href="#"><i class="icon-eye"></i> View Details</a>
                                                            <a href="#"><i class="icon-edit"></i> Edit Order</a>
                                                            <a href="#" class="text-danger"><i class="icon-trash-2"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <nav aria-label="Page navigation" class="mt-3">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#"><i class="icon-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active"><span class="page-link">1</span></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="icon-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="shipping">
                            <div class="custom-tab-card">
                                <h3>Shipping Orders</h3>
                                <p>Shipping orders list goes here…</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="completed">
                            <div class="custom-tab-card">
                                <h3>Completed Orders</h3>
                                <p>Completed orders list goes here…</p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="cancel">
                            <div class="custom-tab-card">
                                <h3>Cancelled Orders</h3>
                                <p>Cancelled orders list goes here…</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Tab switching functionality
    document.querySelectorAll(".custom-tab-btns .tab-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            document.querySelectorAll(".tab-pane").forEach(tab => tab.classList.remove("show", "active"));

            document.querySelector(this.dataset.bsTarget).classList.add("show", "active");
        });
    });
    
    // Status dropdown color management
    const statusColors = {
        pending: "#FFA52F",
        confirmed: "#0FB7FF",
        shipped: "#010101",
        delivered: "#28a745"
    };

    // Apply initial colors and add change event listeners
    document.querySelectorAll('.form-select-no-border').forEach(select => {
        const value = select.value.toLowerCase();
        select.style.backgroundColor = statusColors[value];
        
        // Update color on change
        select.addEventListener('change', function() {
            const val = this.value.toLowerCase();
            this.style.backgroundColor = statusColors[val];
        });

        // Remove border on focus
        select.addEventListener('focus', function() {
            this.style.border = 'none';
            this.style.outline = 'none';
            this.style.boxShadow = 'none';
        });
    });
    
    // Action dropdown functionality
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            const isShowing = menu.classList.contains('show');
            
            // Close all other menus
            document.querySelectorAll('.action-menu').forEach(m => {
                m.classList.remove('show');
            });
            
            // Toggle current menu
            if (!isShowing) {
                menu.classList.add('show');
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        document.querySelectorAll('.action-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    });
});
</script>
@endpush