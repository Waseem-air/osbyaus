@extends("admin.layout.main")
@section('styles')
    <style>
        .size-badge {
            display: inline-block;
            padding: 6px 12px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            font-weight: 500;
            color: #495057;
        }

        .wg-table.table-all-sizes .wg-product > *:nth-child(1),
        .wg-table.table-all-sizes ul.table-title > *:nth-child(1) {
            width: 200px;
            flex-shrink: 0;
        }

        .wg-table.table-all-sizes .wg-product > *:nth-child(2),
        .wg-table.table-all-sizes ul.table-title > *:nth-child(2) {
            width: 120px;
            flex-shrink: 0;
        }

        @media (min-width: 768px) and (max-width: 1199px) {
            .wg-table.table-all-sizes > ul,
            .wg-table.table-all-sizes > div {
                min-width: 100% !important;
                width: 100% !important;
            }
        }

        .status-toggle {
            cursor: pointer;
        }

        .status-toggle .form-check-input {
            cursor: pointer;
            width: 3em;
            height: 1.5em;
        }

        .status-toggle .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }
    </style>
@endsection

@section('content')
    <!-- main-content -->
    <div class="main-content">

        <!-- Add Size Modal -->
        @include('admin.sizes.addSizeModal')
        <!-- Edit Size Modal -->
        @include('admin.sizes.editSizeModal')

        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Size Management</h3>
                    <div class="flex items-center gap20">
                        <span class="body-text">Total Sizes: {{ $sizes->count() }}</span>
                    </div>
                </div>

                <!-- Search and Filter Bar -->
                <div class="search-bar-container mb-2">
                    <!-- Search Form -->
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search sizes..." name="search" required>
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

                    <!-- Add New Button -->
                    <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addSizeModal">
                        <i class="icon-plus"></i> Add New Size
                    </button>
                </div>

                <!-- Sizes List -->
                <div class="wg-box mt-5">
                    <div class="wg-table table-all-sizes">
                        <ul class="table-title flex gap20 mb-14">
                            <li><div class="body-title">Size Name</div></li>
                            <li><div class="body-title">Short Code</div></li>
                            <li><div class="body-title">Status</div></li>
                            <li><div class="body-title">Created</div></li>
                            <li><div class="body-title">Actions</div></li>
                        </ul>

                        <div class="flex flex-column" id="sizesList">
                            @foreach($sizes as $size)
                                <div class="wg-product item-row gap20" id="size-{{ $size->id }}">
                                    <div class="name">
                                        <div class="title line-clamp-2 mb-0">
                                            <a href="#" class="body-text fw-bold">{{ $size->name }}</a>
                                        </div>
                                    </div>

                                    <div class="body-text">
                                        <span class="size-badge">{{ $size->short_code }}</span>
                                    </div>

                                    <div class="body-text status-toggle">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-status"
                                                   type="checkbox"
                                                   data-id="{{ $size->id }}"
                                                {{ $size->is_active ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <div class="body-text text-main-dark">{{ $size->created_at->format('M d, Y') }}</div>

                                    <div class="item-actions">
                                        <!-- Edit -->
                                        <a href="javascript:void(0)" class="edit-size"
                                           data-id="{{ $size->id }}"
                                           data-bs-toggle="modal"
                                           data-bs-target="#editSizeModal"
                                           title="Edit Size">
                                            <i class="icon-edit"></i>
                                        </a>

                                        <!-- Delete -->
                                        <a href="javascript:void(0)" class="delete-size"
                                           data-id="{{ $size->id }}"
                                           data-name="{{ $size->name }}"
                                           title="Delete Size">
                                            <i class="icon-trash-2"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                            @if($sizes->isEmpty())
                                <div class="text-center py-5">
                                    <div class="body-text text-muted mb-3">No sizes found</div>
                                    <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addSizeModal">
                                        <i class="icon-plus"></i> Add First Size
                                    </button>
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
            // Add Size Form Submit
            // ========================
            $('#addSizeForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const formData = new FormData(this);
                const submitBtn = $('#addSizeBtn');

                clearAllErrors();
                setLoadingState(submitBtn, true);

                $.ajax({
                    url: '{{ route("admin.size.store") }}',
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        setLoadingState(submitBtn, false);

                        if (response.status === 'success') {
                            $('#addSizeModal').modal('hide');

                            SweetAlertHelper.successAutoClose(
                                response.message || 'Size added successfully!',
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
                                'An error occurred while adding the size.',
                                'Operation Failed!'
                            );
                        }
                    }
                });
            });

            // ========================
            // Edit Size - Load Data
            // ========================
            $('#editSizeModal').on('show.bs.modal', function(event) {
                const btn = $(event.relatedTarget);
                if (btn.hasClass('edit-size')) {
                    const sizeId = btn.data('id');

                    // Show loading state
                    const loadingAlert = SweetAlertHelper.loading('Loading size data...');

                    $.ajax({
                        url: `/admin/sizes/${sizeId}/get`,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            SweetAlertHelper.close(); // Close loading alert

                            if (response.status === 'success') {
                                const size = response.size;
                                $('#editSizeId').val(size.id);
                                $('#editSizeName').val(size.name);
                                $('#editSizeShortCode').val(size.short_code);
                            } else {
                                SweetAlertHelper.error(
                                    response.message || 'Failed to load size data.',
                                    'Load Failed!'
                                );
                            }
                        },
                        error: function(xhr) {
                            SweetAlertHelper.close(); // Close loading alert
                            SweetAlertHelper.error(
                                'Failed to load size data. Please try again.',
                                'Load Failed!'
                            );
                        }
                    });
                }
            });

            // ========================
            // Edit Size Form Submit
            // ========================
            $('#editSizeForm').on('submit', function(e) {
                e.preventDefault();
                const sizeId = $('#editSizeId').val();
                const formData = new FormData(this);
                const submitBtn = $('#editSizeBtn');

                clearAllErrors();
                setLoadingState(submitBtn, true);

                $.ajax({
                    url: `/admin/sizes/${sizeId}/update`,
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        setLoadingState(submitBtn, false);

                        if (response.status === 'success') {
                            $('#editSizeModal').modal('hide');

                            SweetAlertHelper.successAutoClose(
                                response.message || 'Size updated successfully!',
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
                                'An error occurred while updating the size.',
                                'Operation Failed!'
                            );
                        }
                    }
                });
            });

            // ========================
            // Toggle Size Status
            // ========================
            $(document).on('change', '.toggle-status', function() {
                const sizeId = $(this).data('id');
                const isChecked = $(this).is(':checked');

                $.ajax({
                    url: `/admin/sizes/${sizeId}/toggle-status`,
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    success: function(response) {
                        if (response.status === 'success') {
                            SweetAlertHelper.successAutoClose(
                                response.message || 'Size status updated successfully!',
                                'Success!'
                            );
                        } else {
                            SweetAlertHelper.error(
                                response.message || 'Failed to update size status.',
                                'Update Failed!'
                            );
                            // Revert the toggle
                            $(`.toggle-status[data-id="${sizeId}"]`).prop('checked', !isChecked);
                        }
                    },
                    error: function(xhr) {
                        SweetAlertHelper.error(
                            'Failed to update size status. Please try again.',
                            'Update Failed!'
                        );
                        // Revert the toggle
                        $(`.toggle-status[data-id="${sizeId}"]`).prop('checked', !isChecked);
                    }
                });
            });

            // ========================
            // Delete Size
            // ========================
            $(document).on('click', '.delete-size', function() {
                const sizeId = $(this).data('id');
                const sizeName = $(this).data('name');

                SweetAlertHelper.confirm(
                    `Are you sure you want to delete "${sizeName}"? This action cannot be undone.`,
                    'Delete Size?',
                    () => {
                        // This callback runs when user confirms
                        const loadingAlert = SweetAlertHelper.loading('Deleting size...');

                        $.ajax({
                            url: `/admin/sizes/${sizeId}/delete`,
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken },
                            success: function(response) {
                                SweetAlertHelper.close(); // Close loading alert

                                if (response.status === 'success') {
                                    SweetAlertHelper.successAutoClose(
                                        response.message || 'Size deleted successfully!',
                                        'Deleted!'
                                    );

                                    $('#size-' + sizeId).fadeOut(300, function() {
                                        $(this).remove();
                                        if ($('#sizesList .wg-product').length === 0) {
                                            $('#sizesList').html(`
                                        <div class="text-center py-5">
                                            <div class="body-text text-muted mb-3">No sizes found</div>
                                            <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addSizeModal">
                                                <i class="icon-plus"></i> Add First Size
                                            </button>
                                        </div>
                                    `);
                                        }
                                    });
                                } else {
                                    SweetAlertHelper.error(
                                        response.message || 'Failed to delete size.',
                                        'Delete Failed!'
                                    );
                                }
                            },
                            error: function(xhr) {
                                SweetAlertHelper.close(); // Close loading alert
                                SweetAlertHelper.error(
                                    'Failed to delete size. Please try again.',
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
            // Form Event Handlers
            // ========================

            // Clear errors on input
            $('.tf-field-input').on('input', function() {
                clearFieldError($(this));
            });

            // Reset forms when modals close
            $('#addSizeModal').on('hidden.bs.modal', function() {
                $('#addSizeForm')[0].reset();
                clearAllErrors();
            });

            $('#editSizeModal').on('hidden.bs.modal', function() {
                $('#editSizeForm')[0].reset();
                clearAllErrors();
            });

        });
    </script>
@endpush
