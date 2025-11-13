@extends("admin.layout.main")
@section('content')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Add Product</h3>
                </div>

                <!-- Bootstrap Grid Layout -->
                <div class="row">
                    <!-- ✅ Upload Images Section -->
                    <div class="col-lg-5 col-12 order-lg-1 order-2">
                        <div class="wg-box mb-30">
                            <fieldset>
                                <div class="body-title mb-10">Product Images</div>
                                <p class="text-muted mb-3">Supported formats: JPG, PNG, JPEG. Max size: 2MB</p>

                                <div class="upload-image mb-16">
                                    <div class="up-load">
                                        <label class="uploadfile" for="productImages">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>
                                            <div class="text-tiny">
                                                Drop your images here or
                                                <span class="text-secondary">click to browse</span>
                                            </div>
                                            <input type="file" id="productImages" name="images[]" accept="image/*" multiple>
                                        </label>
                                    </div>

                                    <!-- ✅ Preview Container -->
                                    <div class="preview-container flex gap20 flex-wrap mt-3" id="previewContainer"></div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <!-- Form section -->
                    <div class="col-lg-7 col-12">
                        <form id="addProductForm" class="form-add-product" enctype="multipart/form-data">
                            @csrf

                            <!-- Product Information -->
                            <div class="wg-box mb-30">
                                <h1 class="mb-2">Product Information</h1>
                                <p class="text-muted mb-4">Fill all the details below and publish your new product.</p>

                                <!-- Categories -->
                                <fieldset class="mb-4">
                                    <div class="body-title mb-2">
                                        Product Category <span class="tf-color-1">*</span>
                                    </div>
                                    <div class="tag-input-box" id="categoryInputBox">
                                        <span id="categoryPlaceholder" class="placeholder">Select categories</span>
                                        <div class="selected-tags" id="selectedCategories"></div>
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
                                    <input type="text" placeholder="Enter SKU" name="sku" class="form-control" required>
                                </fieldset>

                                <!-- Product Name -->
                                <fieldset class="category mb-4">
                                    <div class="body-title mb-2">Product Name <span class="tf-color-1">*</span></div>
                                    <input type="text" placeholder="Enter product name" name="name" class="form-control" required>
                                </fieldset>

                                <!-- Sizes -->
                                <fieldset class="mb-4">
                                    <div class="body-title mb-2">
                                        Size <span class="tf-color-1">*</span>
                                    </div>
                                    <div class="tag-input-box" id="sizeInputBox">
                                        <span id="sizePlaceholder" class="placeholder">Select sizes</span>
                                        <div class="selected-tags" id="selectedSizes"></div>
                                        <select id="sizeSelect">
                                            <option value="" disabled selected>Select sizes</option>
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->id }}" data-name="{{ $size->name }} ({{ $size->short_code }})">
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
                                        <span id="colorPlaceholder" class="placeholder">Select colors</span>
                                        <div class="selected-tags" id="selectedColors"></div>
                                        <select id="colorSelect">
                                            <option value="" disabled selected>Select colors</option>
                                            @foreach($colors as $color)
                                                <option value="{{ $color->id }}" data-name="{{ $color->name }}" data-hex="{{ $color->hex_code }}">
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
                                            <input type="text" placeholder="Enter Fabric" name="fabric" class="form-control" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <fieldset class="category">
                                            <div class="body-title mb-2">Embellishment <span class="tf-color-1">*</span></div>
                                            <input type="text" placeholder="Enter Embellishment" name="embellishment" class="form-control" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <fieldset class="category">
                                            <div class="body-title mb-2">Cut <span class="tf-color-1">*</span></div>
                                            <input type="text" placeholder="Enter Cut" name="cut" class="form-control" required>
                                        </fieldset>
                                    </div>
                                </div>

                                <!-- Pricing -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <fieldset class="category">
                                            <div class="body-title mb-2">Regular Price <span class="tf-color-1">*</span></div>
                                            <input type="number" step="0.01" placeholder="Enter Price" name="regular_price" class="form-control" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="category">
                                            <div class="body-title mb-2">Sale Price</div>
                                            <input type="number" step="0.01" placeholder="Enter Price" name="sale_price" class="form-control">
                                        </fieldset>
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <fieldset class="category mb-4">
                                    <div class="body-title mb-2">Quantity <span class="tf-color-1">*</span></div>
                                    <input type="number" placeholder="Enter stock" name="stock_quantity" class="form-control" required>
                                </fieldset>

                                <!-- Description -->
                                <fieldset class="description mb-4">
                                    <div class="body-title mb-2">Description <span class="tf-color-1">*</span></div>
                                    <textarea name="description" placeholder="Type Description here" class="form-control" rows="4" required></textarea>
                                </fieldset>

                                <!-- Status Toggle -->
                                <div class="status-toggle">
                                    <span class="status-label">Active</span>
                                    <label class="switch">
                                        <input type="checkbox" name="status" value="active" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="wg-box">
                                <button type="submit" class="tf-button w-full" id="submitBtn">
                                    <i class="icon-save"></i> Add Product
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
    <style>
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
            background: rgba(0,0,0,0.7);
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
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
            box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        }
    </style>

    <script>
        class ProductForm {
            constructor() {
                this.categories = @json($categories);
                this.colors = @json($colors);
                this.sizes = @json($sizes);
                this.init();
            }

            init() {
                this.handleCategorySelection();
                this.handleSizeSelection();
                this.handleColorSelection();
                this.handleImageUpload();
                this.handleFormSubmission();
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

            // Form Submission
            handleFormSubmission() {
                const form = document.getElementById('addProductForm');
                const submitBtn = document.getElementById('submitBtn');

                form.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    if (!this.validateForm()) {
                        return;
                    }

                    const formData = new FormData(form);

                    // Add images
                    const fileInput = document.getElementById('productImages');
                    for (let i = 0; i < fileInput.files.length; i++) {
                        formData.append('images[]', fileInput.files[i]);
                    }

                    try {
                        this.setLoadingState(submitBtn, true);

                        const response = await fetch('{{ route("admin.product.store") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        });

                        const result = await response.json();

                        if (result.status === 'success') {
                            this.showNotification(result.message, 'success');
                            setTimeout(() => {
                                window.location.href = '{{ route("admin.product.index") }}';
                            }, 1500);
                        } else {
                            this.showNotification(result.message, 'error');
                            if (result.errors) {
                                this.displayValidationErrors(result.errors);
                            }
                        }
                    } catch (error) {
                        this.showNotification('An error occurred. Please try again.', 'error');
                        console.error('Error:', error);
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

                // Check images
                const images = document.getElementById('productImages').files;
                if (images.length === 0) {
                    this.showNotification('Please upload at least one image', 'error');
                    isValid = false;
                }

                return isValid;
            }

            setLoadingState(button, isLoading) {
                if (isLoading) {
                    button.disabled = true;
                    button.innerHTML = '<span class="spinner"></span> Adding Product...';
                    button.classList.add('btn-loading');
                } else {
                    button.disabled = false;
                    button.innerHTML = '<i class="icon-save"></i> Add Product';
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
                // Create and show notification
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
        const productForm = new ProductForm();
    </script>
@endpush
