@extends("admin.layout.main")

@section('content')
    <style>
        .main-product-image {
            width: 400px;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-image-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
        }

        .image-preview-small {
            width: 100px;
            height: 100px;
            border-radius: 6px;
            overflow: hidden;
            border: 2px solid #e0e0e0;
        }

        .preview-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status-info {
            display: flex;
            align-items: center;
        }

        .main-badge {
            background: #28a745;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .tf-button.small {
            padding: 6px 12px;
            font-size: 12px;
            min-height: auto;
        }

        .tf-button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .color-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: inline-block;
            border: 2px solid #e0e0e0;
        }

        .category-tag {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .size-badge {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .discount-badge {
            background: #dc3545;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .table-product-images .table-title {
            padding: 0 20px;
        }

        .table-product-images .flex.flex-column {
            padding: 0 20px;
        }

        .product-image-item:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
            margin: 0 -20px;
            padding: 15px 20px;
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <!-- Header with Back Button -->
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.product.index') }}" class="tf-button style-2" title="Back to Products">
                            <i class="icon-arrow-left"></i> Back
                        </a>
                        <h3>Product Details</h3>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="tf-button style-1" title="Edit Product">
                            <i class="icon-edit-3"></i> Edit
                        </a>
                        <a href="#" class="tf-button style-3 delete-product"
                           data-id="{{ $product->id }}"
                           data-name="{{ $product->name }}"
                           title="Delete Product">
                            <i class="icon-trash-2"></i> Delete
                        </a>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="wg-box">
                    <div class="flex flex-wrap gap-4 mb-6">
                        <!-- Main Product Image -->
                        <div class="main-image-container">
                            @if($product->mainImage)
                                <img src="{{ asset($product->mainImage->image_path) }}" alt="{{ $product->name }}" class="main-product-image">
                            @else
                                <img src="{{ asset('admin/admin-ecomus/images/products/product-1.jpg') }}" alt="No Image" class="main-product-image">
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="product-info flex-1">
                            <h4 class="mb-3">{{ $product->name }}</h4>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="body-text">
                                    <strong>SKU:</strong> {{ $product->sku }}
                                </div>
                                <div class="body-text">
                                    <strong>Status:</strong>
                                    @if($product->status)
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Price Information -->
                            <div class="price-section mb-4">
                                <div class="flex items-center gap-3">
                                    <h3 class="text-main-dark mb-0">{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->final_price, 2) }}</h3>
                                    @if($product->discount_price)
                                        <span class="text-muted text-decoration-line-through">{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->price, 2) }}</span>
                                        <span class="discount-badge">-{{ $product->discount_percentage }}%</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Stock Information -->
                            <div class="stock-section mb-4">
                                <div class="body-text">
                                    <strong>Stock Quantity:</strong> {{ $product->stock_quantity }}
                                </div>
                                <div class="mt-2">
                                    @if($product->stock_quantity > 0)
                                        <div class="block-available bg-1 fw-7 d-inline-block">In Stock</div>
                                    @else
                                        <div class="block-stock bg-1 fw-7 d-inline-block">Out of stock</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Product Specifications -->
                            <div class="specs-section grid grid-cols-2 gap-4 mb-4">
                                <div class="body-text">
                                    <strong>Fabric:</strong> {{ $product->fabric }}
                                </div>
                                <div class="body-text">
                                    <strong>Embellishment:</strong> {{ $product->embellishment }}
                                </div>
                                <div class="body-text">
                                    <strong>Cut:</strong> {{ $product->cut }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Images - Redesigned Section -->
                    @if($product->images->count() > 0)
                        <div class="image-gallery-section mb-6">
                            <h4 class="mb-3">Product Images</h4>
                            <div class="wg-box">
                                <div class="wg-table table-product-images">
                                    <ul class="table-title flex mb-24">
                                        <li>
                                            <div class="body-title">Image Preview</div>
                                        </li>
                                        <li>
                                            <div class="body-title">Status</div>
                                        </li>
                                        <li>
                                            <div class="body-title">Actions</div>
                                        </li>
                                    </ul>
                                    <ul class="flex flex-column gap14">
                                        @foreach($product->images as $image)
                                            <li class="product-image-item">
                                                <div class="flex items-center gap-3">
                                                    <div class="image-preview-small">
                                                        <img src="{{ asset($image->image_path) }}" alt="Product Image" class="preview-thumb">
                                                    </div>
                                                    <span class="body-text">Image {{ $loop->iteration }}</span>
                                                </div>
                                                <div class="status-info">
                                                    @if($image->is_main)
                                                        <span class="main-badge">Main Image</span>
                                                    @else
                                                        <span class="body-text text-muted">Additional</span>
                                                    @endif
                                                </div>
                                                <div class="action-buttons">
                                                    <button type="button" class="set-main-btn tf-button style-2 small {{ $image->is_main ? 'disabled' : '' }}"
                                                            data-id="{{ $image->id }}"
                                                            title="Set as Main Image"
                                                        {{ $image->is_main ? 'disabled' : '' }}>
                                                        <i class="icon-star"></i> Set Main
                                                    </button>
                                                    <button type="button" class="delete-image-btn tf-button style-3 small delete-product-image"
                                                            data-id="{{ $image->id }}"
                                                            title="Delete Image">
                                                        <i class="icon-trash-2"></i> Delete
                                                    </button>
                                                </div>
                                            </li>
                                            @if(!$loop->last)
                                                <li class="divider"></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Categories -->
                    @if($product->categories->count() > 0)
                        <div class="categories-section mb-6">
                            <h4 class="mb-3">Categories</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($product->categories as $category)
                                    <span class="category-tag bg-light px-3 py-1 rounded">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Colors -->
                    @if($product->colors->count() > 0)
                        <div class="colors-section mb-6">
                            <h4 class="mb-3">Available Colors</h4>
                            <div class="flex flex-wrap gap-3">
                                @foreach($product->colors as $productColor)
                                    @if($productColor)
                                        <div class="color-item flex items-center gap-2">
                                            <span class="color-circle" style="background-color: {{ $productColor->hex_code }};"></span>
                                            <span class="body-text">{{ $productColor->name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Sizes -->
                    @if($product->sizes->count() > 0)
                        <div class="sizes-section mb-6">
                            <h4 class="mb-3">Available Sizes</h4>
                            <div class="flex flex-wrap gap-3">
                                @foreach($product->sizes as $productSize)
                                    @if($productSize)
                                        <div class="size-item">
                                            <span class="size-badge px-3 py-1 border rounded">{{ $productSize->name }} ({{ $productSize->short_code }})</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="description-section mt-6">
                        <h4 class="mb-3">Description</h4>
                        <div class="body-text">
                            {!! nl2br(e($product->description)) !!}
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

            // ========================
            // Delete Product
            // ========================
            $(document).on('click', '.delete-product', function(e) {
                e.preventDefault();
                const productId = $(this).data('id');
                const productName = $(this).data('name');

                Swal.fire({
                    title: 'Delete Product?',
                    text: `Are you sure you want to delete "${productName}"? This action cannot be undone and all associated data will be lost.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const loadingAlert = Swal.fire({
                            title: 'Deleting...',
                            text: 'Please wait while we delete the product.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: `/admin/products/${productId}/delete`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            success: function(response) {
                                Swal.close();

                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: response.message || 'Product deleted successfully!',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.href = '{{ route('admin.product.index') }}';
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message || 'Failed to delete product.',
                                        icon: 'error'
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.close();

                                let errorMessage = 'Failed to delete product. Please try again.';

                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                Swal.fire({
                                    title: 'Error!',
                                    text: errorMessage,
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });

            // ========================
            // Delete Product Image
            // ========================
            $(document).on('click', '.delete-product-image', function(e) {
                e.preventDefault();
                const imageId = $(this).data('id');
                const imageElement = $(this).closest('.product-image-item');

                Swal.fire({
                    title: 'Delete Image?',
                    text: 'Are you sure you want to delete this image? This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const loadingAlert = Swal.fire({
                            title: 'Deleting...',
                            text: 'Please wait while we delete the image.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: `/admin/products/image/${imageId}/delete`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            success: function(response) {
                                Swal.close();

                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: response.message || 'Image deleted successfully!',
                                        icon: 'success',
                                        timer: 1500,
                                        showConfirmButton: false
                                    });

                                    // Remove image item with animation
                                    imageElement.fadeOut(300, function() {
                                        $(this).remove();

                                        // If no images left, show message
                                        if ($('.product-image-item').length === 0) {
                                            $('.image-gallery-section').html(`
                                                <div class="text-center py-4">
                                                    <div class="body-text text-muted">No images available</div>
                                                </div>
                                            `);
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message || 'Failed to delete image.',
                                        icon: 'error'
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.close();

                                let errorMessage = 'Failed to delete image. Please try again.';

                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                Swal.fire({
                                    title: 'Error!',
                                    text: errorMessage,
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });

            // ========================
            // Set Main Image
            // ========================
            $(document).on('click', '.set-main-btn:not(.disabled)', function(e) {
                e.preventDefault();
                const imageId = $(this).data('id');
                const button = $(this);

                const loadingAlert = Swal.fire({
                    title: 'Updating...',
                    text: 'Setting image as main...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: `/admin/products/image/${imageId}/set-main`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        Swal.close();

                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Updated!',
                                text: response.message || 'Main image updated successfully!',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message || 'Failed to update main image.',
                                icon: 'error'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();

                        let errorMessage = 'Failed to update main image. Please try again.';

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            title: 'Error!',
                            text: errorMessage,
                            icon: 'error'
                        });
                    }
                });
            });

        });
    </script>
@endpush
