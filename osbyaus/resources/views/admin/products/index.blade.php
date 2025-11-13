@extends("admin.layout.main")

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">

                <!-- Search and Filter Bar -->
                <div class="search-bar-container mb-2">
                    <!-- Search Form -->
                    <form class="form-search" id="searchForm">
                        <fieldset class="name">
                            <input type="text" placeholder="Search products..." id="productSearch" name="search">
                            <button type="submit" class="search-icon">
                                <i class="icon-search"></i>
                            </button>
                        </fieldset>
                    </form>

                    <!-- Status Filter -->
                    <div class="dropdown">
                        <button class="tf-button style-2 w150" id="statusFilterBtn">
                            Status <i class="icon-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#" data-status="all">All</a>
                            <a href="#" data-status="active">Active</a>
                            <a href="#" data-status="inactive">Inactive</a>
                            <a href="#" data-status="in_stock">In Stock</a>
                            <a href="#" data-status="out_of_stock">Out of Stock</a>
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="dropdown">
                        <button class="tf-button style-2 w150" id="sortFilterBtn">
                            Sort By <i class="icon-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#" data-sort="newest">Newest First</a>
                            <a href="#" data-sort="oldest">Oldest First</a>
                            <a href="#" data-sort="name_asc">A-Z</a>
                            <a href="#" data-sort="name_desc">Z-A</a>
                            <a href="#" data-sort="price_asc">Price: Low to High</a>
                            <a href="#" data-sort="price_desc">Price: High to Low</a>
                        </div>
                    </div>

                    <!-- Clear Filters -->
                    <a href="{{ route('admin.product.index') }}" class="tf-button style-2">
                        <i class="icon-refresh-cw"></i> Clear
                    </a>

                    <a class="tf-button style-1 w208" href="{{ route('admin.product.add') }}">
                        <i class="icon-plus"></i> Add
                    </a>
                </div>

                <!-- Loading Spinner -->
                <div id="loadingSpinner" class="text-center py-5" style="display: none;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 body-text">Loading products...</p>
                </div>

                <!-- Product List Container -->
                <div id="productsContainer">
                    <!-- Products will be loaded here via AJAX -->
                </div>

            </div>
        </div>

        @include('admin.components.footer')
    </div>
@endsection

@push('styles')
    <style>
        /* ========================
           SPINNER STYLES
        ======================== */
        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-color: var(--Main);
            border-right-color: transparent;
        }

        /* ========================
           DROPDOWN STYLES
        ======================== */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--White);
            min-width: 180px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.15);
            z-index: 1000;
            border-radius: 8px;
            border: 1px solid var(--Stroke);
            margin-top: 5px;
            overflow: hidden;
        }

        .dropdown-content a {
            color: var(--Body-Text);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--Stroke);
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: var(--hv-item);
            color: var(--Main);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* ========================
           PAGINATION STYLES
        ======================== */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 5px;
        }

        .page-item {
            margin: 0;
        }

        .page-link {
            padding: 10px 16px;
            border: 1px solid var(--Stroke);
            background: var(--White) !important;
            color: var(--Body-Text) !important;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            height: 44px;
        }

        .page-link:hover {
            background-color: var(--hv-item) !important;
            border-color: var(--Main) !important;
            color: var(--Main) !important;
        }

        .page-item.active .page-link {
            background: var(--Main) !important;
            color: var(--White) !important;
            border-color: var(--Main) !important;
        }

        .page-item.disabled .page-link {
            color: var(--Note);
            background-color: var(--Surface-3);
            border-color: var(--Stroke);
            pointer-events: none;
            opacity: 0.6;
        }

        /* ========================
           FILTER BADGE STYLES
        ======================== */
        .filter-badge {
            background: var(--Main);
            color: var(--White);
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        /* ========================
           BUTTON STYLES
        ======================== */
        .tf-button.style-1 {
            background: var(--Main);
            color: var(--White);
            border: 1px solid var(--Main);
            font-size: 14px !important;
        }

        .tf-button.style-1:hover {
            background: var(--Style);
            border-color: var(--Style);
        }

        .tf-button.style-2 {
            background: var(--White);
            color: var(--Body-Text);
            border: 1px solid var(--Stroke);
        }

        .tf-button.style-2:hover {
            background: var(--hv-item);
            border-color: var(--Main);
            color: var(--Main);
        }

        /* ========================
           SEARCH BAR STYLES
        ======================== */
        .search-bar-container {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 16px;
            background: var(--White);
            border-radius: 12px;
            border: 1px solid var(--Stroke);
        }

        .form-search fieldset.name {
            position: relative;
            margin: 0;
        }

        .form-search input {
            padding: 12px 16px;
            padding-right: 50px;
            border: 1px solid var(--Stroke);
            border-radius: 8px;
            background: var(--Input);
            color: var(--Body-Text);
            font-size: 14px;
            width: 280px;
            transition: all 0.3s ease;
        }

        .form-search input:focus {
            outline: none;
            border-color: var(--Main);
            background: var(--White);
            box-shadow: 0 0 0 3px rgba(255, 116, 51, 0.1);
        }

        .form-search input::placeholder {
            color: var(--Text-Holder);
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--Icon);
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .search-icon:hover {
            color: var(--Main);
        }

        /* ========================
           TABLE & PRODUCT STYLES
        ======================== */
        .wg-box {
            background: var(--White);
            border-radius: 12px;
            border: 1px solid var(--Stroke);
            overflow: hidden;
        }

        .table-title {
            background: var(--bg-table-1);
            padding: 20px;
            margin: 0 !important;
            border-bottom: 1px solid var(--Stroke);
        }

        .table-title .body-title {
            color: var(--Heading);
            font-weight: 600;
            font-size: 14px;
        }

        .wg-product.item-row {
            padding: 20px;
            border-bottom: 1px solid var(--Stroke);
            transition: all 0.3s ease;
            margin: 0 !important;
        }

        .wg-product.item-row:hover {
            background: var(--hv-item);
        }

        .wg-product.item-row:last-child {
            border-bottom: none;
        }

        /* ========================
           STATUS BADGES
        ======================== */
        .block-available {
            background: var(--Palette-Green-500) !important;
            color: var(--White);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
        }

        .block-stock {
            background: var(--Palette-Red-500) !important;
            color: var(--White);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
        }

        /* ========================
           ACTION ICONS
        ======================== */
        .list-icon-function {
            display: flex;
            gap: 8px;
        }

        .list-icon-function .item {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--Icon);
            background: var(--Surface-3);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .list-icon-function .item:hover {
            background: var(--Main);
            color: var(--White);
            transform: translateY(-2px);
        }

        .list-icon-function .item.trash:hover {
            background: var(--Palette-Red-500);
        }

        /* ========================
           COLOR & SIZE DISPLAY
        ======================== */
        .size-display-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .color-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
            border: 2px solid var(--White);
            box-shadow: 0 0 0 1px var(--Stroke);
        }

        .size-display p {
            margin: 0;
            color: var(--Body-Text);
            font-size: 14px;
        }

        /* ========================
           TEXT STYLES
        ======================== */
        .body-text {
            color: var(--Body-Text);
        }

        .text-main-dark {
            color: var(--Main-Dark);
        }

        .text-muted {
            color: var(--Note) !important;
        }

        .text-danger {
            color: var(--Palette-Red-500) !important;
        }

        /* ========================
           EMPTY STATE
        ======================== */
        .text-center.py-5 .body-text {
            color: var(--Body-Text);
        }

        .text-center.py-5 .icon-package {
            color: var(--Icon);
        }

        /* ========================
           RESPONSIVE STYLES
        ======================== */
        @media (max-width: 768px) {
            .search-bar-container {
                flex-direction: column;
                align-items: stretch;
            }

            .form-search input {
                width: 100%;
            }

            .dropdown {
                width: 100%;
            }

            .dropdown .tf-button {
                width: 100% !important;
                justify-content: space-between;
            }

            .pagination {
                flex-wrap: wrap;
            }

            .page-link {
                padding: 8px 12px;
                min-width: 40px;
                height: 40px;
                font-size: 12px;
            }
        }

        /* ========================
           LOADING STATES
        ======================== */
        #loadingSpinner .body-text {
            color: var(--Body-Text);
        }

        /* ========================
           ACCESSIBILITY
        ======================== */
        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* ========================
           ANIMATIONS
        ======================== */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        #productsContainer {
            animation: fadeIn 0.3s ease;
        }

        .dropdown-content {
            animation: fadeIn 0.2s ease;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            const csrfToken = $('meta[name="csrf-token"]').attr('content') || '';
            let currentPage = 1;
            let currentFilters = {
                search: '',
                status: 'all',
                sort: 'newest'
            };

            // Initialize
            loadProducts();

            // ========================
            // Event Handlers
            // ========================

            // Search form submission
            $('#searchForm').on('submit', function (e) {
                e.preventDefault();
                currentFilters.search = $('#productSearch').val();
                currentPage = 1;
                loadProducts();
            });

            // Status filter
            $('.dropdown-content a[data-status]').on('click', function (e) {
                e.preventDefault();
                currentFilters.status = $(this).data('status');
                currentPage = 1;
                updateFilterButton('statusFilterBtn', 'Status', currentFilters.status);
                loadProducts();
            });

            // Sort filter
            $('.dropdown-content a[data-sort]').on('click', function (e) {
                e.preventDefault();
                currentFilters.sort = $(this).data('sort');
                currentPage = 1;
                updateFilterButton('sortFilterBtn', 'Sort By', currentFilters.sort);
                loadProducts();
            });

            // Pagination
            $(document).on('click', '.page-link', function (e) {
                e.preventDefault();
                if ($(this).parent().hasClass('disabled')) return;

                const page = $(this).data('page');
                if (page) {
                    currentPage = page;
                    loadProducts();
                }
            });

            // ========================
            // Load Products Function
            // ========================
            function loadProducts() {
                showLoading();

                $.ajax({
                    url: '{{ route("admin.product.index") }}',
                    method: 'GET',
                    data: {
                        ...currentFilters,
                        page: currentPage,
                        ajax: true
                    },
                    success: function (response) {
                        $('#productsContainer').html(response.html);
                        updatePagination(response);
                        hideLoading();
                    },
                    error: function (xhr) {
                        console.error('Error loading products:', xhr);
                        $('#productsContainer').html(`
                        <div class="text-center py-5">
                            <div class="text-danger mb-3">
                                <i class="icon-alert-circle" style="font-size: 48px;"></i>
                            </div>
                            <div class="body-text">Failed to load products. Please try again.</div>
                        </div>
                    `);
                        hideLoading();
                    }
                });
            }

            // ========================
            // Helper Functions
            // ========================
            function showLoading() {
                $('#loadingSpinner').show();
                $('#productsContainer').hide();
            }

            function hideLoading() {
                $('#loadingSpinner').hide();
                $('#productsContainer').show();
            }

            function updateFilterButton(buttonId, defaultText, currentValue) {
                const button = $('#' + buttonId);
                let displayText = defaultText;

                if (currentValue !== 'all' && currentValue !== 'newest') {
                    const valueText = currentValue.replace(/_/g, ' ');
                    displayText = `${defaultText}: ${valueText.charAt(0).toUpperCase() + valueText.slice(1)}`;
                }

                button.html(`${displayText} <i class="icon-chevron-down"></i>`);
            }

            function updatePagination(response) {
                // Pagination is already included in the HTML response
            }

            // ========================
            // Delete Product
            // ========================
            $(document).on('click', '.delete-product', function (e) {
                e.preventDefault();
                const productId = $(this).data('id');
                const productName = $(this).data('name');

                SweetAlertHelper.confirm(
                    `Are you sure you want to delete "${productName}"? This action cannot be undone and all associated data will be lost.`,
                    'Delete Product?',
                    () => {
                        const loadingAlert = SweetAlertHelper.loading('Deleting product...');
                        $.ajax({
                            url: `/admin/products/${productId}/delete`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            success: function (response) {
                                SweetAlertHelper.close();
                                if (response.status === 'success') {
                                    SweetAlertHelper.successAutoClose(
                                        response.message || 'Product deleted successfully!',
                                        'Deleted!'
                                    );
                                    // Reload products after deletion
                                    loadProducts();
                                } else {
                                    SweetAlertHelper.error(
                                        response.message || 'Failed to delete product.',
                                        'Delete Failed!'
                                    );
                                }
                            },
                            error: function (xhr) {
                                SweetAlertHelper.close();
                                let errorMessage = 'Failed to delete product. Please try again.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                                SweetAlertHelper.error(
                                    errorMessage,
                                    'Delete Failed!'
                                );
                            }
                        });
                    },
                    {
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        icon: 'warning',
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6'
                    }
                );
            });
        });
    </script>
@endpush
