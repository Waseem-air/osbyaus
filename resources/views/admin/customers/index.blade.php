@extends("admin.layout.main")

@section('content')
    <!-- main-content -->
    <div class="main-content">

        <!-- Add & Edit Customer Modals -->
        @include('admin.customers.addCustomerModal')
        @include('admin.customers.editCustomerModal')

        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <div class="main-content-wrap">

                <!-- Page Heading -->
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Customer Management</h3>
                    <div class="flex items-center gap20">
                        <span class="body-text">Total Customers: {{ $customers->total() }}</span>
                    </div>
                </div>

                <!-- Desktop Search + Filters -->
                <div class="search-bar-container mb-2 d-none d-md-flex">

                    <!-- Search Form -->
                    <form class="form-search" id="searchForm">
                        <fieldset class="name">
                            <input type="text" placeholder="Search customers..." id="customerSearch"
                                   name="search" value="{{ request('search') }}">
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
                            <a href="#" data-status="verified">Verified</a>
                            <a href="#" data-status="unverified">Unverified</a>
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
                            <a href="#" data-sort="name_asc">Name A-Z</a>
                            <a href="#" data-sort="name_desc">Name Z-A</a>
                        </div>
                    </div>

                    <!-- Clear Button -->
                    <a href="{{ route('admin.customer.index') }}" class="tf-button style-2">
                        <i class="icon-refresh-cw"></i> Clear
                    </a>

                    <!-- Add Customer Button -->
                    <button class="tf-button style-1 w208"
                            data-bs-toggle="modal"
                            data-bs-target="#addCustomerModal">
                        <i class="icon-plus"></i> Add New Customer
                    </button>

                </div>

                <!-- Mobile Filters -->
                <div class="d-block d-md-none mb-2">
                    <div class="row g-2">

                        <!-- Search -->
                        <div class="col-12">
                            <form class="form-search" id="searchFormMobile">
                                <fieldset class="name d-flex">
                                    <input type="text" placeholder="Search customers..." id="customerSearchMobile"
                                           name="search" value="{{ request('search') }}" class="flex-grow-1">
                                    <button type="submit" class="search-icon">
                                        <i class="icon-search"></i>
                                    </button>
                                </fieldset>
                            </form>
                        </div>

                        <!-- Status -->
                        <div class="col-6 mt-4">
                            <div class="dropdown w-100">
                                <button class="tf-button style-2 w-100" id="statusFilterBtnMobile"
                                        data-bs-toggle="dropdown">
                                    Status <i class="icon-chevron-down"></i>
                                </button>
                                <div class="dropdown-content">
                                    <a href="#" data-status="all">All</a>
                                    <a href="#" data-status="active">Active</a>
                                    <a href="#" data-status="inactive">Inactive</a>
                                    <a href="#" data-status="verified">Verified</a>
                                    <a href="#" data-status="unverified">Unverified</a>
                                </div>
                            </div>
                        </div>

                        <!-- Sort -->
                        <div class="col-6 mt-4">
                            <div class="dropdown w-100">
                                <button class="tf-button style-2 w-100" id="sortFilterBtnMobile"
                                        data-bs-toggle="dropdown">
                                    Sort By <i class="icon-chevron-down"></i>
                                </button>
                                <div class="dropdown-content">
                                    <a href="#" data-sort="newest">Newest First</a>
                                    <a href="#" data-sort="oldest">Oldest First</a>
                                    <a href="#" data-sort="name_asc">Name A-Z</a>
                                    <a href="#" data-sort="name_desc">Name Z-A</a>
                                </div>
                            </div>
                        </div>

                        <!-- Clear -->
                        <div class="col-6">
                            <a href="{{ route('admin.customer.index') }}" class="tf-button style-2 w-100">
                                <i class="icon-refresh-cw"></i> Clear
                            </a>
                        </div>

                        <!-- Add -->
                        <div class="col-6">
                            <button class="tf-button style-1 w-100"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addCustomerModal">
                                <i class="icon-plus"></i> Add New
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Spinner -->
                <div id="loadingSpinner" class="text-center py-5" style="display:none;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 body-text">Loading customers...</p>
                </div>

                <!-- Customer List -->
                <div id="customersContainer">
                    @include('admin.customers.partials.customer_list', ['customers' => $customers])
                </div>

            </div>
        </div>

        @include('admin.components.footer')
    </div>
@endsection
