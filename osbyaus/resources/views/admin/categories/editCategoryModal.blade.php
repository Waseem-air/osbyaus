<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content p-3">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Form -->
            <form id="editCategoryForm" enctype="multipart/form-data">
                <div class="modal-body">

                    <!-- Global Error Alert -->
                    <div id="editCategoryErrors" class="alert alert-danger d-none"></div>

                    <!-- Hidden Category ID -->
                    <input type="hidden" id="editCategoryId" name="id">

                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editCategoryName" name="name" placeholder="Enter category name" required>
                        <div class="text-danger small mt-1" id="editNameError"></div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="editCategoryDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="editCategoryDescription" name="description" placeholder="Enter category description">
                        <div class="text-danger small mt-1" id="editDescriptionError"></div>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label class="form-label">Category Image</label>
                        <div class="border rounded p-3 d-flex flex-column align-items-center justify-content-center upload-image" style="min-height:150px; cursor:pointer;">
                            <label class="d-flex flex-column align-items-center justify-content-center w-100 h-100 mb-0" for="editCategoryImage">
                                <i class="icon-upload-cloud fs-2 mb-2"></i>
                                <span class="text-muted small">Drop your image here or <span class="text-primary">click to browse</span></span>
                                <img id="editCategoryImagePreview" src="" alt="" class="img-fluid mt-2 d-none" style="max-height:120px; border-radius:4px;">
                                <input type="file" class="d-none" id="editCategoryImage" name="image" accept="image/*">

                            </label>
                        </div>
                        <div class="text-danger small mt-1" id="editImageError"></div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="tf-button style-1 w208" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tf-button style-1 w208 d-flex align-items-center" id="editCategoryBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none"></span>
                        Update Category
                    </button>
                </div>


            </form>
        </div>
    </div>
</div>

<!-- JS to preview image -->
<script>
    document.getElementById('editCategoryImage').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('editCategoryImagePreview');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.src = '';
            preview.classList.add('d-none');
        }
    });
</script>
