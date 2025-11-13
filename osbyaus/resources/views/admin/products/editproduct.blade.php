@extends("admin.layout.main")
@section('content')

    <style>
        /* Tag Input Styles */
        .tag-input-box {
            position: relative;
            border: 1px solid var(--Stroke);
            border-radius: 8px;
            padding: 12px;
            min-height: 52px;
            cursor: pointer;
            background: var(--White);
            transition: all 0.3s ease;
        }

        .tag-input-box:hover {
            border-color: var(--Secondary);
        }

        .tag-input-box.invalid {
            border-color: var(--Palette-Red-500);
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.1);
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
            color: var(--Text-Holder);
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 12px;
            font-size: 14px;
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
            background: var(--Secondary);
            color: var(--White);
            padding: 6px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tag:hover {
            background: var(--Style);
            transform: translateY(-1px);
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
            border: 1px solid var(--White);
            box-shadow: 0 0 0 1px var(--Stroke);
        }

        .tag button {
            background: none;
            border: none;
            color: var(--White);
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
            padding: 0;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .tag button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .error-message {
            color: var(--Palette-Red-500);
            font-size: 12px;
            margin-top: 6px;
            display: none;
            font-weight: 500;
        }

        .error-message.show {
            display: block;
        }

        /* Image Preview - UPDATED STYLES */
        .preview-container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .preview-item {
            position: relative;
            width: 150px;
            height: 150px;
            border: 2px solid var(--Stroke);
            border-radius: 12px;
            overflow: hidden;
            background: var(--Surface-3);
            transition: all 0.3s ease;
        }

        .preview-item:hover {
            border-color: var(--Secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 116, 51, 0.15);
        }

        .preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Updated Remove Button - More Visible */
        .remove-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: var(--Palette-Red-500);
            color: var(--White);
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            line-height: 1;
            padding: 0;
            transition: all 0.3s ease;
            opacity: 1;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }

        .remove-btn:hover {
            background: var(--Secondary);
            transform: scale(1.15);
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.4);
        }

        /* Existing Images Actions - UPDATED */
        .preview-item.existing {
            position: relative;
        }

        .preview-item.existing .image-actions {
            position: absolute;
            top: 8px;
            right: 8px;
            display: flex;
            gap: 5px;
            z-index: 10;
        }

        .set-main-btn,
        .remove-existing-btn {
            background: var(--White);
            color: var(--Body-Text);
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            opacity: 0.9;
        }

        .set-main-btn:hover {
            background: var(--Palette-Green-500);
            color: var(--White);
            transform: scale(1.1);
            opacity: 1;
        }

        .remove-existing-btn:hover {
            background: var(--Palette-Red-500);
            color: var(--White);
            transform: scale(1.1);
            opacity: 1;
        }

        .main-badge {
            position: absolute;
            top: 4px;
            right: 90px;
            background: var(--Palette-Green-500);
            color: var(--White);
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            z-index: 10;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Toggle Switch */
        .status-toggle {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 24px;
            padding: 16px;
            background: var(--Surface-3);
            border-radius: 12px;
            border: 1px solid var(--Stroke);
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
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
            background-color: var(--Surface);
            transition: .4s;
            border-radius: 34px;
            border: 1px solid var(--Stroke);
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: var(--White);
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        input:checked + .slider {
            background-color: var(--Secondary);
            border-color: var(--Secondary);
        }

        input:checked + .slider:before {
            transform: translateX(24px);
            background-color: var(--White);
        }

        input:focus + .slider {
            box-shadow: 0 0 0 3px rgba(255, 116, 51, 0.2);
        }

        /* Loading States */
        .btn-loading {
            opacity: 0.7;
            pointer-events: none;
            background: var(--Surface) !important;
            border-color: var(--Stroke) !important;
        }

        .btn-loading .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid var(--Secondary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Form Controls */
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--Stroke);
            border-radius: 8px;
            font-size: 14px;
            background: var(--Input);
            color: var(--Body-Text);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--Secondary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 116, 51, 0.1);
            background: var(--White);
        }

        .form-control::placeholder {
            color: var(--Text-Holder);
        }

        .form-control.invalid {
            border-color: var(--Palette-Red-500);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Additional Secondary Color Applications */
        .preview-item.main-image {
            border-color: var(--Secondary);
            box-shadow: 0 0 0 2px var(--Secondary);
        }

        .tag.secondary {
            background: var(--Secondary);
        }

        .tag.secondary:hover {
            background: var(--Palette-Red-500);
        }

        .status-text {
            color: var(--Body-Text);
            font-weight: 500;
            font-size: 14px;
        }

        .status-text.active {
            color: var(--Palette-Green-500);
        }

        .status-text.inactive {
            color: var(--Palette-Red-500);
        }

        /* File Upload Area */
        .file-upload-area {
            border: 2px dashed var(--Stroke);
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            background: var(--Surface-3);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: var(--Secondary);
            background: var(--hv-item);
        }

        .file-upload-area.dragover {
            border-color: var(--Secondary);
            background: var(--hv-item);
            box-shadow: 0 0 0 3px rgba(255, 116, 51, 0.1);
        }

        /* Price Input Groups */
        .price-input-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .price-input {
            flex: 1;
        }

        .currency-symbol {
            color: var(--Secondary);
            font-weight: 600;
            font-size: 14px;
        }

        /* Stock Indicators */
        .stock-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .stock-indicator.low {
            background: var(--Palette-Red-500);
            color: var(--White);
        }

        .stock-indicator.medium {
            background: var(--Palette-Orange-400);
            color: var(--White);
        }

        .stock-indicator.high {
            background: var(--Palette-Green-500);
            color: var(--White);
        }

        /* Image Action Hover Effects */
        .preview-item:hover .remove-btn,
        .preview-item:hover .image-actions {
            opacity: 1;
            transform: scale(1);
        }

        /* Ensure buttons are always visible on existing images */
        .preview-item.existing .image-actions {
            opacity: 1;
        }

        /* Make new image remove buttons more prominent */
        .preview-item:not(.existing) .remove-btn {
            opacity: 1;
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
