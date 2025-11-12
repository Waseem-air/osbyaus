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
                                        <div class="image">
                                            <img src="{{ asset($category->image ?? 'assets/images/default-category.jpg') }}"
                                                 alt="{{ $category->name }}" width="60" height="60" style="object-fit: cover; border-radius: 8px;">
                                        </div>
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

            /**
             * Show SweetAlert2 alerts
             * @param {string} message - Alert message
             * @param {string} type - success | error | warning | info
             */
            function showAlert(message, type = 'success') {
                Swal.fire({
                    icon: type,
                    title: message,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            }

            /**
             * Display validation errors in form fields
             * @param {object} errors - validation errors
             * @param {string} prefix - optional prefix for edit forms
             */
            function displayErrors(errors, prefix = '') {
                $('.error-message').text('');
                $('.form-group').removeClass('has-error');

                if (errors && typeof errors === 'object') {
                    $.each(errors, function(key, errorArray) {
                        const errorElement = $(`#${prefix}${key.charAt(0).toUpperCase() + key.slice(1)}Error`);
                        const formGroup = errorElement.closest('.form-group');

                        if (errorElement.length && errorArray.length > 0) {
                            errorElement.text(errorArray[0]);
                            formGroup.addClass('has-error');
                        }

                        // Also show global alert for first error
                        if (errorArray.length > 0 && prefix === '') {
                            showAlert(errorArray[0], 'error');
                        }
                    });
                }
            }

            // ========================
            // Add Category Form Submit
            // ========================
            $('#addCategoryForm').on('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const btn = $('#addCategoryBtn');
                const spinner = btn.find('.spinner');

                btn.addClass('btn-loading').prop('disabled', true);
                spinner.removeClass('d-none');

                $.ajax({
                    url: '{{ route("admin.category.store") }}',
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#addCategoryModal').modal('hide');
                            showAlert(data.message, 'success');
                            setTimeout(() => location.reload(), 1200);
                        } else if (data.status === 'error') {
                            displayErrors(data.errors);
                            if (data.message) showAlert(data.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors;
                        if (errors) displayErrors(errors);
                        else showAlert('An error occurred while adding the category.', 'error');
                    },
                    complete: function() {
                        btn.removeClass('btn-loading').prop('disabled', false);
                        spinner.addClass('d-none');
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

                    $.ajax({
                        url: `/admin/categories/${categoryId}/get`,
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                        success: function(data) {
                            if (data.status === 'success') {
                                const cat = data.category;
                                $('#editCategoryId').val(cat.id);
                                $('#editCategoryName').val(cat.name);
                                $('#editCategoryDescription').val(cat.description || '');
                            }
                        },
                        error: function() {
                            showAlert('Failed to load category data.', 'error');
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
                const btn = $('#editCategoryBtn');
                const spinner = btn.find('.spinner');

                btn.addClass('btn-loading').prop('disabled', true);
                spinner.removeClass('d-none');

                $.ajax({
                    url: `/admin/categories/${categoryId}/update`,
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#editCategoryModal').modal('hide');
                            showAlert(data.message, 'success');
                            setTimeout(() => location.reload(), 1200);
                        } else if (data.status === 'error') {
                            displayErrors(data.errors, 'edit');
                            if (data.message) showAlert(data.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON?.errors;
                        if (errors) displayErrors(errors, 'edit');
                        else showAlert('An error occurred while updating the category.', 'error');
                    },
                    complete: function() {
                        btn.removeClass('btn-loading').prop('disabled', false);
                        spinner.addClass('d-none');
                    }
                });
            });

            // ========================
            // Delete Category
            // ========================
            $(document).on('click', '.delete-category', function() {
                const categoryId = $(this).data('id');
                const categoryName = $(this).data('name');

                Swal.fire({
                    title: 'Delete Category?',
                    text: `Are you sure you want to delete "${categoryName}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/admin/categories/${categoryId}/delete`,
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken },
                            success: function(data) {
                                if (data.status === 'success') {
                                    showAlert(data.message, 'success');
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
                                    showAlert(data.message || 'Failed to delete category.', 'error');
                                }
                            },
                            error: function() {
                                showAlert('Failed to delete category.', 'error');
                            }
                        });
                    }
                });
            });

            // ========================
            // Reset forms when modals close
            // ========================
            $('#addCategoryModal').on('hidden.bs.modal', function() {
                $('#addCategoryForm')[0].reset();
                $('#addCategoryImagePreview').removeClass('show');
            });

            $('#editCategoryModal').on('hidden.bs.modal', function() {
                $('#editCategoryForm')[0].reset();
            });

        });
    </script>

@endpush
