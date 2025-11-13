@extends("admin.layout.main")
@section('content')

    <style>
        /* Existing Image Styles */
        .existing-images {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .preview-item.existing {
            position: relative;
            width: 100px;
            height: 100px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 10px;
            display: inline-block;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .preview-item.existing:hover {
            border-color: #007bff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .preview-item.existing img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-actions {
            position: absolute;
            top: 4px;
            right: 4px;
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .preview-item.existing:hover .image-actions {
            opacity: 1;
        }

        .set-main-btn, .remove-existing-btn {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 4px;
            width: 24px;
            height: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #333;
            transition: all 0.3s ease;
        }

        .set-main-btn:hover {
            background: #28a745;
            color: white;
        }

        .remove-existing-btn:hover {
            background: #dc3545;
            color: white;
        }

        .main-badge {
            background: #28a745;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: 600;
        }

        /* Tag Input Styles */
        .tag-input-box {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px;
            min-height: 45px;
            cursor: pointer;
            background: white;
        }

        .tag-input-box.invalid {
            border-color: #dc3545;
        }

        .tag-input-box select {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .placeholder {
            color: #6c757d;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 12px;
        }

        .placeholder.hidden {
            display: none;
        }

        .selected-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag {
            background: #007bff;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
        }

        .color-tag {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .color-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .tag button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
            line-height: 1;
            padding: 0;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        /* Image Preview */
        .preview-container {
            margin-top: 15px;
        }

        .preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 10px;
            display: inline-block;
            margin-right: 10px;
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            line-height: 1;
            padding: 0;
        }

        /* Toggle Switch */
        .status-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #007bff;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
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
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Form Controls */
        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }
    </style>

    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Edit Product</h3>
                    <a href="{{ route('admin.product.show', $product->id) }}" class="tf-button style-2">
                        <i class="icon-eye"></i> View Product
                    </a>
                </div>

                <!-- Bootstrap Grid Layout -->
                <div class="row">
                    <!-- ✅ Upload Images Section -->
                    <div class="col-lg-5 col-12 order-lg-1 order-2">
                        <div class="wg-box mb-30">
                            <fieldset>
                                <div class="body-title mb-10">Product Images</div>
                                <p class="text-muted mb-3">Supported formats: JPG, PNG, JPEG. Max size: 2MB</p>

                                <!-- Existing Images -->
                                @if($product->images->count() > 0)
                                    <div class="existing-images mb-4">
                                        <div class="body-title mb-2">Current Images</div>
                                        <div class="preview-container flex gap20 flex-wrap"
                                             id="existingImagesContainer">
                                            @foreach($product->images as $image)
                                                <div class="preview-item existing" data-image-id="{{ $image->id }}">
                                                    <img src="{{ asset($image->image_path) }}" alt="Product Image">
                                                    <div class="image-actions">
                                                        @if($image->is_main)
                                                            <span class="main-badge">Main</span>
                                                        @else
                                                            <button type="button" class="set-main-btn"
                                                                    data-id="{{ $image->id }}" title="Set as Main">
                                                                <i class="icon-star"></i>
                                                            </button>
                                                        @endif
                                                        <button type="button" class="remove-existing-btn"
                                                                data-id="{{ $image->id }}" title="Delete Image">
                                                            <i class="icon-trash-2"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- New Images Upload -->
                                <div class="upload-image mb-16">
                                    <div class="up-load">
                                        <label class="uploadfile" for="productImages">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>
                                            <div class="text-tiny">
                                                Add more images or
                                                <span class="text-secondary">click to browse</span>
                                            </div>
                                            <input type="file" id="productImages" name="images[]" accept="image/*"
                                                   multiple>
                                        </label>
                                    </div>

                                    <!-- ✅ New Images Preview Container -->
                                    <div class="preview-container flex gap20 flex-wrap mt-3"
                                         id="previewContainer"></div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <!-- Form section -->
                    <div class="col-lg-7 col-12">
                        <form id="editProductForm" class="form-edit-product" enctype="multipart/form-data"
                              action="{{ route('admin.product.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Product Information -->
                            <div class="wg-box mb-30">
                                <h1 class="mb-2">Edit Product Information</h1>
                                <p class="text-muted mb-4">Update the product details below.</p>

                                <!-- Categories -->
                                <fieldset class="mb-4">
                                    <div class="body-title mb-2">
                                        Product Category <span class="tf-color-1">*</span>
                                    </div>
                                    <div class="tag-input-box" id="categoryInputBox">
                                        <span id="categoryPlaceholder"
                                              class="placeholder {{ $product->categories->count() > 0 ? 'hidden' : '' }}">Select categories</span>
                                        <div class="selected-tags" id="selectedCategories">
                                            @foreach($product->categories as $category)
                                                <div class="tag">
                                                    {{ $category->name }}
                                                    <button type="button"
                                                            onclick="this.parentElement.remove(); productForm.updatePlaceholder('selectedCategories');">
                                                        &times;
                                                    </button>
                                                    <input type="hidden" name="categories[]"
                                                           value="{{ $category->id }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <select id="categorySelect">
                                            <option value="" disabled selected>Select categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" data-name="{{ $category->name }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="error-message" id="categoryError"></div>
                                </fieldset>

                                <!-- SKU -->
                                <fieldset class="category mb-4">
                                    <div class="body-title mb-2">SKU <span class="tf-color-1">*</span></div>
                                    <input type="text" placeholder="Enter SKU" name="sku" class="form-control"
                                           value="{{ $product->sku }}" required>
                                </fieldset>

                                <!-- Product Name -->
                                <fieldset class="category mb-4">
                                    <div class="body-title mb-2">Product Name <span class="tf-color-1">*</span></div>
                                    <input type="text" placeholder="Enter product name" name="name" class="form-control"
                                           value="{{ $product->name }}" required>
                                </fieldset>

                                <!-- Sizes -->
                                <fieldset class="mb-4">
                                    <div class="body-title mb-2">
                                        Size <span class="tf-color-1">*</span>
                                    </div>
                                    <div class="tag-input-box" id="sizeInputBox">
                                        <span id="sizePlaceholder"
                                              class="placeholder {{ $product->sizes->count() > 0 ? 'hidden' : '' }}">Select sizes</span>
                                        <div class="selected-tags" id="selectedSizes">
                                            @foreach($product->sizes as $productSize)
                                                <div class="tag">
                                                    {{ $productSize->name }} ({{ $productSize->short_code }})
                                                    <button type="button"
                                                            onclick="this.parentElement.remove(); productForm.updatePlaceholder('selectedSizes');">
                                                        &times;
                                                    </button>
                                                    <input type="hidden" name="sizes[]" value="{{ $productSize->id }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <select id="sizeSelect">
                                            <option value="" disabled selected>Select sizes</option>
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->id }}"
                                                        data-name="{{ $size->name }} ({{ $size->short_code }})">
                                                    {{ $size->name }} ({{ $size->short_code }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="error-message" id="sizeError"></div>
                                </fieldset>

                                <!-- Colors -->
                                <fieldset class="mb-4">
                                    <div class="body-title mb-2">
                                        Color <span class="tf-color-1">*</span>
                                    </div>
                                    <div class="tag-input-box" id="colorInputBox">
                                        <span id="colorPlaceholder"
                                              class="placeholder {{ $product->colors->count() > 0 ? 'hidden' : '' }}">Select colors</span>
                                        <div class="selected-tags" id="selectedColors">
                                            @foreach($product->colors as $productColor)
                                                <div class="tag">
                                                    <div class="color-tag">
                                                        <span class="color-dot"
                                                              style="background-color: {{ $productColor->hex_code }};"></span>
                                                        {{ $productColor->name }}
                                                        <button type="button"
                                                                onclick="this.parentElement.parentElement.remove(); productForm.updatePlaceholder('selectedColors');">
                                                            &times;
                                                        </button>
                                                    </div>
                                                    <input type="hidden" name="colors[]"
                                                           value="{{ $productColor->id }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <select id="colorSelect">
                                            <option value="" disabled selected>Select colors</option>
                                            @foreach($colors as $color)
                                                <option value="{{ $color->id }}" data-name="{{ $color->name }}"
                                                        data-hex="{{ $color->hex_code }}">
                                                    {{ $color->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="error-message" id="colorError"></div>
                                </fieldset>

                                <!-- Product Details -->
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <fieldset class="category">
                                            <div class="body-title mb-2">Fabric <span class="tf-color-1">*</span></div>
                                            <input type="text" placeholder="Enter Fabric" name="fabric"
                                                   class="form-control" value="{{ $product->fabric }}" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <fieldset class="category">
                                            <div class="body-title mb-2">Embellishment <span class="tf-color-1">*</span>
                                            </div>
                                            <input type="text" placeholder="Enter Embellishment" name="embellishment"
                                                   class="form-control" value="{{ $product->embellishment }}" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <fieldset class="category">
                                            <div class="body-title mb-2">Cut <span class="tf-color-1">*</span></div>
                                            <input type="text" placeholder="Enter Cut" name="cut" class="form-control"
                                                   value="{{ $product->cut }}" required>
                                        </fieldset>
                                    </div>
                                </div>

                                <!-- Pricing -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <fieldset class="category">
                                            <div class="body-title mb-2">Regular Price <span class="tf-color-1">*</span>
                                            </div>
                                            <input type="number" step="0.01" placeholder="Enter Price"
                                                   name="regular_price" class="form-control"
                                                   value="{{ $product->price }}" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="category">
                                            <div class="body-title mb-2">Sale Price</div>
                                            <input type="number" step="0.01" placeholder="Enter Price" name="sale_price"
                                                   class="form-control" value="{{ $product->discount_price }}">
                                        </fieldset>
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <fieldset class="category mb-4">
                                    <div class="body-title mb-2">Quantity <span class="tf-color-1">*</span></div>
                                    <input type="number" placeholder="Enter stock" name="stock_quantity"
                                           class="form-control" value="{{ $product->stock_quantity }}" required>
                                </fieldset>

                                <!-- Description -->
                                <fieldset class="description mb-4">
                                    <div class="body-title mb-2">Description <span class="tf-color-1">*</span></div>
                                    <textarea name="description" placeholder="Type Description here"
                                              class="form-control" rows="4"
                                              required>{{ $product->description }}</textarea>
                                </fieldset>

                                <!-- Status Toggle -->
                                <div class="status-toggle">
                                    <span class="status-label">Active</span>
                                    <label class="switch">
                                        <input type="checkbox" name="status"
                                               value="active" {{ $product->status ? 'checked' : '' }}>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="wg-box">
                                <button type="submit" class="tf-button w-full" id="submitBtn">
                                    <i class="icon-save"></i> Update Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.components.footer')
    </div>
@endsection

@push('scripts')
    <script>
        class ProductEditForm {
            constructor() {
                this.categories = @json($categories);
                this.colors = @json($colors);
                this.sizes = @json($sizes);
                this.productId = {{ $product->id }};
                this.init();
            }

            init() {
                this.handleCategorySelection();
                this.handleSizeSelection();
                this.handleColorSelection();
                this.handleImageUpload();
                this.handleFormSubmission();
                this.handleImageActions();
            }

            // Category Selection
            handleCategorySelection() {
                const categorySelect = document.getElementById('categorySelect');
                const placeholder = document.getElementById('categoryPlaceholder');

                categorySelect.addEventListener('change', (e) => {
                    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
                    if (selectedOption.value) {
                        this.addTag('selectedCategories', selectedOption.value, selectedOption.dataset.name, 'categories');
                        categorySelect.selectedIndex = 0;
                        placeholder.classList.add('hidden');
                    }
                });
            }

            // Size Selection
            handleSizeSelection() {
                const sizeSelect = document.getElementById('sizeSelect');
                const placeholder = document.getElementById('sizePlaceholder');

                sizeSelect.addEventListener('change', (e) => {
                    const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
                    if (selectedOption.value) {
                        this.addTag('selectedSizes', selectedOption.value, selectedOption.dataset.name, 'sizes');
                        sizeSelect.selectedIndex = 0;
                        placeholder.classList.add('hidden');
                    }
                });
            }

            // Color Selection
            handleColorSelection() {
                const colorSelect = document.getElementById('colorSelect');
                const placeholder = document.getElementById('colorPlaceholder');

                colorSelect.addEventListener('change', (e) => {
                    const selectedOption = colorSelect.options[colorSelect.selectedIndex];
                    if (selectedOption.value) {
                        this.addColorTag(selectedOption.value, selectedOption.dataset.name, selectedOption.dataset.hex);
                        colorSelect.selectedIndex = 0;
                        placeholder.classList.add('hidden');
                    }
                });
            }

            addTag(containerId, value, name, fieldName) {
                const container = document.getElementById(containerId);
                const tag = document.createElement('div');
                tag.className = 'tag';
                tag.innerHTML = `
                ${name}
                <button type="button" onclick="this.parentElement.remove(); productForm.updatePlaceholder('${containerId}');">&times;</button>
                <input type="hidden" name="${fieldName}[]" value="${value}">
            `;
                container.appendChild(tag);
            }

            addColorTag(value, name, hex) {
                const container = document.getElementById('selectedColors');
                const tag = document.createElement('div');
                tag.className = 'tag';
                tag.innerHTML = `
                <div class="color-tag">
                    <span class="color-dot" style="background-color: ${hex};"></span>
                    ${name}
                    <button type="button" onclick="this.parentElement.parentElement.remove(); productForm.updatePlaceholder('selectedColors');">&times;</button>
                </div>
                <input type="hidden" name="colors[]" value="${value}">
            `;
                container.appendChild(tag);
            }

            updatePlaceholder(containerId) {
                const container = document.getElementById(containerId);
                const placeholder = document.getElementById(containerId.replace('selected', '').toLowerCase() + 'Placeholder');

                if (container.children.length === 0) {
                    placeholder.classList.remove('hidden');
                }
            }

            // Image Upload
            handleImageUpload() {
                const fileInput = document.getElementById('productImages');
                const previewContainer = document.getElementById('previewContainer');

                fileInput.addEventListener('change', (e) => {
                    const files = Array.from(e.target.files);

                    files.forEach((file, index) => {
                        if (!file.type.match('image.*')) return;

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const previewItem = document.createElement('div');
                            previewItem.className = 'preview-item';
                            previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-btn" onclick="this.parentElement.remove();">&times;</button>
                        `;
                            previewContainer.appendChild(previewItem);
                        };
                        reader.readAsDataURL(file);
                    });
                });
            }

            // Image Actions
            handleImageActions() {
                // Set Main Image
                $(document).on('click', '.set-main-btn', (e) => {
                    const imageId = $(e.target).closest('.set-main-btn').data('id');
                    this.setMainImage(imageId);
                });

                // Remove Existing Image
                $(document).on('click', '.remove-existing-btn', (e) => {
                    const imageId = $(e.target).closest('.remove-existing-btn').data('id');
                    this.deleteExistingImage(imageId);
                });
            }

            setMainImage(imageId) {
                Swal.fire({
                    title: 'Set as Main Image?',
                    text: 'This image will be displayed as the main product image.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, set as main',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
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
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            success: (response) => {
                                Swal.close();

                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: 'Success!',
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
                            error: (xhr) => {
                                Swal.close();
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to update main image. Please try again.',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            }

            deleteExistingImage(imageId) {
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
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            success: (response) => {
                                Swal.close();

                                if (response.status === 'success') {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: response.message || 'Image deleted successfully!',
                                        icon: 'success',
                                        timer: 1500,
                                        showConfirmButton: false
                                    });

                                    // Remove image from DOM
                                    $(`[data-image-id="${imageId}"]`).fadeOut(300, function () {
                                        $(this).remove();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.message || 'Failed to delete image.',
                                        icon: 'error'
                                    });
                                }
                            },
                            error: (xhr) => {
                                Swal.close();
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to delete image. Please try again.',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            }

            // Form Submission - FIXED METHOD
            handleFormSubmission() {
                const form = document.getElementById('editProductForm');
                const submitBtn = document.getElementById('submitBtn');

                form.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    if (!this.validateForm()) {
                        return;
                    }

                    const formData = new FormData(form);

                    // Add new images
                    const fileInput = document.getElementById('productImages');
                    for (let i = 0; i < fileInput.files.length; i++) {
                        formData.append('images[]', fileInput.files[i]);
                    }

                    try {
                        this.setLoadingState(submitBtn, true);

                        // ✅ FIX: Use POST method directly since Laravel handles method spoofing
                        const response = await fetch(`/admin/products/${this.productId}/update`, {
                            method: 'POST', // ✅ Use POST directly
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        // ✅ Check if response is JSON
                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            throw new Error('Server returned non-JSON response');
                        }

                        const result = await response.json();

                        if (result.status === 'success') {
                            this.showNotification(result.message, 'success');
                            setTimeout(() => {
                                window.location.href = '{{ route("admin.product.show", $product->id) }}';
                            }, 1500);
                        } else {
                            this.showNotification(result.message, 'error');
                            if (result.errors) {
                                this.displayValidationErrors(result.errors);
                            }
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        if (error.message.includes('non-JSON')) {
                            this.showNotification('Server error: Please check your form and try again.', 'error');
                        } else {
                            this.showNotification('An error occurred. Please try again.', 'error');
                        }
                    } finally {
                        this.setLoadingState(submitBtn, false);
                    }
                });
            }

            validateForm() {
                let isValid = true;

                // Clear previous errors
                document.querySelectorAll('.error-message').forEach(el => {
                    el.classList.remove('show');
                });

                // Check categories
                const selectedCategories = document.querySelectorAll('input[name="categories[]"]');
                if (selectedCategories.length === 0) {
                    document.getElementById('categoryError').textContent = 'Please select at least one category';
                    document.getElementById('categoryError').classList.add('show');
                    document.getElementById('categoryInputBox').classList.add('invalid');
                    isValid = false;
                }

                // Check sizes
                const selectedSizes = document.querySelectorAll('input[name="sizes[]"]');
                if (selectedSizes.length === 0) {
                    document.getElementById('sizeError').textContent = 'Please select at least one size';
                    document.getElementById('sizeError').classList.add('show');
                    document.getElementById('sizeInputBox').classList.add('invalid');
                    isValid = false;
                }

                // Check colors
                const selectedColors = document.querySelectorAll('input[name="colors[]"]');
                if (selectedColors.length === 0) {
                    document.getElementById('colorError').textContent = 'Please select at least one color';
                    document.getElementById('colorError').classList.add('show');
                    document.getElementById('colorInputBox').classList.add('invalid');
                    isValid = false;
                }

                return isValid;
            }

            setLoadingState(button, isLoading) {
                if (isLoading) {
                    button.disabled = true;
                    button.innerHTML = '<span class="spinner"></span> Updating Product...';
                    button.classList.add('btn-loading');
                } else {
                    button.disabled = false;
                    button.innerHTML = '<i class="icon-save"></i> Update Product';
                    button.classList.remove('btn-loading');
                }
            }

            displayValidationErrors(errors) {
                for (const [field, messages] of Object.entries(errors)) {
                    const errorElement = document.getElementById(field + 'Error');
                    if (errorElement) {
                        errorElement.textContent = messages[0];
                        errorElement.classList.add('show');
                    } else {
                        this.showNotification(messages[0], 'error');
                    }
                }
            }

            showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `alert alert-${type}`;
                notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                padding: 15px;
                border-radius: 8px;
                color: white;
                font-weight: bold;
                background-color: ${type === 'success' ? '#28a745' : '#dc3545'};
            `;
                notification.textContent = message;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        }

        // Initialize when document is ready
        const productForm = new ProductEditForm();
    </script>
@endpush
