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
                                <div class="body-title mb-10">Upload Images</div>

                                <div class="upload-image mb-16">
                                    <div class="up-load">
                                        <label class="uploadfile" for="myFiles">
                                            <span class="icon">
                                                <i class="icon-upload-cloud"></i>
                                            </span>
                                            <div class="text-tiny">
                                                Drop your images here or select
                                                <span class="text-secondary">click to browse</span>
                                            </div>
                                            <input type="file" id="myFiles" name="images[]" accept="image/*" multiple>
                                        </label>
                                    </div>

                                    <!-- ✅ Preview Container -->
                                    <div class="preview-container flex gap20 flex-wrap" id="previewContainer"></div>
                                </div>

                                <div class="body-text">
                                    You can upload multiple product images. Make sure they are clear, high-quality, and properly sized.
                                </div>
                            </fieldset>
                            <div class="cols gap10">
                                <button class="tf-button w380" type="submit">Add product</button>
                            </div>
                        </div>
                    </div>

                    <!-- Form section - 7 columns on large screens, 12 on medium/small -->
                    <div class="col-lg-7 col-12">
                        <!-- form-add-product -->
                        <form class="form-add-product">
                            <div class="wg-box mb-30">
                                <h1 class="">Product Information</h1>
                                <p>Fill all the details below and publish your new product.</p>
                                <fieldset>
                                    <div class="body-title mb-10">
                                        Product Category <span class="tf-color-1">*</span>
                                    </div>

                                    <div class="tag-input-box" id="tagInputBox">
                                        <!-- Placeholder text -->
                                        <span id="placeholderText" class="placeholder">Select category</span>

                                        <!-- Tags will appear here -->
                                        <div class="selected-tags" id="selectedTags"></div>

                                        <!-- Hidden dropdown -->
                                        <select id="categorySelect" required>
                                            <option value="" disabled selected>Select category</option>
                                            <option value="new-arrival">New Arrival</option>
                                            <option value="unstitched">Unstitched</option>
                                            <option value="ready-to-wear">Ready To Wear</option>
                                            <option value="accessories">Accessories</option>
                                            <option value="footwear">Footwear</option>
                                        </select>
                                    </div>

                                    <div class="error-message" id="categoryError">Please select at least one category</div>
                                </fieldset>
                                <fieldset class="category">
                                    <div class="body-title mb-10">SKU <span class="tf-color-1">*</span></div>
                                    <input type="text" placeholder="Enter SKU" name="sku" tabindex="0" aria-required="true" required>
                                </fieldset>

                                <fieldset class="category">
                                    <div class="body-title mb-10">Product Name <span class="tf-color-1">*</span></div>
                                    <input type="text" placeholder="Enter product name" name="product_name" tabindex="0" aria-required="true" required>
                                </fieldset>
                                <fieldset>
                                    <div class="body-title mb-10">
                                        Product Sizes <span class="tf-color-1">*</span>
                                    </div>

                                    <div class="tag-input-box" id="sizeInputBox">
                                        <!-- Placeholder text -->
                                        <span id="sizePlaceholderText" class="placeholder">Select sizes</span>

                                        <!-- Tags will appear here -->
                                        <div class="selected-tags" id="selectedSizes"></div>

                                        <!-- Hidden dropdown -->
                                        <select id="sizeSelect" required>
                                            <option value="" disabled selected>Select sizes</option>
                                            <!-- Only Small, Medium, Large -->
                                            <option value="small">Small (S)</option>
                                            <option value="medium">Medium (M)</option>
                                            <option value="large">Large (L)</option>
                                        </select>
                                    </div>

                                    <div class="error-message" id="sizeError">Please select at least one size</div>
                                </fieldset>
                                <fieldset>
                                    <div class="body-title mb-10">
                                        Product Colors <span class="tf-color-1">*</span>
                                    </div>

                                    <div class="tag-input-box" id="colorInputBox">
                                        <!-- Placeholder text -->
                                        <span id="colorPlaceholderText" class="placeholder">Select colors</span>

                                        <!-- Tags will appear here -->
                                        <div class="selected-tags" id="selectedColors"></div>

                                        <!-- Hidden dropdown -->
                                        <select id="colorSelect" required>
                                            <option value="" disabled selected>Select colors</option>
                                            <!-- Basic Colors -->
                                            <option value="black" data-color="#000000" data-text-color="#ffffff">Black</option>
                                            <option value="white" data-color="#ffffff" data-text-color="#000000">White</option>
                                            <option value="red" data-color="#ff0000" data-text-color="#ffffff">Red</option>
                                            <option value="blue" data-color="#0000ff" data-text-color="#ffffff">Blue</option>
                                            <option value="green" data-color="#008000" data-text-color="#ffffff">Green</option>
                                            <option value="yellow" data-color="#ffff00" data-text-color="#000000">Yellow</option>
                                            <option value="purple" data-color="#800080" data-text-color="#ffffff">Purple</option>
                                            <option value="pink" data-color="#ffc0cb" data-text-color="#000000">Pink</option>
                                            <option value="orange" data-color="#ffa500" data-text-color="#000000">Orange</option>
                                            <option value="brown" data-color="#a52a2a" data-text-color="#ffffff">Brown</option>
                                            <option value="gray" data-color="#808080" data-text-color="#ffffff">Gray</option>

                                            <!-- Fashion Colors -->
                                            <option value="navy" data-color="#000080" data-text-color="#ffffff">Navy Blue</option>
                                            <option value="maroon" data-color="#800000" data-text-color="#ffffff">Maroon</option>
                                            <option value="teal" data-color="#008080" data-text-color="#ffffff">Teal</option>
                                            <option value="lavender" data-color="#e6e6fa" data-text-color="#000000">Lavender</option>
                                            <option value="beige" data-color="#f5f5dc" data-text-color="#000000">Beige</option>
                                            <option value="olive" data-color="#808000" data-text-color="#ffffff">Olive</option>
                                            <option value="cyan" data-color="#00ffff" data-text-color="#000000">Cyan</option>
                                            <option value="magenta" data-color="#ff00ff" data-text-color="#ffffff">Magenta</option>
                                            <option value="coral" data-color="#ff7f50" data-text-color="#000000">Coral</option>
                                            <option value="turquoise" data-color="#40e0d0" data-text-color="#000000">Turquoise</option>

                                            <!-- Metallic Colors -->
                                            <option value="gold" data-color="#ffd700" data-text-color="#000000">Gold</option>
                                            <option value="silver" data-color="#c0c0c0" data-text-color="#000000">Silver</option>
                                            <option value="bronze" data-color="#cd7f32" data-text-color="#000000">Bronze</option>
                                        </select>
                                    </div>

                                    <div class="error-message" id="colorError">Please select at least one color</div>
                                </fieldset>

                                <div class="cols-lg gap22">
                                    <!-- Fabric -->
                                    <fieldset class="category">
                                        <div class="body-title mb-10">Fabric <span class="tf-color-1">*</span></div>
                                        <input type="text" placeholder="Enter Fabric" name="fabric" tabindex="0" aria-required="true" required>
                                    </fieldset>

                                    <!-- Embellishment -->
                                    <fieldset class="category">
                                        <div class="body-title mb-10">Embellishment <span class="tf-color-1">*</span></div>
                                        <input type="text" placeholder="Enter Embellishment" name="embellishment" tabindex="0" aria-required="true" required>
                                    </fieldset>

                                    <!-- Cut -->
                                    <fieldset class="category">
                                        <div class="body-title mb-10">Cut <span class="tf-color-1">*</span></div>
                                        <input type="text" placeholder="Enter Cut" name="cut" tabindex="0" aria-required="true" required>
                                    </fieldset>
                                </div>

                                <div class="cols-lg gap22">
                                    <!-- Regular Price -->
                                    <fieldset class="category">
                                        <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                                        <input type="number" placeholder="Enter Regular Price" name="regular_price" tabindex="0" aria-required="true" required>
                                    </fieldset>

                                    <!-- Sale Price -->
                                    <fieldset class="category">
                                        <div class="body-title mb-10">Sale Price</div>
                                        <input type="number" placeholder="Enter Sale Price" name="sale_price" tabindex="0" aria-required="true">
                                    </fieldset>
                                </div>

                                <fieldset class="category">
                                    <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span></div>
                                    <input type="number" placeholder="Enter Quantity" name="quantity" tabindex="0" aria-required="true" required>
                                </fieldset>

                                <fieldset class="description">
                                    <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                                    <textarea class="mb-10" name="description" placeholder="Short description about product" tabindex="0" aria-required="true" required=""></textarea>
                                </fieldset>
                                <div class="status-toggle">
                                    <span class="status-label">Active / Inactive</span>
                                    <label class="switch">
                                        <input type="checkbox" id="toggleSwitch">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                        <!-- /form-add-product -->
                    </div>
                </div>
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
<style>
    /* Additional CSS for tag functionality */
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

    /* Image preview styles */
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

    .remove-btn:hover {
        background: rgba(0,0,0,0.9);
    }

    .progress-bar {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background: #007bff;
        width: 0%;
        transition: width 0.3s ease;
    }

    /* Toggle switch styles */
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Category Tag Functionality
    const categorySelect = document.getElementById("categorySelect");
    if (categorySelect) {
        const tagContainer = document.getElementById("selectedTags");
        const placeholder = document.getElementById("placeholderText");
        const tagInputBox = document.getElementById("tagInputBox");
        const errorMessage = document.getElementById("categoryError");

        let selectedValues = [];

        function updatePlaceholder() {
            if (selectedValues.length > 0) {
                placeholder.classList.add('hidden');
            } else {
                placeholder.classList.remove('hidden');
            }
        }

        function validateSelection() {
            if (selectedValues.length === 0) {
                tagInputBox.classList.add('invalid');
                errorMessage.classList.add('show');
                return false;
            } else {
                tagInputBox.classList.remove('invalid');
                errorMessage.classList.remove('show');
                return true;
            }
        }

        categorySelect.addEventListener("change", function() {
            const value = this.value;
            const text = this.options[this.selectedIndex].text;

            if (value && !selectedValues.includes(value)) {
                selectedValues.push(value);

                const tag = document.createElement("div");
                tag.classList.add("tag");
                tag.innerHTML = `${text} <button type="button" data-value="${value}" aria-label="Remove ${text}">&times;</button>`;
                tagContainer.appendChild(tag);

                updatePlaceholder();
                validateSelection();
            }

            this.selectedIndex = 0;
        });

        tagContainer.addEventListener("click", function(e) {
            if (e.target.tagName === "BUTTON") {
                const value = e.target.getAttribute("data-value");
                selectedValues = selectedValues.filter(v => v !== value);
                e.target.parentElement.remove();
                updatePlaceholder();
                validateSelection();
            }
        });

        updatePlaceholder();
    }

    // Size Tag Functionality
    const sizeSelect = document.getElementById("sizeSelect");
    if (sizeSelect) {
        const sizeContainer = document.getElementById("selectedSizes");
        const sizePlaceholder = document.getElementById("sizePlaceholderText");
        const sizeInputBox = document.getElementById("sizeInputBox");
        const sizeErrorMessage = document.getElementById("sizeError");

        let selectedSizes = [];

        function updateSizePlaceholder() {
            if (selectedSizes.length > 0) {
                sizePlaceholder.classList.add('hidden');
            } else {
                sizePlaceholder.classList.remove('hidden');
            }
        }

        function validateSizeSelection() {
            if (selectedSizes.length === 0) {
                sizeInputBox.classList.add('invalid');
                sizeErrorMessage.classList.add('show');
                return false;
            } else {
                sizeInputBox.classList.remove('invalid');
                sizeErrorMessage.classList.remove('show');
                return true;
            }
        }

        sizeSelect.addEventListener("change", function() {
            const value = this.value;
            const text = this.options[this.selectedIndex].text;

            if (value && !selectedSizes.includes(value)) {
                selectedSizes.push(value);

                const tag = document.createElement("div");
                tag.classList.add("tag");
                tag.innerHTML = `${text} <button type="button" data-value="${value}" aria-label="Remove ${text}">&times;</button>`;
                sizeContainer.appendChild(tag);

                updateSizePlaceholder();
                validateSizeSelection();
            }

            this.selectedIndex = 0;
        });

        sizeContainer.addEventListener("click", function(e) {
            if (e.target.tagName === "BUTTON") {
                const value = e.target.getAttribute("data-value");
                selectedSizes = selectedSizes.filter(v => v !== value);
                e.target.parentElement.remove();
                updateSizePlaceholder();
                validateSizeSelection();
            }
        });

        updateSizePlaceholder();
    }

    // Color Tag Functionality
    const colorSelect = document.getElementById("colorSelect");
    if (colorSelect) {
        const colorContainer = document.getElementById("selectedColors");
        const colorPlaceholder = document.getElementById("colorPlaceholderText");
        const colorInputBox = document.getElementById("colorInputBox");
        const colorErrorMessage = document.getElementById("colorError");

        let selectedColors = [];

        function updateColorPlaceholder() {
            if (selectedColors.length > 0) {
                colorPlaceholder.classList.add('hidden');
            } else {
                colorPlaceholder.classList.remove('hidden');
            }
        }

        function validateColorSelection() {
            if (selectedColors.length === 0) {
                colorInputBox.classList.add('invalid');
                colorErrorMessage.classList.add('show');
                return false;
            } else {
                colorInputBox.classList.remove('invalid');
                colorErrorMessage.classList.remove('show');
                return true;
            }
        }

        colorSelect.addEventListener("change", function() {
            const selectedOption = this.options[this.selectedIndex];
            const value = selectedOption.value;
            const text = selectedOption.text;
            const color = selectedOption.getAttribute('data-color');
            const textColor = selectedOption.getAttribute('data-text-color');

            if (value && !selectedColors.includes(value)) {
                selectedColors.push(value);

                const tag = document.createElement("div");
                tag.classList.add("tag");
                tag.innerHTML = `${text} <button type="button" data-value="${value}" aria-label="Remove ${text}">&times;</button>`;

                if (color) {
                    tag.style.backgroundColor = color;
                    tag.style.color = textColor;
                }

                colorContainer.appendChild(tag);
                updateColorPlaceholder();
                validateColorSelection();
            }

            this.selectedIndex = 0;
        });

        colorContainer.addEventListener("click", function(e) {
            if (e.target.tagName === "BUTTON") {
                const value = e.target.getAttribute("data-value");
                selectedColors = selectedColors.filter(v => v !== value);
                e.target.parentElement.remove();
                updateColorPlaceholder();
                validateColorSelection();
            }
        });

        updateColorPlaceholder();
    }

    // Image Upload Functionality
    const fileInput = document.getElementById("myFiles");
    if (fileInput) {
        const previewContainer = document.getElementById("previewContainer");

        fileInput.addEventListener("change", function (event) {
            const files = Array.from(event.target.files);

            files.forEach((file) => {
                const reader = new FileReader();
                const previewItem = document.createElement("div");
                previewItem.classList.add("preview-item");

                const img = document.createElement("img");
                const removeBtn = document.createElement("button");
                removeBtn.classList.add("remove-btn");
                removeBtn.innerHTML = "&times;";
                removeBtn.setAttribute("type", "button");

                const progressBar = document.createElement("div");
                progressBar.classList.add("progress-bar");

                previewItem.appendChild(img);
                previewItem.appendChild(removeBtn);
                previewItem.appendChild(progressBar);
                previewContainer.appendChild(previewItem);

                // Add event listener to remove button immediately
                removeBtn.addEventListener("click", function () {
                    previewItem.remove();
                });

                let progress = 0;
                const fakeUpload = setInterval(() => {
                    progress += 10;
                    progressBar.style.width = progress + "%";
                    if (progress >= 100) {
                        clearInterval(fakeUpload);
                        progressBar.style.width = "100%";
                        setTimeout(() => {
                            progressBar.style.display = "none";
                        }, 500);
                    }
                }, 100);

                reader.onload = function (e) {
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });

            // Reset input so same file can be re-added
            fileInput.value = "";
        });
    }

    // Toggle Switch Functionality
    const toggleSwitch = document.getElementById('toggleSwitch');
    if (toggleSwitch) {
        const label = document.querySelector('.status-label');

        toggleSwitch.addEventListener('change', () => {
            if (label) {
                label.textContent = toggleSwitch.checked ? 'Active' : 'Inactive';
            }
        });
    }
});




class ProductCRUD {
    constructor() {
        this.init();
    }

    init() {
        this.handleImageUpload();
        this.handleTagSelection();
        this.handleFormSubmit();
        this.handleEditProduct();
        this.handleDeleteProduct();
        this.handleDeleteImage();
    }

    // Image Upload Preview
    handleImageUpload() {
        const fileInput = document.getElementById('myFiles');
        const previewContainer = document.getElementById('previewContainer');

        fileInput.addEventListener('change', function(e) {
            const files = e.target.files;
            previewContainer.innerHTML = '';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const preview = document.createElement('div');
                    preview.className = 'image-preview';
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-image" data-index="${i}">×</button>
                    `;
                    previewContainer.appendChild(preview);
                }

                reader.readAsDataURL(file);
            }
        });

        // Remove image preview
        previewContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-image')) {
                e.target.parentElement.remove();
                // You might want to update the file input here
            }
        });
    }

    // Tag Selection for Categories, Sizes, Colors
    handleTagSelection() {
        this.setupTagBox('categorySelect', 'selectedTags', 'placeholderText');
        this.setupTagBox('sizeSelect', 'selectedSizes', 'sizePlaceholderText');
        this.setupTagBox('colorSelect', 'selectedColors', 'colorPlaceholderText', true);
    }

    setupTagBox(selectId, tagsContainerId, placeholderId, isColor = false) {
        const select = document.getElementById(selectId);
        const tagsContainer = document.getElementById(tagsContainerId);
        const placeholder = document.getElementById(placeholderId);

        select.addEventListener('change', function(e) {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                placeholder.style.display = 'none';
                
                const tag = document.createElement('div');
                tag.className = 'tag';
                tag.dataset.value = selectedOption.value;
                
                if (isColor) {
                    const color = selectedOption.getAttribute('data-color');
                    const textColor = selectedOption.getAttribute('data-text-color');
                    tag.style.backgroundColor = color;
                    tag.style.color = textColor;
                }
                
                tag.innerHTML = `
                    ${selectedOption.text}
                    <span class="remove-tag">×</span>
                `;
                
                tagsContainer.appendChild(tag);
                
                // Reset select
                this.selectedIndex = 0;
            }
        });

        // Remove tag
        tagsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-tag')) {
                e.target.parentElement.remove();
                if (tagsContainer.children.length === 0) {
                    placeholder.style.display = 'inline';
                }
            }
        });
    }

    // Form Submission
    handleFormSubmit() {
        const form = document.querySelector('.form-add-product');
        const submitBtn = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            if (!this.validateForm()) {
                return;
            }

            const formData = new FormData();
            const formElements = form.elements;

            // Add form data
            for (let element of formElements) {
                if (element.name && element.type !== 'file') {
                    if (element.type === 'checkbox') {
                        formData.append(element.name, element.checked ? 'active' : 'inactive');
                    } else {
                        formData.append(element.name, element.value);
                    }
                }
            }

            // Add tags data
            formData.append('sizes', this.getSelectedValues('selectedSizes'));
            formData.append('colors', this.getSelectedValues('selectedColors'));
            formData.append('category_id', this.getSelectedValues('selectedTags')[0]);

            // Add images
            const fileInput = document.getElementById('myFiles');
            for (let i = 0; i < fileInput.files.length; i++) {
                formData.append('images[]', fileInput.files[i]);
            }

            try {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Adding Product...';

                const response = await fetch('/admin/products/store', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                });

                const result = await response.json();

                if (result.status === 'success') {
                    this.showNotification('Product added successfully!', 'success');
                    setTimeout(() => {
                        window.location.href = '/admin/products';
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
                submitBtn.disabled = false;
                submitBtn.textContent = 'Add Product';
            }
        });
    }

    // Edit Product
    handleEditProduct() {
        document.addEventListener('click', async (e) => {
            if (e.target.classList.contains('edit-product')) {
                e.preventDefault();
                const productId = e.target.dataset.id;
                
                try {
                    const response = await fetch(`/admin/products/${productId}/get`);
                    const result = await response.json();
                    
                    if (result.status === 'success') {
                        this.populateEditForm(result.product);
                    } else {
                        this.showNotification(result.message, 'error');
                    }
                } catch (error) {
                    this.showNotification('Error loading product data', 'error');
                    console.error('Error:', error);
                }
            }
        });
    }

    // Delete Product
    handleDeleteProduct() {
        document.addEventListener('click', async (e) => {
            if (e.target.classList.contains('delete-product')) {
                e.preventDefault();
                
                if (!confirm('Are you sure you want to delete this product?')) {
                    return;
                }

                const productId = e.target.dataset.id;
                
                try {
                    const response = await fetch(`/admin/products/${productId}/delete`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        this.showNotification('Product deleted successfully!', 'success');
                        // Remove product row from table
                        e.target.closest('tr').remove();
                    } else {
                        this.showNotification(result.message, 'error');
                    }
                } catch (error) {
                    this.showNotification('Error deleting product', 'error');
                    console.error('Error:', error);
                }
            }
        });
    }

    // Delete Image
    handleDeleteImage() {
        document.addEventListener('click', async (e) => {
            if (e.target.classList.contains('delete-image')) {
                e.preventDefault();
                
                if (!confirm('Are you sure you want to delete this image?')) {
                    return;
                }

                const imageId = e.target.dataset.id;
                
                try {
                    const response = await fetch(`/admin/products/image/${imageId}/delete`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (result.status === 'success') {
                        this.showNotification('Image deleted successfully!', 'success');
                        e.target.closest('.image-preview').remove();
                    } else {
                        this.showNotification(result.message, 'error');
                    }
                } catch (error) {
                    this.showNotification('Error deleting image', 'error');
                    console.error('Error:', error);
                }
            }
        });
    }

    // Helper Methods
    validateForm() {
        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => {
            el.style.display = 'none';
        });

        // Check category
        if (document.getElementById('selectedTags').children.length === 0) {
            document.getElementById('categoryError').style.display = 'block';
            isValid = false;
        }

        // Check sizes
        if (document.getElementById('selectedSizes').children.length === 0) {
            document.getElementById('sizeError').style.display = 'block';
            isValid = false;
        }

        // Check colors
        if (document.getElementById('selectedColors').children.length === 0) {
            document.getElementById('colorError').style.display = 'block';
            isValid = false;
        }

        return isValid;
    }

    getSelectedValues(containerId) {
        const container = document.getElementById(containerId);
        const tags = container.querySelectorAll('.tag');
        return Array.from(tags).map(tag => tag.dataset.value);
    }

    populateEditForm(product) {
        // Populate form fields with product data
        // This would depend on your edit form structure
        console.log('Populating form with:', product);
        // Implementation for populating edit form
    }

    displayValidationErrors(errors) {
        for (const [field, messages] of Object.entries(errors)) {
            const input = document.querySelector(`[name="${field}"]`);
            if (input) {
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message';
                errorDiv.textContent = messages[0];
                input.parentNode.appendChild(errorDiv);
            }
        }
    }

    showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        
        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            z-index: 1000;
            font-weight: bold;
        `;
        
        if (type === 'success') {
            notification.style.backgroundColor = '#28a745';
        } else {
            notification.style.backgroundColor = '#dc3545';
        }
        
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
}

// Initialize when document is ready
document.addEventListener('DOMContentLoaded', function() {
    new ProductCRUD();
});
</script>
@endpush