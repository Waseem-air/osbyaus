<!-- Edit Color Modal -->
<div class="modal fade" id="editColorModal" tabindex="-1" aria-labelledby="editColorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content p-3">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editColorModalLabel">Edit Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Form -->
            <form id="editColorForm" enctype="multipart/form-data">
                <input type="hidden" id="editColorId" name="id">

                <div class="modal-body">

                    <!-- Global Error Alert -->
                    <div id="editColorErrors" class="alert alert-danger d-none"></div>

                    <!-- Color Name -->
                    <div class="mb-3">
                        <label for="editColorName" class="form-label">Color Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editColorName" name="name" placeholder="Enter color name" required>
                        <div class="text-danger small mt-1" id="editNameError"></div>
                    </div>

                    <!-- Hex Code -->
                    <div class="mb-3">
                        <label for="editColorHexCode" class="form-label">Hex Code <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="editColorHexCodePicker"
                                   value="#000000" title="Choose your color">
                            <input type="text" class="form-control" id="editColorHexCode" name="hex_code"
                                   placeholder="#000000" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required>
                        </div>
                        <div class="text-danger small mt-1" id="editHexCodeError"></div>
                        <div class="form-text">Enter hex code (e.g., #FF0000) or use the color picker</div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="tf-button style-1 w208" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tf-button style-1 w208 d-flex align-items-center" id="editColorBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none"></span>
                        Update Color
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Sync color picker with hex code input for edit modal
    document.getElementById('editColorHexCodePicker').addEventListener('input', function(e) {
        document.getElementById('editColorHexCode').value = e.target.value;
    });

    document.getElementById('editColorHexCode').addEventListener('input', function(e) {
        const colorPicker = document.getElementById('editColorHexCodePicker');
        if (e.target.value.match(/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/)) {
            colorPicker.value = e.target.value;
        }
    });
</script>
