@extends("admin.layout.main")

@section('content')
    <style>
        /* Modern Card Styles */
        .product-card {
            background: var(--White);
            border-radius: 20px;
            border: 1px solid var(--Stroke);
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .product-card:hover {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .card-header {
            padding: 24px;
            border-bottom: 1px solid var(--Stroke);
            background: var(--bg-table-1);
        }

        .card-body {
            padding: 24px;
        }

        .card-footer {
            padding: 20px 24px;
            border-top: 1px solid var(--Stroke);
            background: var(--bg-table-1);
        }

        /* Main Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--Main) 0%, var(--Secondary) 100%);
            color: var(--White);
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* Image Gallery */
        .gallery-card {
            background: var(--White);
            border-radius: 16px;
            border: 1px solid var(--Stroke);
            overflow: hidden;
        }

        .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 16px;
        }

        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
            gap: 12px;
            margin-top: 16px;
        }

        .thumbnail {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--Stroke);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .thumbnail:hover,
        .thumbnail.active {
            border-color: var(--Secondary);
            transform: scale(1.05);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--White);
            padding: 20px;
            border-radius: 16px;
            border: 1px solid var(--Stroke);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            border-color: var(--Secondary);
            transform: translateY(-2px);
        }

        .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--Main);
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--Body-Text);
            font-weight: 500;
        }

        /* Price Card */
        .price-card {
            background: linear-gradient(135deg, var(--Main) 0%, var(--Style) 100%);
            color: var(--White);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .price-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .current-price {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .original-price {
            font-size: 20px;
            opacity: 0.9;
            text-decoration: line-through;
            margin-bottom: 12px;
        }

        .discount-badge {
            background: var(--White);
            color: var(--Secondary);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 700;
            display: inline-block;
        }

        /* Info Cards */
        .info-card {
            background: var(--White);
            border-radius: 16px;
            border: 1px solid var(--Stroke);
            padding: 24px;
            margin-bottom: 16px;
        }

        .info-card:last-child {
            margin-bottom: 0;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--Heading);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: var(--Secondary);
        }

        /* Tag Styles */
        .tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--Surface-3);
            color: var(--Body-Text);
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid var(--Stroke);
            transition: all 0.3s ease;
        }

        .tag:hover {
            background: var(--Secondary);
            color: var(--White);
            transform: translateY(-1px);
        }

        .color-tag {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: var(--White);
            border: 1px solid var(--Stroke);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .color-tag:hover {
            border-color: var(--Secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .color-dot {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid var(--White);
            box-shadow: 0 0 0 1px var(--Stroke);
        }

        /* Status Indicators */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: var(--Palette-Green-500);
            color: var(--White);
        }

        .status-inactive {
            background: var(--Palette-Red-500);
            color: var(--White);
        }

        .status-instock {
            background: var(--Palette-Green-500);
            color: var(--White);
        }

        .status-outstock {
            background: var(--Palette-Red-500);
            color: var(--White);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-group {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--Stroke);
            background: var(--White);
            color: var(--Body-Text);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-icon:hover {
            background: var(--Secondary);
            color: var(--White);
            border-color: var(--Secondary);
            transform: translateY(-2px);
        }

        /* Image Actions */
        .image-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .image-action-btn {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid var(--Stroke);
            background: var(--White);
            color: var(--Body-Text);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-action-btn:hover:not(:disabled) {
            background: var(--Secondary);
            color: var(--White);
            border-color: var(--Secondary);
        }

        .image-action-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Description Box */
        .description-box {
            background: var(--Surface-3);
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid var(--Secondary);
            line-height: 1.7;
        }

        /* Grid Layout */
        .product-layout {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 24px;
        }

        .main-content-area {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .sidebar-area {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .product-layout {
                grid-template-columns: 1fr;
            }

            .sidebar-area {
                order: -1;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 24px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-group {
                justify-content: center;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            animation: fadeInUp 0.6s ease;
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <!-- Hero Section -->
                <div class="hero-section">
                    <div class="hero-content">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div>
                                <h1 class="mb-2">{{ $product->name }}</h1>
                                <div class="flex items-center gap-4 flex-wrap">
                                    <div class="flex items-center gap-2">
                                        <i class="icon-hash"></i>
                                        <span>{{ $product->sku }}</span>
                                    </div>
                                    <div class="status-badge {{ $product->status ? 'status-active' : 'status-inactive' }}">
                                        <i class="icon-{{ $product->status ? 'check-circle' : 'x-circle' }}"></i>
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </div>
                                    <div class="status-badge {{ $product->stock_quantity > 0 ? 'status-instock' : 'status-outstock' }}">
                                        <i class="icon-package"></i>
                                        {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </div>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <a href="{{ route('admin.product.index') }}" class="btn-icon" title="Back to Products">
                                    <i class="icon-arrow-left"></i>
                                </a>
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="tf-button style-1" title="Edit Product">
                                    <i class="icon-edit-3"></i> Edit Product
                                </a>
                                <button class="delete-product tf-button style-1"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        title="Delete Product">
                                    <i class="icon-trash-2"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">{{ $product->stock_quantity }}</div>
                        <div class="stat-label">Units in Stock</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $product->categories->count() }}</div>
                        <div class="stat-label">Categories</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $product->colors->count() }}</div>
                        <div class="stat-label">Colors</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $product->sizes->count() }}</div>
                        <div class="stat-label">Sizes</div>
                    </div>
                </div>

                <!-- Main Layout -->
                <div class="product-layout">
                    <!-- Main Content Area -->
                    <div class="main-content-area">
                        <!-- Image Gallery Card -->
                        <div class="product-card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="icon-image"></i>
                                    Product Gallery
                                </h3>
                            </div>
                            <div class="card-body">
                                @if($product->images->count() > 0)
                                    <div class="gallery-card">
                                        <img src="{{ asset($product->mainImage ? $product->mainImage->image_path : $product->images->first()->image_path) }}"
                                             alt="{{ $product->name }}"
                                             class="main-image">

                                        <div class="thumbnail-grid">
                                            @foreach($product->images as $image)
                                                <img src="{{ asset($image->image_path) }}"
                                                     alt="Product Image {{ $loop->iteration }}"
                                                     class="thumbnail {{ $image->is_main ? 'active' : '' }}"
                                                     onclick="switchMainImage(this, '{{ asset($image->image_path) }}')">
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <i class="icon-image" style="font-size: 48px; color: var(--Icon);"></i>
                                        <div class="body-text mt-3" style="color: var(--Body-Text);">No images available</div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Description Card -->
                        <div class="product-card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="icon-file-text"></i>
                                    Product Description
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="description-box">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>
                        </div>

                        <!-- Specifications Card -->
                        <div class="product-card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="icon-sliders"></i>
                                    Specifications
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="info-card">
                                        <div class="stat-label">Fabric</div>
                                        <div style="color: var(--Heading); font-weight: 600; font-size: 16px;">
                                            {{ $product->fabric }}
                                        </div>
                                    </div>
                                    <div class="info-card">
                                        <div class="stat-label">Embellishment</div>
                                        <div style="color: var(--Heading); font-weight: 600; font-size: 16px;">
                                            {{ $product->embellishment }}
                                        </div>
                                    </div>
                                    <div class="info-card">
                                        <div class="stat-label">Cut</div>
                                        <div style="color: var(--Heading); font-weight: 600; font-size: 16px;">
                                            {{ $product->cut }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Area -->
                    <div class="sidebar-area">
                        <!-- Price Card -->
                        <div class="price-card">
                            <div class="current-price">
                                {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->final_price, 2) }}
                            </div>
                            @if($product->discount_price)
                                <div class="original-price">
                                    {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->price, 2) }}
                                </div>
                                <div class="discount-badge">
                                    Save {{ $product->discount_percentage }}%
                                </div>
                            @endif
                        </div>

                        <!-- Categories Card -->
                        @if($product->categories->count() > 0)
                            <div class="product-card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="icon-tag"></i>
                                        Categories
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($product->categories as $category)
                                            <span class="tag">
                                                <i class="icon-folder"></i>
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Colors Card -->
                        @if($product->colors->count() > 0)
                            <div class="product-card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="icon-droplet"></i>
                                        Available Colors
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="space-y-3">
                                        @foreach($product->colors as $productColor)
                                            @if($productColor)
                                                <div class="color-tag">
                                                    <span class="color-dot" style="background-color: {{ $productColor->hex_code }};"></span>
                                                    <span style="font-weight: 600; color: var(--Heading);">
                                                        {{ $productColor->name }}
                                                    </span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Sizes Card -->
                        @if($product->sizes->count() > 0)
                            <div class="product-card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="icon-maximize"></i>
                                        Available Sizes
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($product->sizes as $productSize)
                                            @if($productSize)
                                                <span class="tag">
                                                    {{ $productSize->name }} ({{ $productSize->short_code }})
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Image Management Card -->
                        @if($product->images->count() > 0)
                            <div class="product-card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="icon-settings"></i>
                                        Image Management
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="space-y-3">
                                        @foreach($product->images as $image)
                                            <div class="flex items-center justify-between p-3 border border-Stroke rounded-lg">
                                                <div class="flex items-center gap-3">
                                                    <img src="{{ asset($image->image_path) }}"
                                                         alt="Thumbnail"
                                                         class="w-12 h-12 object-cover rounded">
                                                    <div>
                                                        <div style="font-weight: 600; color: var(--Heading); font-size: 14px;">
                                                            Image {{ $loop->iteration }}
                                                        </div>
                                                        <div style="color: var(--Note); font-size: 12px;">
                                                            {{ $image->is_main ? 'Main Image' : 'Additional' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="image-actions">
                                                    <button class="image-action-btn set-main-btn {{ $image->is_main ? 'disabled' : '' }}"
                                                            data-id="{{ $image->id }}"
                                                        {{ $image->is_main ? 'disabled' : '' }}>
                                                        <i class="icon-star"></i> Main
                                                    </button>
                                                    <button class="image-action-btn delete-product-image"
                                                            data-id="{{ $image->id }}">
                                                        <i class="icon-trash-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('admin.components.footer')
    </div>

    <script>
        function switchMainImage(thumb, mainImageUrl) {
            document.querySelector('.main-image').src = mainImageUrl;

            // Update active state
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            thumb.classList.add('active');
        }
    </script>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content') || '';

            // Delete Product
            $(document).on('click', '.delete-product', function(e) {
                e.preventDefault();
                const productId = $(this).data('id');
                const productName = $(this).data('name');

                Swal.fire({
                    title: 'Delete Product?',
                    text: `Are you sure you want to delete "${productName}"? This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'var(--Palette-Red-500)',
                    cancelButtonColor: 'var(--Secondary)',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    background: 'var(--White)',
                    color: 'var(--Body-Text)'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const loadingAlert = Swal.fire({
                            title: 'Deleting...',
                            text: 'Please wait while we delete the product.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            background: 'var(--White)'
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
                                        showConfirmButton: false,
                                        background: 'var(--White)'
                                    }).then(() => {
                                        window.location.href = '{{ route('admin.product.index') }}';
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message || 'Failed to delete product.',
                                        icon: 'error',
                                        background: 'var(--White)'
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
                                    icon: 'error',
                                    background: 'var(--White)'
                                });
                            }
                        });
                    }
                });
            });

            // Delete Product Image
            $(document).on('click', '.delete-product-image', function(e) {
                e.preventDefault();
                const imageId = $(this).data('id');
                const imageElement = $(this).closest('.flex.items-center');

                Swal.fire({
                    title: 'Delete Image?',
                    text: 'Are you sure you want to delete this image?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'var(--Palette-Red-500)',
                    cancelButtonColor: 'var(--Secondary)',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    background: 'var(--White)'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const loadingAlert = Swal.fire({
                            title: 'Deleting...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                            background: 'var(--White)'
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
                                        showConfirmButton: false,
                                        background: 'var(--White)'
                                    });
                                    imageElement.fadeOut(300, function() {
                                        $(this).remove();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message || 'Failed to delete image.',
                                        icon: 'error',
                                        background: 'var(--White)'
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
                                    icon: 'error',
                                    background: 'var(--White)'
                                });
                            }
                        });
                    }
                });
            });

            // Set Main Image
            $(document).on('click', '.set-main-btn:not(.disabled)', function(e) {
                e.preventDefault();
                const imageId = $(this).data('id');
                const loadingAlert = Swal.fire({
                    title: 'Updating...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    background: 'var(--White)'
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
                                text: response.message || 'Main image updated!',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false,
                                background: 'var(--White)'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message || 'Failed to update main image.',
                                icon: 'error',
                                background: 'var(--White)'
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
                            icon: 'error',
                            background: 'var(--White)'
                        });
                    }
                });
            });
        });
    </script>
@endpush
