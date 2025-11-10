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
                                                <input type="text" placeholder="Choose category" name="sku" tabindex="0" aria-required="true" required>
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
                                                        <!-- Clothing Sizes -->
                                                        <optgroup label="Women's Clothing">
                                                            <option value="xs">XS (Extra Small)</option>
                                                            <option value="s">S (Small)</option>
                                                            <option value="m">M (Medium)</option>
                                                            <option value="l">L (Large)</option>
                                                            <option value="xl">XL (Extra Large)</option>
                                                            <option value="2xl">2XL (Double Extra Large)</option>
                                                            <option value="3xl">3XL (Triple Extra Large)</option>
                                                        </optgroup>
                                                        <optgroup label="Men's Clothing">
                                                            <option value="s-men">S (Small)</option>
                                                            <option value="m-men">M (Medium)</option>
                                                            <option value="l-men">L (Large)</option>
                                                            <option value="xl-men">XL (Extra Large)</option>
                                                            <option value="2xl-men">2XL (Double Extra Large)</option>
                                                            <option value="3xl-men">3XL (Triple Extra Large)</option>
                                                        </optgroup>
                                                        <optgroup label="Kids Clothing">
                                                            <option value="2t">2T</option>
                                                            <option value="3t">3T</option>
                                                            <option value="4t">4T</option>
                                                            <option value="5t">5T</option>
                                                            <option value="6y">6 Years</option>
                                                            <option value="8y">8 Years</option>
                                                            <option value="10y">10 Years</option>
                                                            <option value="12y">12 Years</option>
                                                            <option value="14y">14 Years</option>
                                                        </optgroup>
                                                        <!-- Footwear Sizes -->
                                                        <optgroup label="Women's Footwear">
                                                            <option value="5-w">5</option>
                                                            <option value="6-w">6</option>
                                                            <option value="7-w">7</option>
                                                            <option value="8-w">8</option>
                                                            <option value="9-w">9</option>
                                                            <option value="10-w">10</option>
                                                        </optgroup>
                                                        <optgroup label="Men's Footwear">
                                                            <option value="7-m">7</option>
                                                            <option value="8-m">8</option>
                                                            <option value="9-m">9</option>
                                                            <option value="10-m">10</option>
                                                            <option value="11-m">11</option>
                                                            <option value="12-m">12</option>
                                                        </optgroup>
                                                        <optgroup label="Kids Footwear">
                                                            <option value="1k">1</option>
                                                            <option value="2k">2</option>
                                                            <option value="3k">3</option>
                                                            <option value="4k">4</option>
                                                            <option value="5k">5</option>
                                                            <option value="6k">6</option>
                                                            <option value="7k">7</option>
                                                            <option value="8k">8</option>
                                                            <option value="9k">9</option>
                                                            <option value="10k">10</option>
                                                            <option value="11k">11</option>
                                                            <option value="12k">12</option>
                                                            <option value="13k">13</option>
                                                        </optgroup>
                                                        <!-- Numeric Sizes -->
                                                        <optgroup label="Numeric Sizes">
                                                            <option value="28">28</option>
                                                            <option value="30">30</option>
                                                            <option value="32">32</option>
                                                            <option value="34">34</option>
                                                            <option value="36">36</option>
                                                            <option value="38">38</option>
                                                            <option value="40">40</option>
                                                            <option value="42">42</option>
                                                            <option value="44">44</option>
                                                            <option value="46">46</option>
                                                            <option value="48">48</option>
                                                        </optgroup>
                                                        <!-- One Size -->
                                                        <option value="one-size">One Size</option>
                                                        <option value="free-size">Free Size</option>
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