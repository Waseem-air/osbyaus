@extends("admin.layout.main")
@section('styles')
        <style>
            .wg-table.table-all-category .wg-product > *:nth-child(1), .wg-table.table-all-category ul.table-title > *:nth-child(1) {
                width: 281px;
                flex-shrink: 0;
            }
            @media (min-width: 768px) and (max-width: 1199px) {
                .wg-table.table-all-category > ul,
                .wg-table.table-all-category > div {
                    min-width: 100% !important;
                    width: 100% !important;
                }
            }

            /* Alert Styles */
            .alert-container {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
            }

            .alert {
                border-radius: 8px;
                padding: 15px;
                margin-bottom: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                display: flex;
                justify-content: between;
                align-items: center;
            }

            .alert-success {
                background: #d4edda;
                border: 1px solid #c3e6cb;
                color: #155724;
            }

            .alert-error {
                background: #f8d7da;
                border: 1px solid #f5c6cb;
                color: #721c24;
            }

            .alert-warning {
                background: #fff3cd;
                border: 1px solid #ffeaa7;
                color: #856404;
            }

            .d-none {
                display: none !important;
            }

            /* Loading States */
            .btn-loading {
                opacity: 0.6;
                pointer-events: none;
            }

            .btn-loading .spinner {
                display: inline-block;
                width: 16px;
                height: 16px;
                border: 2px solid transparent;
                border-top: 2px solid currentColor;
                border-radius: 50%;
                animation: spin 1s linear infinite;
                margin-right: 8px;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .flex {
                display: flex;
            }

            .justify-between {
                justify-content: space-between;
            }

            .justify-end {
                justify-content: flex-end;
            }

            .items-center {
                align-items: center;
            }

            .gap20 {
                gap: 20px;
            }

            .mb-20 {
                margin-bottom: 20px;
            }

            .mb-30 {
                margin-bottom: 30px;
            }

            .mt-30 {
                margin-top: 30px;
            }

            /* Custom modal styling */
            .modal-header {
                border-bottom: 1px solid #e9ecef;
                padding: 1.5rem;
            }

            .modal-footer {
                border-top: 1px solid #e9ecef;
                padding: 1.5rem;
            }

            .modal-body {
                padding: 1.5rem;
            }
        </style>

@endsection

@section('content')
    <!-- main-content -->
    <div class="main-content">
        <!-- Alert Container -->
        <!-- Add Category Modal -->
        @include('admin.categories.addCategoryModal')
        <!-- Edit Category Modal -->
        @include('admin.categories.editCategoryModal')

        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Category Management</h3>
                    <div class="flex items-center gap20">
                        <span class="body-text">Total Categories: {{ $categories->count() }}</span>
                    </div>
                </div>

                <!-- Search and Filter Bar -->
                <div class="search-bar-container mb-2">
                    <!-- Search Form -->
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search categories..." name="search" required>
                            <button type="submit" class="search-icon">
                                <i class="icon-search"></i>
                            </button>
                        </fieldset>
                    </form>

                    <!-- Status Filter -->
                    <div class="dropdown">
                        <button class="tf-button style-2 w150">
                            Status <i class="icon-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#">Active</a>
                            <a href="#">Inactive</a>
                            <a href="#">All</a>
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="dropdown">
                        <button class="tf-button style-2 w150">
                            Sort By <i class="icon-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#">Newest First</a>
                            <a href="#">Oldest First</a>
                            <a href="#">A-Z</a>
                            <a href="#">Z-A</a>
                        </div>
                    </div>

                    <!-- Add New Button -->
                    <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="icon-plus"></i> Add New Category
                    </button>
                </div>

                <!-- Categories List -->
                <div class="wg-box mt-5">
                    <div class="wg-table table-all-category">
                        <ul class="table-title flex gap20 mb-14">
                            <li><div class="body-title">Category</div></li>
                            <li><div class="body-title">Slug</div></li>
                            <li><div class="body-title">Status</div></li>
                            <li><div class="body-title">Created</div></li>
                            <li><div class="body-title">Actions</div></li>
                        </ul>

                        <div class="flex flex-column" id="categoriesList">
                            @foreach($categories as $category)
                                <div class="wg-product item-row gap20" id="category-{{ $category->id }}">
                                    <div class="name">
                                        @isset($category->image)
                                        <div class="image">
                                            <img src="{{ asset($category->image ?? 'assets/images/default-category.jpg') }}"
                                                 alt="{{ $category->name }}" width="60" height="60" style="object-fit: cover; border-radius: 8px;">
                                        </div>
                                        @endisset
                                        <div class="title line-clamp-2 mb-0">
                                            <a href="#" class="body-text fw-bold">{{ $category->name }}</a>
                                            @if($category->description)
                                                <div class="body-text text-muted mt-1 line-clamp-1">
                                                    {{ Str::limit($category->description, 50) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="body-text text-main-dark">{{ $category->slug }}</div>

                                    <div class="body-text">
                                    <span class="status-badge {{ $category->is_active ? 'active' : 'inactive' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    </div>

                                    <div class="body-text text-main-dark">{{ $category->created_at->format('M d, Y') }}</div>

                                    <div class="item-actions">
                                        <!-- Edit -->
                                        <a href="javascript:void(0)" class="edit-category"
                                           data-id="{{ $category->id }}"
                                           data-bs-toggle="modal"
                                           data-bs-target="#editCategoryModal"
                                           title="Edit Category">
                                            <i class="icon-edit"></i>
                                        </a>

                                        <!-- Delete -->
                                        <a href="javascript:void(0)" class="delete-category"
                                           data-id="{{ $category->id }}"
                                           data-name="{{ $category->name }}"
                                           title="Delete Category">
                                            <i class="icon-trash-2"></i>
                                        </a>

                                        <!-- View -->
                                        <a href="{{ route('admin.category.show', $category->id) }}" title="View Category">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                            @if($categories->isEmpty())
                                <div class="text-center py-5">
                                    <div class="body-text text-muted mb-3">No categories found</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.components.footer')
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content') || '';

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
                $.each(errors, function(key, errorArray) {
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
            // Add Category Form Submit
            // ========================
            $('#addCategoryForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const formData = new FormData(this);
                const submitBtn = $('#addCategoryBtn');

                clearAllErrors();
                setLoadingState(submitBtn, true);

                $.ajax({
                    url: '{{ route("admin.category.store") }}',
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        setLoadingState(submitBtn, false);

                        if (response.status === 'success') {
                            $('#addCategoryModal').modal('hide');

                            SweetAlertHelper.successAutoClose(
                                response.message || 'Category added successfully!',
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
                    error: function(xhr) {
                        setLoadingState(submitBtn, false);

                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            showFormErrors(errors);
                        } else {
                            SweetAlertHelper.error(
                                'An error occurred while adding the category.',
                                'Operation Failed!'
                            );
                        }
                    }
                });
            });

            // ========================
            // Edit Category - Load Data
            // ========================
            $('#editCategoryModal').on('show.bs.modal', function(event) {
                const btn = $(event.relatedTarget);
                if (btn.hasClass('edit-category')) {
                    const categoryId = btn.data('id');

                    // Show loading state
                    const loadingAlert = SweetAlertHelper.loading('Loading category data...');

                    $.ajax({
                        url: `/admin/categories/${categoryId}/get`,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            SweetAlertHelper.close(); // Close loading alert

                            if (response.status === 'success') {
                                const cat = response.category;
                                $('#editCategoryId').val(cat.id);
                                $('#editCategoryName').val(cat.name);
                                $('#editCategoryDescription').val(cat.description || '');
                            } else {
                                SweetAlertHelper.error(
                                    response.message || 'Failed to load category data.',
                                    'Load Failed!'
                                );
                            }
                        },
                        error: function(xhr) {
                            SweetAlertHelper.close(); // Close loading alert
                            SweetAlertHelper.error(
                                'Failed to load category data. Please try again.',
                                'Load Failed!'
                            );
                        }
                    });
                }
            });

            // ========================
            // Edit Category Form Submit
            // ========================
            $('#editCategoryForm').on('submit', function(e) {
                e.preventDefault();
                const categoryId = $('#editCategoryId').val();
                const formData = new FormData(this);
                const submitBtn = $('#editCategoryBtn');

                clearAllErrors();
                setLoadingState(submitBtn, true);

                $.ajax({
                    url: `/admin/categories/${categoryId}/update`,
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        setLoadingState(submitBtn, false);

                        if (response.status === 'success') {
                            $('#editCategoryModal').modal('hide');

                            SweetAlertHelper.successAutoClose(
                                response.message || 'Category updated successfully!',
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
                    error: function(xhr) {
                        setLoadingState(submitBtn, false);

                        const errors = xhr.responseJSON?.errors;
                        if (errors) {
                            showFormErrors(errors, 'edit');
                        } else {
                            SweetAlertHelper.error(
                                'An error occurred while updating the category.',
                                'Operation Failed!'
                            );
                        }
                    }
                });
            });

            // ========================
            // Delete Category
            // ========================
            $(document).on('click', '.delete-category', function() {
                const categoryId = $(this).data('id');
                const categoryName = $(this).data('name');

                SweetAlertHelper.confirm(
                    `Are you sure you want to delete "${categoryName}"? This action cannot be undone.`,
                    'Delete Category?',
                    () => {
                        // This callback runs when user confirms
                        const loadingAlert = SweetAlertHelper.loading('Deleting category...');

                        $.ajax({
                            url: `/admin/categories/${categoryId}/delete`,
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken },
                            success: function(response) {
                                SweetAlertHelper.close(); // Close loading alert

                                if (response.status === 'success') {
                                    SweetAlertHelper.successAutoClose(
                                        response.message || 'Category deleted successfully!',
                                        'Deleted!'
                                    );

                                    $('#category-' + categoryId).fadeOut(300, function() {
                                        $(this).remove();
                                        if ($('#categoriesList .wg-product').length === 0) {
                                            $('#categoriesList').html(`
                                            <div class="text-center py-5">
                                                <div class="body-text text-muted mb-3">No categories found</div>
                                                <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                                    <i class="icon-plus"></i> Add First Category
                                                </button>
                                            </div>
                                        `);
                                        }
                                    });
                                } else {
                                    SweetAlertHelper.error(
                                        response.message || 'Failed to delete category.',
                                        'Delete Failed!'
                                    );
                                }
                            },
                            error: function(xhr) {
                                SweetAlertHelper.close(); // Close loading alert
                                SweetAlertHelper.error(
                                    'Failed to delete category. Please try again.',
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

            // ========================
            // Bulk Actions with SweetAlertHelper
            // ========================
            $('#bulkActionBtn').on('click', function() {
                const selectedIds = $('input[name="selected_categories[]"]:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length === 0) {
                    SweetAlertHelper.warning(
                        'Please select at least one category to perform bulk actions.',
                        'No Selection!'
                    );
                    return;
                }

                SweetAlertHelper.html(
                    `
                <div class="text-left">
                    <p>You have selected <strong>${selectedIds.length}</strong> categories.</p>
                    <div class="form-group mt-3">
                        <label for="bulkAction" class="form-label">Choose Action:</label>
                        <select class="form-select" id="bulkAction">
                            <option value="delete">Delete Selected</option>
                            <option value="activate">Activate Selected</option>
                            <option value="deactivate">Deactivate Selected</option>
                        </select>
                    </div>
                </div>
                `,
                    'Bulk Actions',
                    'info'
                ).then((result) => {
                    if (result.isConfirmed) {
                        const action = $('#bulkAction').val();
                        // Handle bulk action here
                    }
                });
            });

            // ========================
            // Form Event Handlers
            // ========================

            // Clear errors on input
            $('.tf-field-input').on('input', function() {
                clearFieldError($(this));
            });

            // Reset forms when modals close
            $('#addCategoryModal').on('hidden.bs.modal', function() {
                $('#addCategoryForm')[0].reset();
                $('#addCategoryImagePreview').removeClass('show');
                clearAllErrors();
            });

            $('#editCategoryModal').on('hidden.bs.modal', function() {
                $('#editCategoryForm')[0].reset();
                clearAllErrors();
            });

            // Show info when no image is selected
            $('#addCategoryImage').on('change', function() {
                if (!this.files.length) {
                    SweetAlertHelper.info(
                        'No image selected. A default image will be used.',
                        'Image Info'
                    );
                }
            });

        });
    </script>
@endpush
