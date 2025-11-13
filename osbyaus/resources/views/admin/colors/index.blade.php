@extends("admin.layout.main")
@section('styles')
    <style>
        .color-preview {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 2px solid #e9ecef;
            display: inline-block;
            vertical-align: middle;
        }

        .wg-table.table-all-colors .wg-product > *:nth-child(1),
        .wg-table.table-all-colors ul.table-title > *:nth-child(1) {
            width: 200px;
            flex-shrink: 0;
        }

        .wg-table.table-all-colors .wg-product > *:nth-child(2),
        .wg-table.table-all-colors ul.table-title > *:nth-child(2) {
            width: 120px;
            flex-shrink: 0;
        }

        @media (min-width: 768px) and (max-width: 1199px) {
            .wg-table.table-all-colors > ul,
            .wg-table.table-all-colors > div {
                min-width: 100% !important;
                width: 100% !important;
            }
        }

        .status-toggle {
            cursor: pointer;
        }

        .status-toggle .form-check-input {
            cursor: pointer;
        }

        /* Color Management Styles */
        .color-preview {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 2px solid #e9ecef;
            display: inline-block;
            vertical-align: middle;
            transition: transform 0.2s ease;
        }

        .color-preview:hover {
            transform: scale(1.1);
        }

        .form-control-color {
            width: 60px;
            height: 38px;
            padding: 2px;
        }

        .input-group .form-control-color {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        /* Status toggle styles */
        .status-toggle .form-check-input {
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

        <!-- Add Color Modal -->
        @include('admin.colors.addColorModal')
        <!-- Edit Color Modal -->
        @include('admin.colors.editColorModal')

        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Color Management</h3>
                    <div class="flex items-center gap20">
                        <span class="body-text">Total Colors: {{ $colors->count() }}</span>
                    </div>
                </div>

                <!-- Search and Filter Bar -->
                <div class="search-bar-container mb-2">
                    <!-- Search Form -->
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search colors..." name="search" required>
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
                    <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addColorModal">
                        <i class="icon-plus"></i> Add New Color
                    </button>
                </div>

                <!-- Colors List -->
                <div class="wg-box mt-5">
                    <div class="wg-table table-all-colors">
                        <ul class="table-title flex gap20 mb-14">
                            <li><div class="body-title">Color Name</div></li>
                            <li><div class="body-title">Hex Code</div></li>
                            <li><div class="body-title">Preview</div></li>
                            <li><div class="body-title">Status</div></li>
                            <li><div class="body-title">Created</div></li>
                            <li><div class="body-title">Actions</div></li>
                        </ul>

                        <div class="flex flex-column" id="colorsList">
                            @foreach($colors as $color)
                                <div class="wg-product item-row gap20" id="color-{{ $color->id }}">
                                    <div class="name">
                                        <div class="title line-clamp-2 mb-0">
                                            <a href="#" class="body-text fw-bold">{{ $color->name }}</a>
                                        </div>
                                    </div>

                                    <div class="body-text text-main-dark">{{ $color->hex_code }}</div>

                                    <div class="body-text">
                                        <span class="color-preview" style="background-color: {{ $color->hex_code }};" title="{{ $color->hex_code }}"></span>
                                    </div>

                                    <div class="body-text status-toggle">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-status"
                                                   type="checkbox"
                                                   data-id="{{ $color->id }}"
                                                {{ $color->is_active ? 'checked' : '' }}>
                                        </div>
                                    </div>

                                    <div class="body-text text-main-dark">{{ $color->created_at->format('M d, Y') }}</div>

                                    <div class="item-actions">
                                        <!-- Edit -->
                                        <a href="javascript:void(0)" class="edit-color"
                                           data-id="{{ $color->id }}"
                                           data-bs-toggle="modal"
                                           data-bs-target="#editColorModal"
                                           title="Edit Color">
                                            <i class="icon-edit"></i>
                                        </a>

                                        <!-- Delete -->
                                        <a href="javascript:void(0)" class="delete-color"
                                           data-id="{{ $color->id }}"
                                           data-name="{{ $color->name }}"
                                           title="Delete Color">
                                            <i class="icon-trash-2"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                            @if($colors->isEmpty())
                                <div class="text-center py-5">
                                    <div class="body-text text-muted mb-3">No colors found</div>
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
            // Add Color Form Submit
            // ========================
            $('#addColorForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const formData = new FormData(this);
                const submitBtn = $('#addColorBtn');

                clearAllErrors();
                setLoadingState(submitBtn, true);

                $.ajax({
                    url: '{{ route("admin.color.store") }}',
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        setLoadingState(submitBtn, false);

                        if (response.status === 'success') {
                            $('#addColorModal').modal('hide');

                            SweetAlertHelper.successAutoClose(
                                response.message || 'Color added successfully!',
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
                                'An error occurred while adding the color.',
                                'Operation Failed!'
                            );
                        }
                    }
                });
            });

            // ========================
            // Edit Color - Load Data
            // ========================
            $('#editColorModal').on('show.bs.modal', function(event) {
                const btn = $(event.relatedTarget);
                if (btn.hasClass('edit-color')) {
                    const colorId = btn.data('id');

                    // Show loading state
                    const loadingAlert = SweetAlertHelper.loading('Loading color data...');

                    $.ajax({
                        url: `/admin/colors/${colorId}/get`,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            SweetAlertHelper.close(); // Close loading alert

                            if (response.status === 'success') {
                                const color = response.color;
                                $('#editColorId').val(color.id);
                                $('#editColorName').val(color.name);
                                $('#editColorHexCode').val(color.hex_code);
                            } else {
                                SweetAlertHelper.error(
                                    response.message || 'Failed to load color data.',
                                    'Load Failed!'
                                );
                            }
                        },
                        error: function(xhr) {
                            SweetAlertHelper.close(); // Close loading alert
                            SweetAlertHelper.error(
                                'Failed to load color data. Please try again.',
                                'Load Failed!'
                            );
                        }
                    });
                }
            });

            // ========================
            // Edit Color Form Submit
            // ========================
            $('#editColorForm').on('submit', function(e) {
                e.preventDefault();
                const colorId = $('#editColorId').val();
                const formData = new FormData(this);
                const submitBtn = $('#editColorBtn');

                clearAllErrors();
                setLoadingState(submitBtn, true);

                $.ajax({
                    url: `/admin/colors/${colorId}/update`,
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        setLoadingState(submitBtn, false);

                        if (response.status === 'success') {
                            $('#editColorModal').modal('hide');

                            SweetAlertHelper.successAutoClose(
                                response.message || 'Color updated successfully!',
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
                                'An error occurred while updating the color.',
                                'Operation Failed!'
                            );
                        }
                    }
                });
            });

            // ========================
            // Toggle Color Status
            // ========================
            $(document).on('change', '.toggle-status', function() {
                const colorId = $(this).data('id');
                const isChecked = $(this).is(':checked');

                $.ajax({
                    url: `/admin/colors/${colorId}/toggle-status`,
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    success: function(response) {
                        if (response.status === 'success') {
                            SweetAlertHelper.successAutoClose(
                                response.message || 'Color status updated successfully!',
                                'Success!'
                            );
                        } else {
                            SweetAlertHelper.error(
                                response.message || 'Failed to update color status.',
                                'Update Failed!'
                            );
                            // Revert the toggle
                            $(`.toggle-status[data-id="${colorId}"]`).prop('checked', !isChecked);
                        }
                    },
                    error: function(xhr) {
                        SweetAlertHelper.error(
                            'Failed to update color status. Please try again.',
                            'Update Failed!'
                        );
                        // Revert the toggle
                        $(`.toggle-status[data-id="${colorId}"]`).prop('checked', !isChecked);
                    }
                });
            });

            // ========================
            // Delete Color
            // ========================
            $(document).on('click', '.delete-color', function() {
                const colorId = $(this).data('id');
                const colorName = $(this).data('name');

                SweetAlertHelper.confirm(
                    `Are you sure you want to delete "${colorName}"? This action cannot be undone.`,
                    'Delete Color?',
                    () => {
                        // This callback runs when user confirms
                        const loadingAlert = SweetAlertHelper.loading('Deleting color...');

                        $.ajax({
                            url: `/admin/colors/${colorId}/delete`,
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken },
                            success: function(response) {
                                SweetAlertHelper.close(); // Close loading alert

                                if (response.status === 'success') {
                                    SweetAlertHelper.successAutoClose(
                                        response.message || 'Color deleted successfully!',
                                        'Deleted!'
                                    );

                                    $('#color-' + colorId).fadeOut(300, function() {
                                        $(this).remove();
                                        if ($('#colorsList .wg-product').length === 0) {
                                            $('#colorsList').html(`
                                        <div class="text-center py-5">
                                            <div class="body-text text-muted mb-3">No colors found</div>
                                            <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addColorModal">
                                                <i class="icon-plus"></i> Add First Color
                                            </button>
                                        </div>
                                    `);
                                        }
                                    });
                                } else {
                                    SweetAlertHelper.error(
                                        response.message || 'Failed to delete color.',
                                        'Delete Failed!'
                                    );
                                }
                            },
                            error: function(xhr) {
                                SweetAlertHelper.close(); // Close loading alert
                                SweetAlertHelper.error(
                                    'Failed to delete color. Please try again.',
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
            $('#addColorModal').on('hidden.bs.modal', function() {
                $('#addColorForm')[0].reset();
                clearAllErrors();
            });

            $('#editColorModal').on('hidden.bs.modal', function() {
                $('#editColorForm')[0].reset();
                clearAllErrors();
            });

        });
    </script>
@endpush
