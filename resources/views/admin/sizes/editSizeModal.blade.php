<!-- Edit Size Modal -->
<div class="modal fade" id="editSizeModal" tabindex="-1" aria-labelledby="editSizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content p-3">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editSizeModalLabel">Edit Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Form -->
            <form id="editSizeForm" enctype="multipart/form-data">
                <input type="hidden" id="editSizeId" name="id">

                <div class="modal-body">

                    <!-- Global Error Alert -->
                    <div id="editSizeErrors" class="alert alert-danger d-none"></div>

                    <!-- Size Name -->
                    <div class="mb-3">
                        <label for="editSizeName" class="form-label">Size Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editSizeName" name="name" placeholder="e.g., Extra Large" required>
                        <div class="text-danger small mt-1" id="editNameError"></div>
                    </div>

                    <!-- Short Code -->
                    <div class="mb-3">
                        <label for="editSizeShortCode" class="form-label">Short Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editSizeShortCode" name="short_code" placeholder="e.g., XL" required>
                        <div class="text-danger small mt-1" id="editShortCodeError"></div>
                        <div class="form-text">Short code for the size (e.g., S, M, L, XL, XXL)</div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="tf-button style-1 w208" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tf-button style-1 w208 d-flex align-items-center" id="editSizeBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none"></span>
                        Update Size
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
