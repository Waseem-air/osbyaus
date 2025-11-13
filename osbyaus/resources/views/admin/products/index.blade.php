@extends("admin.layout.main")

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Product List</h3>
                    <a class="tf-button style-1 w208" href="{{ route('admin.product.add') }}">
                        <i class="icon-plus"></i> Add new
                    </a>
                </div>

                <!-- Product List Table -->
                <div class="wg-box mt-5">
                    <div class="wg-table table-product-list">
                        <ul class="table-title flex gap20 mb-14">
                            <li><div class="body-title">Product</div></li>
                            <li><div class="body-title">Price</div></li>
                            <li><div class="body-title">Color & Size</div></li>
                            <li><div class="body-title">Stock</div></li>
                            <li><div class="body-title">Status</div></li>
                            <li><div class="body-title">Action</div></li>
                        </ul>

                        <ul class="flex flex-column">
                            @foreach($products as $product)
                                <li class="wg-product item-row gap20">
                                    <!-- Product Image & Name -->
                                    <div class="name">
                                        <div class="image">
                                            @if($product->mainImage)
                                                <img src="{{ asset($product->mainImage->image_path) }}" alt="{{ $product->name }}">
                                            @else
                                                <img src="{{ asset('admin/admin-ecomus/images/products/product-1.jpg') }}" alt="No Image">
                                            @endif
                                        </div>
                                        <div class="title line-clamp-2 mb-0">
                                            <a href="#" class="body-text">{{ $product->name }}</a>
                                            <p>SKU: {{ $product->sku }}</p>
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="body-text text-main-dark mt-4">
                                        ${{ number_format($product->final_price, 2) }}
                                        @if($product->discount_price)
                                            <br><small class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</small>
                                        @endif
                                    </div>

                                    <!-- Colors & Sizes -->
                                    <div class="size-display-group">
                                        @foreach($product->colors->take(3) as $productColor)
                                            @if($productColor)
                                                <div class="size-display">
                                                    <span class="color-circle" style="background-color: {{ $productColor->hex_code }};"></span>
                                                </div>
                                            @endif
                                        @endforeach

                                        <div class="size-display">
                                            <p>
                                                @foreach($product->sizes->take(3) as $productSize)
                                                    @if($productSize)
                                                        {{ $productSize->short_code }}@if(!$loop->last)/@endif
                                                    @endif
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Stock -->
                                    <div class="body-text text-main-dark mt-4">
                                        {{ $product->stock_quantity }}
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        @if($product->stock_quantity > 0)
                                            <div class="block-available bg-1 fw-7">In Stock</div>
                                        @else
                                            <div class="block-stock bg-1 fw-7">Out of stock</div>
                                        @endif
                                    </div>

                                    <!-- Actions -->
                                    <!-- In your product list HTML -->
                                    <div class="list-icon-function">
                                        <a href="{{ route('admin.product.show', $product->id) }}" class="item eye" title="View">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.product.edit', $product->id) }}" class="item edit" title="Edit">
                                            <i class="icon-edit-3"></i>
                                        </a>
                                        <a href="#" class="item trash delete-product"
                                           title="Delete"
                                           data-id="{{ $product->id }}"
                                           data-name="{{ $product->name }}">
                                            <i class="icon-trash-2"></i>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10">
                        <div class="text-tiny">Showing {{ $products->count() }} entries</div>
                        <!-- Pagination would go here -->
                    </div>
                </div>
            </div>
        </div>
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
                            success: function(response) {
                                SweetAlertHelper.close(); // Close loading alert
                                if (response.status === 'success') {
                                    SweetAlertHelper.successAutoClose(
                                        response.message || 'Product deleted successfully!',
                                        'Deleted!'
                                    );
                                    // Remove product row from table with animation
                                    $(`[data-product-id="${productId}"]`).fadeOut(300, function() {
                                        $(this).remove();
                                        // Check if no products left
                                        if ($('.wg-table .wg-product').length === 0) {
                                            $('.wg-table').html(`
                                                <div class="text-center py-5">
                                                    <div class="body-text text-muted mb-3">No products found</div>
                                                    <a class="tf-button style-1 w208" href="{{ route('admin.product.add') }}">
                                                        <i class="icon-plus"></i> Add First Product
                                                    </a>
                                                </div>
                                            `);
                                        }
                                    });
                                } else {
                                    SweetAlertHelper.error(
                                        response.message || 'Failed to delete product.',
                                        'Delete Failed!'
                                    );
                                }
                            },
                            error: function(xhr) {
                                SweetAlertHelper.close(); // Close loading alert
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

            // ========================
            // Delete Product Image
            // ========================
            $(document).on('click', '.delete-product-image', function(e) {
                e.preventDefault();
                const imageId = $(this).data('id');
                const imageElement = $(this).closest('.image-preview');

                SweetAlertHelper.confirm(
                    'Are you sure you want to delete this image? This action cannot be undone.',
                    'Delete Image?',
                    () => {
                        const loadingAlert = SweetAlertHelper.loading('Deleting image...');

                        $.ajax({
                            url: `/admin/products/image/${imageId}/delete`,
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            success: function(response) {
                                SweetAlertHelper.close();

                                if (response.status === 'success') {
                                    SweetAlertHelper.successAutoClose(
                                        response.message || 'Image deleted successfully!',
                                        'Deleted!'
                                    );

                                    // Remove image preview with animation
                                    imageElement.fadeOut(300, function() {
                                        $(this).remove();
                                    });
                                } else {
                                    SweetAlertHelper.error(
                                        response.message || 'Failed to delete image.',
                                        'Delete Failed!'
                                    );
                                }
                            },
                            error: function(xhr) {
                                SweetAlertHelper.close();

                                let errorMessage = 'Failed to delete image. Please try again.';

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
                        icon: 'warning'
                    }
                );
            });

        });
    </script>
@endpush
