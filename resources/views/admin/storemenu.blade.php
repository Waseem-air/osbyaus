<style>
/* Remove all borders */
.store-menu-table,
.store-menu-table th,
.store-menu-table td {
    border: none !important;
}

/* Font size & padding */
.store-menu-table th,
.store-menu-table td {
    font-size: 16px;
    vertical-align: middle;
    padding: 15px !important;
}

/* Status badges */
.status-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 500;
}
.status-badge.active {
    background-color: #d4edda;
    color: #155724;
}
.status-badge.inactive {
    background-color: #f8d7da;
    color: #721c24;
}

/* Item actions */
.item-actions a {
    display: inline-block;
    margin-right: 8px;
    color: #6c757d;
    text-decoration: none;
    font-size: 16px;
}
.item-actions a:hover {
    color: #495057;
}

/* Box styling */
.wg-box {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    padding: 20px;
}

/* Switch styling */
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 28px;
}
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 34px;
}
.slider::before {
    position: absolute;
    content: "";
    height: 22px; width: 22px;
    left: 3px; bottom: 3px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}
.switch input:checked + .slider {
    background-color: #28a745;
}
.switch input:checked + .slider::before {
    transform: translateX(22px);
}
.slider.round { border-radius: 34px; }
.slider.round::before { border-radius: 50%; }
.status-label { font-weight: 500; font-size: 14px; }

/* Offcanvas width */
.offcanvas.custom-offcanvas {
    width: 350px !important;
    max-width: 90% !important;
}

/* Mobile responsiveness */
@media (max-width: 767px) {
    .store-menu-table th,
    .store-menu-table td {
        width: 170px;
        padding: 14px 12px;
    }
    .store-menu-table tr {
        height: auto;
    }
}
</style>

@extends("admin.layout.main")
@section('content')

<div class="main-content">
    <div class="main-content-inner">

        <!-- Search and Filter Bar (Desktop) -->
        <div class="search-bar-container mb-2 d-none d-md-flex align-items-center gap-2">

            <!-- Search Form -->
            <form class="form-search" id="searchForm">
                <fieldset class="name d-flex">
                    <input type="text" placeholder="Search menus..." id="menuSearch" name="search" value="{{ request('search') }}" class="flex-grow-1">
                    <button type="submit" class="search-icon">
                        <i class="icon-search"></i>
                    </button>
                </fieldset>
            </form>

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

            <!-- Add New Menu Button -->
            <button class="tf-button style-1 w208" type="button" data-bs-toggle="offcanvas" data-bs-target="#addCustomerCanvas" aria-controls="addCustomerCanvas">
                <i class="icon-plus"></i> Add New Menu
            </button>
        </div>

        <!-- Mobile Search & Filter Bar -->
        <div class="d-block d-md-none mb-2">
            <div class="row g-2">
                <div class="col-12">
                    <form class="form-search" id="searchFormMobile">
                        <fieldset class="name d-flex">
                            <input type="text" placeholder="Search menus..." id="menuSearchMobile" name="search" class="flex-grow-1">
                            <button type="submit" class="search-icon">
                                <i class="icon-search"></i>
                            </button>
                        </fieldset>
                    </form>
                </div>
                <div class="col-6">
                    <div class="dropdown w-100">
                        <button class="tf-button style-2 w-100" id="sortFilterBtnMobile" data-bs-toggle="dropdown">
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
                <div class="col-6">
                    <button class="tf-button style-1 w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#addCustomerCanvas" aria-controls="addCustomerCanvas">
                        <i class="icon-plus"></i> Add New Menu
                    </button>
                </div>
            </div>
        </div>

        <!-- Offcanvas -->
        <div class="offcanvas offcanvas-end custom-offcanvas" tabindex="-1" id="addCustomerCanvas" aria-labelledby="addCustomerCanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="addCustomerCanvasLabel">Add/Edit Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form id="addCustomerForm">
                    <div class="mb-3">
                        <label for="customerName" class="form-label">Menu Name</label>
                        <input type="text" class="form-control" id="customerName" placeholder="Enter Menu" required>
                    </div>

                    <!-- Status Toggle -->
                    <div class="status-toggle d-flex align-items-center gap-2 mb-3">
                        <span class="status-label">Active</span>
                        <label class="switch">
                            <input type="checkbox" name="status" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <button type="submit" class="tf-button style-1 w-100">Save Menu</button>
                </form>
            </div>
        </div>

        <!-- Store Menu Table -->
        <div class="wg-box mt-5">
            <div class="table-responsive">
                <table class="table store-menu-table mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Joseph Wheeler</td>
                            <td><span class="status-badge active">Active</span></td>
                            <td>Apr 06, 2023</td>
                            <td class="item-actions">
                                <a href="#" class="edit" title="Edit"><i class="icon-edit"></i></a>
                                <a href="#" class="delete" title="Delete"><i class="icon-trash-2"></i></a>
                                <a href="#" class="view" title="View"><i class="icon-eye"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Sarah Johnson</td>
                            <td><span class="status-badge inactive">Inactive</span></td>
                            <td>Apr 05, 2023</td>
                            <td class="item-actions">
                                <a href="#" class="edit" title="Edit"><i class="icon-edit"></i></a>
                                <a href="#" class="delete" title="Delete"><i class="icon-trash-2"></i></a>
                                <a href="#" class="view" title="View"><i class="icon-eye"></i></a>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="divider my-3"></div>
            <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">
                <div class="text-tiny">Showing 5 entries</div>
                <ul class="pagination wg-pagination mb-0">
                    <li class="page-item"><a class="page-link" href="#"><i class="icon-chevron-left"></i></a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="icon-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>

    </div>
</div>

@endsection
