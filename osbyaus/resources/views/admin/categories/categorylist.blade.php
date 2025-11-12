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
        <div id="alertContainer" class="alert-container"></div>

        <!-- Add Category Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addCategoryForm" class="form-style-1" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div id="addCategoryErrors" class="alert alert-danger d-none mb-20"></div>
                            
                            <fieldset class="mb-20">
                                <div class="body-title">Category Name <span class="tf-color-1">*</span></div>
                                <input class="form-control" type="text" placeholder="Category name" 
                                       name="name" required>
                            </fieldset>

                            <fieldset class="mb-20">
                                <div class="body-title">Description</div>
                                <textarea class="form-control" name="description" placeholder="Category description" rows="3"></textarea>
                            </fieldset>

                            <fieldset class="mb-20">
                                <div class="body-title">Upload Image</div>
                                <div class="upload-image flex-grow">
                                    <div class="item up-load">
                                        <label class="uploadfile h250" for="addCategoryImage">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>
                                            <span class="body-text">
                                                Drop your image here or <span class="tf-color">click to browse</span>
                                            </span>
                                            <img id="addCategoryImagePreview" src="" alt="" class="d-none mt-2" style="max-height: 120px;">
                                            <input type="file" id="addCategoryImage" name="image" accept="image/*" class="d-none">
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="addCategoryBtn">
                                <span class="spinner d-none"></span>
                                Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editCategoryForm" class="form-style-1" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div id="editCategoryErrors" class="alert alert-danger d-none mb-20"></div>
                            <input type="hidden" id="editCategoryId" name="id">
                            
                            <fieldset class="mb-20">
                                <div class="body-title">Category Name <span class="tf-color-1">*</span></div>
                                <input class="form-control" type="text" placeholder="Category name" 
                                       id="editCategoryName" name="name" required>
                            </fieldset>

                            <fieldset class="mb-20">
                                <div class="body-title">Description</div>
                                <textarea class="form-control" id="editCategoryDescription" name="description" placeholder="Category description" rows="3"></textarea>
                            </fieldset>

                            <fieldset class="mb-20">
                                <div class="body-title">Upload Image</div>
                                <div class="upload-image flex-grow">
                                    <div class="item up-load">
                                        <label class="uploadfile h250" for="editCategoryImage">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>
                                            <span class="body-text">
                                                Drop your image here or <span class="tf-color">click to browse</span>
                                            </span>
                                            <img id="editCategoryImagePreview" src="" alt="" class="mt-2 d-none" style="max-height: 120px;">
                                            <input type="file" id="editCategoryImage" name="image" accept="image/*" class="d-none">
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="editCategoryBtn">
                                <span class="spinner d-none"></span>
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Category List</h3>
                </div>
                
                <div class="search-bar-container">
                    <!-- Search Form -->
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." name="search" required>
                            <button type="submit" class="search-icon">
                                <i class="icon-search"></i>
                            </button>
                        </fieldset>
                    </form>

                    <!-- Status Dropdown -->
                    <div class="dropdown status-dropdown">
                        <button class="dropdown-btn">
                            Status : Unpaid <i class="icon-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#">Paid</a>
                            <a href="#">Unpaid</a>
                            <a href="#">All</a>
                        </div>
                    </div>

                    <!-- Filter by Recent Dropdown -->
                    <div class="dropdown">
                        <button class="dropdown-btn">
                            Filter by Recent <i class="icon-chevron-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="#">Newest First</a>
                            <a href="#">Oldest First</a>
                            <a href="#">A–Z</a>
                            <a href="#">Z–A</a>
                        </div>
                    </div>

                    <!-- Add New Button -->
                    <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="icon-plus"></i>Add new
                    </button>
                </div>

                <!-- all-category -->
                <div class="wg-box mt-5">
                    <div class="wg-table table-all-category">
                        <ul class="table-title flex gap20 mb-14">
                            <li><div class="body-title">Category</div></li>
                            <li><div class="body-title">Slug</div></li>
                            <li><div class="body-title">Status</div></li>
                            <li><div class="body-title">Created</div></li>
                            <li><div class="body-title">Action</div></li>
                        </ul>

                        <ul class="flex flex-column" id="categoriesList">
                            @foreach($categories as $category)
                            <li class="wg-product item-row gap20" id="category-{{ $category->id }}">
                                <div class="name">
                                    <div class="image">
                                        <img src="{{ asset(($category->image ?? 'default.jpg')) }}" 
                                             alt="{{ $category->name }}" width="50">
                                    </div>
                                    <div class="title line-clamp-2 mb-0">
                                        <a href="#" class="body-text">{{ $category->name }}</a>
                                    </div>
                                </div>

                                <div class="body-text text-main-dark mt-4">{{ $category->slug }}</div>
                                <div class="body-text text-main-dark mt-4">
                                    <span class="status-badge {{ $category->is_active ? 'active' : 'inactive' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="body-text text-main-dark mt-4">{{ $category->created_at->format('d M Y') }}</div>

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

                                    <!-- Preview -->
                                    <a href="{{ route('category.list') }}#category-{{ $category->id }}" title="Preview Category">
                                        <i class="icon-eye"></i>
                                    </a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- /all-category -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        
        <!-- bottom-page -->
        <div class="bottom-page">
            <div class="body-text">Copyright © 2024 <a href="../index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
        </div>
        <!-- /bottom-page -->
    </div>
    <!-- /main-content -->
@endsection

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // CSRF Token setup
    const csrfToken = $('meta[name="csrf-token"]').attr('content') || '';

    // Show alert function
    function showAlert(message, type = 'success') {
        const alertId = 'alert-' + Date.now();
        const alertHtml = `
            <div id="${alertId}" class="alert alert-${type}">
                <span>${message}</span>
                <button type="button" style="background:none; border:none; cursor:pointer;">
                    <i class="icon-x"></i>
                </button>
            </div>
        `;
        
        $('#alertContainer').append(alertHtml);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            $('#' + alertId).remove();
        }, 5000);
    }

    // Image preview functionality
    function setupImagePreview(inputId, previewId) {
        $('#' + inputId).on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + previewId).attr('src', e.target.result).removeClass('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    }

    console.log('DOM loaded - initializing category management');
    
    // Setup image previews
    setupImagePreview('addCategoryImage', 'addCategoryImagePreview');
    setupImagePreview('editCategoryImage', 'editCategoryImagePreview');

    // Click handlers for file inputs
    $('.uploadfile').on('click', function(e) {
        // Prevent the click from bubbling up to parent elements
        e.stopPropagation();
        if (!$(e.target).is('input')) {
            const fileInput = $(this).find('input[type="file"]');
            if (fileInput.length) {
                fileInput.trigger('click');
            }
        }
    });

    // Add Category Form Submission
    $('#addCategoryForm').on('submit', function(e) {
        e.preventDefault();
        console.log('Add category form submitted');
        
        const formData = new FormData(this);
        const btn = $('#addCategoryBtn');
        const spinner = btn.find('.spinner');
        const errorDiv = $('#addCategoryErrors');
        
        btn.addClass('btn-loading').prop('disabled', true);
        spinner.removeClass('d-none');
        errorDiv.html('').addClass('d-none');
        
        $.ajax({
            url: '{{ route("store.category") }}',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log('Response:', data);
                if (data.status === 'success') {
                    // Close modal using Bootstrap
                    const modal = bootstrap.Modal.getInstance($('#addCategoryModal')[0]);
                    modal.hide();
                    
                    showAlert(data.message, 'success');
                    
                    // Reload page to show new category
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else if (data.status === 'error') {
                    let errorHtml = '';
                    if (data.errors) {
                        errorHtml = '<ul>';
                        $.each(data.errors, function(key, error) {
                            errorHtml += `<li>${error[0]}</li>`;
                        });
                        errorHtml += '</ul>';
                    } else {
                        errorHtml = `<p>${data.message}</p>`;
                    }
                    errorDiv.html(errorHtml).removeClass('d-none');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                showAlert('An error occurred while adding the category.', 'error');
            },
            complete: function() {
                btn.removeClass('btn-loading').prop('disabled', false);
                spinner.addClass('d-none');
            }
        });
    });

    // Edit Category - Load Data when modal is about to be shown
    $('#editCategoryModal').on('show.bs.modal', function(event) {
        const editBtn = $(event.relatedTarget);
        if (editBtn.hasClass('edit-category')) {
            const categoryId = editBtn.data('id');
            console.log('Edit category clicked:', categoryId);
            
            $.ajax({
                url: `/admin/categories/${categoryId}/get`,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                success: function(data) {
                    console.log('Edit response:', data);
                    if (data.status === 'success') {
                        const category = data.category;
                        $('#editCategoryId').val(category.id);
                        $('#editCategoryName').val(category.name);
                        $('#editCategoryDescription').val(category.description || '');
                        
                        const imagePreview = $('#editCategoryImagePreview');
                        if (category.image) {
                            imagePreview.attr('src', '{{ asset("") }}' + category.image).removeClass('d-none');
                        } else {
                            imagePreview.attr('src', '').addClass('d-none');
                        }
                        
                        const errorDiv = $('#editCategoryErrors');
                        errorDiv.html('').addClass('d-none');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    showAlert('Failed to load category data.', 'error');
                }
            });
        }
    });

    // Edit Category Form Submission
    $('#editCategoryForm').on('submit', function(e) {
        e.preventDefault();
        console.log('Edit category form submitted');
        
        const categoryId = $('#editCategoryId').val();
        const formData = new FormData(this);
        const btn = $('#editCategoryBtn');
        const spinner = btn.find('.spinner');
        const errorDiv = $('#editCategoryErrors');
        
        btn.addClass('btn-loading').prop('disabled', true);
        spinner.removeClass('d-none');
        errorDiv.html('').addClass('d-none');
        
        $.ajax({
            url: `/admin/categories/${categoryId}/update`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log('Update response:', data);
                if (data.status === 'success') {
                    // Close modal using Bootstrap
                    const modal = bootstrap.Modal.getInstance($('#editCategoryModal')[0]);
                    modal.hide();
                    
                    showAlert(data.message, 'success');
                    
                    // Reload page to show updated category
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else if (data.status === 'error') {
                    let errorHtml = '';
                    if (data.errors) {
                        errorHtml = '<ul>';
                        $.each(data.errors, function(key, error) {
                            errorHtml += `<li>${error[0]}</li>`;
                        });
                        errorHtml += '</ul>';
                    } else {
                        errorHtml = `<p>${data.message}</p>`;
                    }
                    errorDiv.html(errorHtml).removeClass('d-none');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                showAlert('An error occurred while updating the category.', 'error');
            },
            complete: function() {
                btn.removeClass('btn-loading').prop('disabled', false);
                spinner.addClass('d-none');
            }
        });
    });

    // Delete Category with SweetAlert Confirmation
    $(document).on('click', '.delete-category', function() {
        const deleteBtn = $(this);
        const categoryId = deleteBtn.data('id');
        const categoryName = deleteBtn.data('name');
        console.log('Delete category clicked:', categoryId, categoryName);
        
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete "${categoryName}". This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/categories/${categoryId}/delete`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    success: function(data) {
                        console.log('Delete response:', data);
                        if (data.status === 'success') {
                            showAlert(data.message, 'success');
                            const categoryElement = $('#category-' + categoryId);
                            if (categoryElement.length) {
                                categoryElement.css({
                                    'opacity': '0',
                                    'transition': 'opacity 0.3s ease'
                                });
                                setTimeout(() => {
                                    categoryElement.remove();
                                }, 300);
                            }
                        } else {
                            showAlert(data.message || 'Failed to delete category.', 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        showAlert('Failed to delete category.', 'error');
                    }
                });
            }
        });
    });

    // Reset forms when modals are hidden
    $('#addCategoryModal').on('hidden.bs.modal', function() {
        $('#addCategoryForm')[0].reset();
        $('#addCategoryImagePreview').attr('src', '').addClass('d-none');
        $('#addCategoryErrors').html('').addClass('d-none');
    });

    $('#editCategoryModal').on('hidden.bs.modal', function() {
        $('#editCategoryErrors').html('').addClass('d-none');
    });

    // Close alert when close button is clicked
    $(document).on('click', '.alert button', function() {
        $(this).closest('.alert').remove();
    });
});
</script>
@endpush