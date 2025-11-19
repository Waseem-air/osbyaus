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
            margin: 13px;
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
                width: 140px;
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
                <h1>Order Management</h1>

                <!-- ================= ORDER TABS ================= -->
                <div class="row mt-5">
                    <div class="col-12 wg-box-1">
                        <div class="custom-tab-btns mb-0">
                            <button class="tab-btn active" data-tab="all">All Orders ({{ $orderCounts['all'] }})
                            </button>
                            <button class="tab-btn" data-tab="pending">Pending ({{ $orderCounts['pending'] }})</button>
                            <button class="tab-btn" data-tab="confirmed">Confirmed ({{ $orderCounts['confirmed'] }})
                            </button>
                            <button class="tab-btn" data-tab="processing">Processing ({{ $orderCounts['processing'] }}
                                )
                            </button>
                            <button class="tab-btn" data-tab="shipped">Shipping ({{ $orderCounts['shipped'] }})</button>
                            <button class="tab-btn" data-tab="delivered">Completed ({{ $orderCounts['delivered'] }})
                            </button>
                            <button class="tab-btn" data-tab="cancelled">Cancelled ({{ $orderCounts['cancelled'] }})
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter Bar -->
                <div class="search-bar-container mt-5">
                    <!-- Search Form -->
                    <form class="form-search w-25" id="searchForm">
                        <fieldset class="name d-flex">
                            <input type="text" placeholder="Search orders..." id="orderSearch"
                                   name="search" value="{{ request('search') }}" class="flex-grow-1">
                            <button type="submit" class="search-icon">
                                <i class="icon-search"></i>
                            </button>
                        </fieldset>
                    </form>

                    <!-- Payment Status Filter -->
                    <div class="dropdown">
                        <button class="tf-button style-2 w-100" id="paymentStatusFilterBtn" data-bs-toggle="dropdown">
                            Payment Status <i class="icon-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#" data-status="all">All Payments</a>
                            <a href="#" data-status="paid">Paid</a>
                            <a href="#" data-status="pending">Pending Payment</a>
                            <a href="#" data-status="failed">Failed</a>
                        </div>
                    </div>

                    <!-- Date Range Filter -->
                    <div class="dropdown">
                        <button class="tf-button style-2 w-100" id="dateRangeFilterBtn" data-bs-toggle="dropdown">
                            Filter by Date <i class="icon-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#" data-range="all">All Time</a>
                            <a href="#" data-range="today">Today</a>
                            <a href="#" data-range="yesterday">Yesterday</a>
                            <a href="#" data-range="this_week">This Week</a>
                            <a href="#" data-range="last_week">Last Week</a>
                            <a href="#" data-range="this_month">This Month</a>
                            <a href="#" data-range="last_month">Last Month</a>
                        </div>
                    </div>
                </div>

                <!-- Loading Spinner -->
                <div id="loadingSpinner" class="text-center py-4" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading orders...</p>
                </div>

                <!-- ================= ORDER TAB CONTENT ================= -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div id="ordersContainer">
                            @include('admin.orders.partials.orders_list')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div class="modal fade" id="statusUpdateModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="statusUpdateForm">
                        @csrf
                        <input type="hidden" name="order_id" id="orderId">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="statusSelect" required>
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" name="notes" id="statusNotes" rows="3"
                                      placeholder="Add any notes for the customer..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmStatusUpdate">Update Status</button>
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
                select.addEventListener('change', function () {
                    const val = this.value.toLowerCase();
                    this.style.backgroundColor = statusColors[val];
                });

                // Remove border on focus
                select.addEventListener('focus', function () {
                    this.style.border = 'none';
                    this.style.outline = 'none';
                    this.style.boxShadow = 'none';
                });
            });

            // Action dropdown functionality
            document.querySelectorAll('.action-btn').forEach(btn => {
                btn.addEventListener('click', function (e) {
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
            document.addEventListener('click', function () {
                document.querySelectorAll('.action-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let currentTab = 'all';
            let currentFilters = {
                search: '',
                payment_status: 'all',
                date_range: 'all'
            };

            // Tab switching functionality
            document.querySelectorAll(".custom-tab-btns .tab-btn").forEach(btn => {
                btn.addEventListener("click", function () {
                    document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
                    this.classList.add("active");

                    currentTab = this.dataset.tab;
                    loadOrders();
                });
            });

            // Search functionality
            document.getElementById('searchForm').addEventListener('submit', function (e) {
                e.preventDefault();
                currentFilters.search = document.getElementById('orderSearch').value;
                loadOrders();
            });

            // Payment status filter
            document.querySelectorAll('#paymentStatusFilterBtn + .dropdown-content a').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    currentFilters.payment_status = this.dataset.status;
                    document.getElementById('paymentStatusFilterBtn').textContent =
                        this.textContent + ' <i class="icon-chevron-down"></i>';
                    loadOrders();
                });
            });

            // Date range filter
            document.querySelectorAll('#dateRangeFilterBtn + .dropdown-content a').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    currentFilters.date_range = this.dataset.range;
                    document.getElementById('dateRangeFilterBtn').textContent =
                        this.textContent + ' <i class="icon-chevron-down"></i>';
                    loadOrders();
                });
            });

            // Load orders via AJAX
            function loadOrders() {
                const spinner = document.getElementById('loadingSpinner');
                const container = document.getElementById('ordersContainer');

                spinner.style.display = 'block';
                container.style.opacity = '0.5';

                const params = new URLSearchParams({
                    status: currentTab,
                    ...currentFilters
                });

                fetch(`{{ route('admin.order.index') }}?${params}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        container.innerHTML = data.html;
                        updateTabCounts(data.orderCounts);
                        initializeEventListeners();
                    })
                    .catch(error => {
                        console.error('Error loading orders:', error);
                        alert('Error loading orders. Please try again.');
                    })
                    .finally(() => {
                        spinner.style.display = 'none';
                        container.style.opacity = '1';
                    });
            }

            // Update tab counts
            function updateTabCounts(counts) {
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    const tab = btn.dataset.tab;
                    const count = counts[tab] || 0;
                    btn.textContent = btn.textContent.replace(/\(\d+\)/, `(${count})`);
                });
            }

            // Initialize event listeners for dynamic content
            function initializeEventListeners() {
                // Status dropdown change
                document.querySelectorAll('.status-dropdown').forEach(select => {
                    select.addEventListener('change', function () {
                        const orderId = this.dataset.orderId;
                        const newStatus = this.value;

                        showStatusUpdateModal(orderId, newStatus);
                    });
                });

                // Action dropdown functionality
                document.querySelectorAll('.action-btn').forEach(btn => {
                    btn.addEventListener('click', function (e) {
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
                document.addEventListener('click', function () {
                    document.querySelectorAll('.action-menu').forEach(menu => {
                        menu.classList.remove('show');
                    });
                });

                // Pagination links
                document.querySelectorAll('.pagination a').forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const url = new URL(this.href);
                        currentFilters.page = url.searchParams.get('page');
                        loadOrders();
                    });
                });
            }

            // Show status update modal
            function showStatusUpdateModal(orderId, status) {
                document.getElementById('orderId').value = orderId;
                document.getElementById('statusSelect').value = status;
                document.getElementById('statusNotes').value = '';

                const modal = new bootstrap.Modal(document.getElementById('statusUpdateModal'));
                modal.show();
            }

            // Confirm status update
            document.getElementById('confirmStatusUpdate').addEventListener('click', function () {
                const form = document.getElementById('statusUpdateForm');
                const formData = new FormData(form);

                fetch(`/admin/orders/${formData.get('order_id')}/update-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Close modal
                            bootstrap.Modal.getInstance(document.getElementById('statusUpdateModal')).hide();

                            // Show success message
                            showAlert('success', data.message);

                            // Reload orders
                            loadOrders();
                        } else {
                            showAlert('error', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error updating status:', error);
                        showAlert('error', 'Failed to update status. Please try again.');
                    });
            });

            // Show alert message
            function showAlert(type, message) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
                alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

                document.querySelector('.container').insertBefore(alertDiv, document.querySelector('.container').firstChild);

                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }

            // Initialize on page load
            initializeEventListeners();
        });
    </script>
@endpush
