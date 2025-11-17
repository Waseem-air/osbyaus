<!-- Add Color Modal -->
<div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content p-3">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addColorModalLabel">Add New Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Form -->
            <form id="addColorForm" enctype="multipart/form-data">
                <div class="modal-body">

                    <!-- Global Error Alert -->
                    <div id="addColorErrors" class="alert alert-danger d-none"></div>

                    <!-- Color Name -->
                    <div class="mb-3">
                        <label for="colorName" class="form-label">Color Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="colorName" name="name" placeholder="Enter color name" required>
                        <div class="text-danger small mt-1" id="nameError"></div>
                    </div>

                    <!-- Hex Code -->
                    <div class="mb-3">
                        <label for="colorHexCode" class="form-label">Hex Code <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="colorHexCodePicker"
                                   value="#000000" title="Choose your color">
                            <input type="text" class="form-control" id="colorHexCode" name="hex_code"
                                   placeholder="#000000" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$" required>
                        </div>
                        <div class="text-danger small mt-1" id="hexCodeError"></div>
                        <div class="form-text">Enter hex code (e.g., #FF0000) or use the color picker</div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="tf-button style-1 w208" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tf-button style-1 w208 d-flex align-items-center" id="addColorBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none"></span>
                        Save Color
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Sync color picker with hex code input
    document.getElementById('colorHexCodePicker').addEventListener('input', function(e) {
        document.getElementById('colorHexCode').value = e.target.value;
    });

    document.getElementById('colorHexCode').addEventListener('input', function(e) {
        const colorPicker = document.getElementById('colorHexCodePicker');
        if (e.target.value.match(/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/)) {
            colorPicker.value = e.target.value;
        }
    });
</script>
