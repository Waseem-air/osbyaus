<div id="ec-side-size-chart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">Custom Size - {{ $product->name }}</span>
                <button class="ec-close" type="button">×</button>
            </div>
            <form id="custom-size-form" data-product-id="{{ $product->id }}">
                @csrf
                <div class="ec-size-from">
                    <div class="row gy-4">
                        <div class="col-12 mb-3">
                            <h5 class="text-dark fw-semibold">Shirt Measurements (in inches)</h5>
                        </div>
                        <div class="col-sm-6">
                            <label for="shirt_length">Shirt Length *</label>
                            <input type="number" name="custom_size[shirt_length]" class="form-control" placeholder="Enter Size" step="0.1" min="0" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="shoulder">Shoulder *</label>
                            <input type="number" name="custom_size[shoulder]" class="form-control" placeholder="Enter Size" step="0.1" min="0" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="chest">Chest *</label>
                            <input type="number" name="custom_size[chest]" class="form-control" placeholder="Enter Size" step="0.1" min="0" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="waist">Waist *</label>
                            <input type="number" name="custom_size[waist]" class="form-control" placeholder="Enter Size" step="0.1" min="0" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="hips">Hips</label>
                            <input type="number" name="custom_size[hips]" class="form-control" placeholder="Enter Size" step="0.1" min="0">
                        </div>
                        <div class="col-sm-6">
                            <label for="sleeves_length">Sleeves Length *</label>
                            <input type="number" name="custom_size[sleeves_length]" class="form-control" placeholder="Enter Size" step="0.1" min="0" required>
                        </div>

                        <div class="col-12">
                            <div class="size-divider"></div>
                        </div>

                        <div class="col-12 mb-3">
                            <h5 class="text-dark fw-semibold">Trouser Measurements (in inches)</h5>
                        </div>
                        <div class="col-sm-6">
                            <label for="waist_stretch">Waist Stretch</label>
                            <input type="number" name="custom_size[waist_stretch]" class="form-control" placeholder="Enter Size" step="0.1" min="0">
                        </div>
                        <div class="col-sm-6">
                            <label for="waist_relax">Waist Relax</label>
                            <input type="number" name="custom_size[waist_relax]" class="form-control" placeholder="Enter Size" step="0.1" min="0">
                        </div>
                        <div class="col-sm-6">
                            <label for="thigh">Thigh</label>
                            <input type="number" name="custom_size[thigh]" class="form-control" placeholder="Enter Size" step="0.1" min="0">
                        </div>
                        <div class="col-sm-6">
                            <label for="calf">Calf</label>
                            <input type="number" name="custom_size[calf]" class="form-control" placeholder="Enter Size" step="0.1" min="0">
                        </div>
                        <div class="col-sm-6">
                            <label for="trouser_bottom">Trouser Bottom (Paincha)</label>
                            <input type="number" name="custom_size[trouser_bottom]" class="form-control" placeholder="Enter Size" step="0.1" min="0">
                        </div>
                        <div class="col-sm-6">
                            <label for="trouser_length">Trouser Length</label>
                            <input type="number" name="custom_size[trouser_length]" class="form-control" placeholder="Enter Size" step="0.1" min="0">
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="additional_notes">Additional Notes</label>
                                <textarea name="custom_size[additional_notes]" class="form-control" placeholder="Any special instructions or additional measurements..." rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-column gap-3">
                                <button type="submit" class="btn btn-dark p-2 h-auto add-custom-size-to-cart">
                                    <i class="fi-rr-shopping-cart me-2"></i> Add Custom Size to Cart
                                </button>
                                <button type="button" class="btn btn-outline-secondary p-2 h-auto close-custom-size">
                                    <i class="fi-rr-cross me-2"></i> Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
