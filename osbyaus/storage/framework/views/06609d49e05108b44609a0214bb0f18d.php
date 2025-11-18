<?php $__env->startSection('content'); ?>
    <!-- main-content -->
    <div class="main-content">
        <!-- Add Customer Modal -->
        <?php echo $__env->make('admin.customers.addCustomerModal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- Edit Customer Modal -->
        <?php echo $__env->make('admin.customers.editCustomerModal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Customer Management</h3>
                    <div class="flex items-center gap20">
                        <span class="body-text">Total Customers: <?php echo e($customers->total()); ?></span>
                    </div>
                </div>

               <!-- Search and Filter Bar -->
                <div class="search-bar-container mb-2 d-none d-md-flex">
                        <!-- Search Form -->
                        <form class="form-search" id="searchForm">
                            <fieldset class="name">
                                <input type="text" placeholder="Search customers..." id="customerSearch" name="search" value="<?php echo e(request('search')); ?>">
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

                        <!-- Clear Filters -->
                        <a href="<?php echo e(route('admin.customer.index')); ?>" class="tf-button style-2">
                            <i class="icon-refresh-cw"></i> Clear
                        </a>

                        <!-- Add New Button -->
                        <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                            <i class="icon-plus"></i> Add New Customer
                        </button>
                </div>
              <!-- Mobile Search and Filter Bar (only visible on small screens) -->
<div class="d-block d-md-none mb-2">
    <div class="row g-2">
        <!-- Row 1: Status & Sort -->
          <!-- Row 3: Search Bar -->
        <div class="col-12">
            <form class="form-search" id="searchFormMobile">
                <fieldset class="name d-flex">
                    <input type="text" placeholder="Search customers..." id="customerSearchMobile" name="search" value="<?php echo e(request('search')); ?>" class="flex-grow-1">
                    <button type="submit" class="search-icon">
                        <i class="icon-search"></i>
                    </button>
                </fieldset>
            </form>
        </div>
        <div class="col-6 mt-4">
            <div class="dropdown w-100">
                <button class="tf-button style-2 w-100" id="statusFilterBtnMobile" data-bs-toggle="dropdown">
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
        <div class="col-6 mt-4">
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

        <!-- Row 2: Clear & Add -->
        <div class="col-6">
            <a href="<?php echo e(route('admin.customer.index')); ?>" class="tf-button style-2 w-100">
                <i class="icon-refresh-cw"></i> Clear
            </a>
        </div>
        <div class="col-6">
            <button class="tf-button style-1 w-100" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                <i class="icon-plus"></i> Add New
            </button>
        </div>

       
    </div>
</div>



                <!-- Loading Spinner -->
                <div id="loadingSpinner" class="text-center py-5" style="display: none;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 body-text">Loading customers...</p>
                </div>

                <!-- Customers List Container -->
                <div id="customersContainer">
                    <?php echo $__env->make('admin.customers.partials.customer_list', ['customers' => $customers], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

            </div>
        </div>

        <?php echo $__env->make('admin.components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function () {
            const csrfToken = $('meta[name="csrf-token"]').attr('content') || '';
            let currentPage = 1;
            let currentFilters = {
                search: '<?php echo e(request('search')); ?>',
                status: '<?php echo e(request('status', 'all')); ?>',
                sort: '<?php echo e(request('sort', 'newest')); ?>'
            };


            // Clear errors function
            function clearAllErrors() {
                $('.error-message').text('');
                $('.form-group').removeClass('has-error');
                $('.tf-field-input').removeClass('error');
            }

            // Clear field error on input
            function clearFieldError(field) {
                const fieldName = field.attr('name');
                field.closest('.form-group').removeClass('has-error');
                field.removeClass('error');

                // Add success state if value is valid
                if (field.val().trim() !== '') {
                    field.addClass('success');
                } else {
                    field.removeClass('success');
                }
            }

            // Set loading state
            function setLoadingState(button, isLoading) {
                const spinner = button.find('.spinner');
                if (isLoading) {
                    button.addClass('btn-loading loading').prop('disabled', true);
                    spinner.removeClass('d-none');
                } else {
                    button.removeClass('btn-loading loading').prop('disabled', false);
                    spinner.addClass('d-none');
                }
            }

            // Show form errors
            function showFormErrors(errors, prefix = '') {
                $.each(errors, function (key, errorArray) {
                    const errorElement = $(`#${prefix}${key.charAt(0).toUpperCase() + key.slice(1)}Error`);
                    const formGroup = errorElement.closest('.form-group');
                    const inputField = $(`[name="${key}"]`);

                    if (errorElement.length && errorArray.length > 0) {
                        errorElement.text(errorArray[0]);
                        formGroup.addClass('has-error');
                        inputField.addClass('error');
                        inputField.removeClass('success');
                    }

                    // Auto-hide errors after 3 seconds
                    setTimeout(() => {
                        errorElement.text('');
                        formGroup.removeClass('has-error');
                        inputField.removeClass('error');
                    }, 3000);
                });
            }
            // ========================
            // Load Customers with Filters
            // ========================
            function loadCustomers(page = 1) {
                currentPage = page;

                const filters = {
                    ...currentFilters,
                    page: page
                };

                $('#loadingSpinner').show();
                $('#customersContainer').hide();

                $.ajax({
                    url: '<?php echo e(route("admin.customer.index")); ?>',
                    method: 'GET',
                    data: filters,
                    success: function (response) {
                        $('#customersContainer').html(response.html);
                        $('#loadingSpinner').hide();
                        $('#customersContainer').show();

                        // Update filter button texts
                        updateFilterButtonTexts();
                    },
                    error: function (xhr) {
                        $('#loadingSpinner').hide();
                        $('#customersContainer').show();
                        SweetAlertHelper.error(
                            'Failed to load customers. Please try again.',
                            'Load Failed!'
                        );
                    }
                });
            }

            // ========================
            // Update Filter Button Texts
            // ========================
            function updateFilterButtonTexts() {
                // Status filter text
                const statusText = {
                    'all': 'Status',
                    'active': 'Active',
                    'inactive': 'Inactive',
                    'verified': 'Verified',
                    'unverified': 'Unverified'
                };
                $('#statusFilterBtn').html(`${statusText[currentFilters.status]} <i class="icon-chevron-down"></i>`);

                // Sort filter text
                const sortText = {
                    'newest': 'Newest First',
                    'oldest': 'Oldest First',
                    'name_asc': 'Name A-Z',
                    'name_desc': 'Name Z-A',
                };
                $('#sortFilterBtn').html(`${sortText[currentFilters.sort]} <i class="icon-chevron-down"></i>`);
            }

            // ========================
            // Search Form Submit
            // ========================
            $('#searchForm').on('submit', function (e) {
                e.preventDefault();
                currentFilters.search = $('#customerSearch').val();
                loadCustomers(1);
            });

            // ========================
            // Status Filter
            // ========================
            $('.dropdown-content a[data-status]').on('click', function (e) {
                e.preventDefault();
                currentFilters.status = $(this).data('status');
                loadCustomers(1);
            });

            // ========================
            // Sort Filter
            // ========================
            $('.dropdown-content a[data-sort]').on('click', function (e) {
                e.preventDefault();
                currentFilters.sort = $(this).data('sort');
                loadCustomers(1);
            });

            // ========================
            // Pagination
            // ========================
            $(document).on('click', '.page-link', function (e) {
                e.preventDefault();
                const page = $(this).data('page');
                if (page && page !== currentPage) {
                    loadCustomers(page);
                }
            });

            // ========================
            // Add Customer Form Submit
            // ========================
            $('#addCustomerForm').on('submit', function (e) {
                e.preventDefault();
                const form = $(this);
                const formData = new FormData(this);
                const submitBtn = $('#addCustomerBtn');

                clearAllErrors();
                setLoadingState(submitBtn, true);
                $.ajax({
                    url: '<?php echo e(route("admin.customer.store")); ?>',
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        setLoadingState(submitBtn, false);
                        if (response.status === 'success') {
                            $('#addCustomerModal').modal('hide');
                            form[0].reset();

                            SweetAlertHelper.successAutoClose(
                                response.message || 'Customer added successfully!',
                                'Success!'
                            ).then(() => {
                                setTimeout(() => location.reload(), 1200);
                            });
                        } else if (response.status === 'error') {
                            showFormErrors(response.errors);
                            if (response.message) {
                                SweetAlertHelper.error(
                                    response.message,
                                    'Validation Error!'
                                );
                            }
                        }
                    },
                    error: function (xhr) {
                        setLoadingState(submitBtn, false);

                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            showFormErrors(errors);
                        } else {
                            SweetAlertHelper.error(
                                'An error occurred while adding the customer.',
                                'Operation Failed!'
                            );
                        }
                    }
                });
            });

            // ========================
            // Edit Customer - Load Data
            // ========================
            $('#editCustomerModal').on('show.bs.modal', function (event) {
                const btn = $(event.relatedTarget);
                if (btn.hasClass('edit-customer')) {
                    const customerId = btn.data('id');

                    // Show loading state
                    const loadingAlert = SweetAlertHelper.loading('Loading customer data...');

                    $.ajax({
                        url: `/admin/customers/${customerId}/get`,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        success: function (response) {
                            SweetAlertHelper.close(); // Close loading alert

                            if (response.status === 'success') {
                                const customer = response.customer;
                                $('#editCustomerId').val(customer.id);
                                $('#editCustomerFirstName').val(customer.first_name);
                                $('#editCustomerLastName').val(customer.last_name);
                                $('#editCustomerEmail').val(customer.email);
                                $('#editCustomerPhone').val(customer.phone || '');
                                $('#editCustomerCountry').val(customer.country || '');
                                $('#editCustomerCity').val(customer.city || '');
                                $('#editCustomerState').val(customer.state || '');
                                $('#editCustomerPostalCode').val(customer.postal_code || '');
                                $('#editCustomerAddress').val(customer.address || '');
                                $('#editCustomerGender').val(customer.gender || '');
                                $('#editCustomerDob').val(customer.dob || '');
                            } else {
                                SweetAlertHelper.error(
                                    response.message || 'Failed to load customer data.',
                                    'Load Failed!'
                                );
                            }
                        },
                        error: function (xhr) {
                            SweetAlertHelper.close(); // Close loading alert
                            SweetAlertHelper.error(
                                'Failed to load customer data. Please try again.',
                                'Load Failed!'
                            );
                        }
                    });
                }
            });

            // ========================
            // Edit Customer Form Submit
            // ========================
            $('#editCustomerForm').on('submit', function (e) {
                e.preventDefault();
                const customerId = $('#editCustomerId').val();
                const formData = new FormData(this);
                const submitBtn = $('#editCustomerBtn');
                clearAllErrors();
                setLoadingState(submitBtn, true);

                $.ajax({
                    url: `/admin/customers/${customerId}/update`,
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        setLoadingState(submitBtn, false);

                        if (response.status === 'success') {
                            $('#editCustomerModal').modal('hide');
                            SweetAlertHelper.successAutoClose(
                                response.message || 'Customer updated successfully!',
                                'Success!'
                            ).then(() => {
                                setTimeout(() => location.reload(), 1200);
                            });
                        } else if (response.status === 'error') {
                            showFormErrors(response.errors, 'edit');
                            if (response.message) {
                                SweetAlertHelper.error(
                                    response.message,
                                    'Validation Error!'
                                );
                            }
                        }
                    },
                    error: function (xhr) {
                        setLoadingState(submitBtn, false);
                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            showFormErrors(errors, 'edit');
                        } else {
                            SweetAlertHelper.error(
                                'An error occurred while updating the customer.',
                                'Operation Failed!'
                            );
                        }
                    }
                });
            });

            // ========================
            // Toggle Customer Status
            // ========================
            $(document).on('click', '.status-toggle', function () {
                const customerId = $(this).data('id');
                const statusBadge = $(this);
                SweetAlertHelper.confirm(
                    'Are you sure you want to change the customer status?',
                    'Change Status?',
                    () => {
                        const loadingAlert = SweetAlertHelper.loading('Updating status...');

                        $.ajax({
                            url: `/admin/customers/${customerId}/toggle-status`,
                            method: 'PUT',
                            headers: {'X-CSRF-TOKEN': csrfToken},
                            success: function (response) {
                                SweetAlertHelper.close(); // Close loading alert

                                if (response.status === 'success') {
                                    const isActive = response.is_active;
                                    statusBadge.toggleClass('active inactive');
                                    statusBadge.text(isActive ? 'Active' : 'Inactive');
                                    SweetAlertHelper.successAutoClose(
                                        response.message || 'Status updated successfully!',
                                        'Success!'
                                    );
                                } else {
                                    SweetAlertHelper.error(
                                        response.message || 'Failed to update status.',
                                        'Update Failed!'
                                    );
                                }
                            },
                            error: function (xhr) {
                                SweetAlertHelper.close(); // Close loading alert
                                SweetAlertHelper.error(
                                    'Failed to update customer status. Please try again.',
                                    'Update Failed!'
                                );
                            }
                        });
                    }
                );
            });

            // ========================
            // Delete Customer
            // ========================
            $(document).on('click', '.delete-customer', function () {
                const customerId = $(this).data('id');
                const customerName = $(this).data('name');

                SweetAlertHelper.confirm(
                    `Are you sure you want to delete "${customerName}"? This action cannot be undone.`,
                    'Delete Customer?',
                    () => {
                        const loadingAlert = SweetAlertHelper.loading('Deleting customer...');
                        $.ajax({
                            url: `/admin/customers/${customerId}/delete`,
                            method: 'DELETE',
                            headers: {'X-CSRF-TOKEN': csrfToken},
                            success: function (response) {
                                SweetAlertHelper.close(); // Close loading alert
                                if (response.status === 'success') {
                                    SweetAlertHelper.successAutoClose(
                                        response.message || 'Customer deleted successfully!',
                                        'Deleted!'
                                    );
                                    setTimeout(() => location.reload(), 1200);
                                } else {
                                    SweetAlertHelper.error(
                                        response.message || 'Failed to delete customer.',
                                        'Delete Failed!'
                                    );
                                }
                            },
                            error: function (xhr) {
                                SweetAlertHelper.close(); // Close loading alert
                                SweetAlertHelper.error(
                                    'Failed to delete customer. Please try again.',
                                    'Delete Failed!'
                                );
                            }
                        });
                    },
                    {
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        icon: 'warning'
                    }
                );
            });

            // Initialize filter button texts
            updateFilterButtonTexts();

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("admin.layout.main", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views/admin/customers/index.blade.php ENDPATH**/ ?>