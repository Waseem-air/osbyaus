<!-- Add Size Modal -->
<div class="modal fade" id="addSizeModal" tabindex="-1" aria-labelledby="addSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content p-3">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addSizeModalLabel">Add New Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Form -->
            <form id="addSizeForm" enctype="multipart/form-data">
                <div class="modal-body">

                    <!-- Global Error Alert -->
                    <div id="addSizeErrors" class="alert alert-danger d-none"></div>

                    <!-- Size Name -->
                    <div class="mb-3">
                        <label for="sizeName" class="form-label">Size Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sizeName" name="name" placeholder="e.g., Extra Large" required>
                        <div class="text-danger small mt-1" id="nameError"></div>
                    </div>

                    <!-- Short Code -->
                    <div class="mb-3">
                        <label for="sizeShortCode" class="form-label">Short Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="sizeShortCode" name="short_code" placeholder="e.g., XL" required>
                        <div class="text-danger small mt-1" id="shortCodeError"></div>
                        <div class="form-text">Short code for the size (e.g., S, M, L, XL, XXL)</div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="tf-button style-1 w208" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tf-button style-1 w208 d-flex align-items-center" id="addSizeBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none"></span>
                        Save Size
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
