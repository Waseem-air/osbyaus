@extends("admin.layout.main")
@section('content')

<style>
/* ================= TAB BUTTONS ================= */
.custom-tab-btns {
    display: flex;
    width: 100%;
    gap: 10px;
}

.custom-tab-btns .tab-btn {
    width: 50%;
    text-align: center;
    padding: 10px 0;
    background: #ffffff;
    border-radius: 14px;
    cursor: pointer;
    font-weight: 500;
    font-size: 16px;
    transition: 0.3s;
}

.custom-tab-btns .tab-btn.active {
    background-color: #94010E1A;
    font-weight: 600;
    color: #94010E;
}

/* ================= CARD ================= */
.custom-tab-card {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    border-top: none;
    margin-bottom: 20px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
}

/* ================= BASE STYLES ================= */
.custom-tab-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    border: 1px solid #eaeaea;
}

.banner-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 0;
}

.banner-table th {
    background-color: #f8f9fa;
    font-weight: 600;
    width: 144px;
    color: #333;
    padding: 15px 12px;
    border-bottom: 2px solid #dee2e6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.banner-table td {
    padding: 15px 12px;
    vertical-align: middle;
    border-bottom: 1px solid #eaeaea;
    font-size: 14px;
    color: #555;
}

.banner-table tr:last-child td {
    border-bottom: none;
}

/* ================= IMAGE STYLING ================= */
.banner-img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #eaeaea;
}

/* ================= DETAILS CELL ================= */
.details-cell {
    max-width: 300px;
    line-height: 1.5;
}

/* ================= ACTION ICONS ================= */
.action-icons {
    white-space: nowrap;
}

.icon-btn {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    background: #f8f9fa;
    color: #666;
    margin-left: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid #eaeaea;
    font-size: 14px;
}

.icon-btn:hover {
    background: #94010E;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(148, 1, 14, 0.3);
}

/* ================= RESPONSIVE STYLES ================= */
/* Large Desktop (1200px and above) */
@media (min-width: 1200px) {
    .banner-table th,
    .banner-table td {
        padding: 18px 15px;
        font-size: 15px;
    }

    .banner-img {
        width: 100px;
        height: 70px;
    }

    .details-cell {
        max-width: 400px;
    }
}

/* Medium Desktop (992px - 1199px) */
@media (max-width: 1199px) and (min-width: 992px) {
    .banner-table th,
    .banner-table td {
        padding: 14px 10px;
        font-size: 14px;
    }

    .banner-img {
        width: 70px;
        height: 50px;
    }

    .details-cell {
        max-width: 250px;
    }
}

/* Tablet (768px - 991px) */
@media (max-width: 991px) and (min-width: 768px) {
    .custom-tab-card {
        padding: 15px;
    }

    .banner-table th,
    .banner-table td {
        padding: 12px 8px;
        font-size: 13px;
    }

    .banner-img {
        width: 60px;
        height: 45px;
    }

    .details-cell {
        max-width: 200px;
        font-size: 12px;
    }

    .icon-btn {
        width: 32px;
        height: 32px;
        margin-left: 6px;
        font-size: 12px;
    }
}

/* Mobile (577px - 767px) */
@media (max-width: 767px) and (min-width: 577px) {
    .custom-tab-card {
        padding: 12px;
        margin: 10px;
    }

    .table-responsive {
        border: 1px solid #eaeaea;
        border-radius: 8px;
        overflow: hidden;
    }

    .banner-table {
        display: block;
    }

    .banner-table thead {
        display: none;
    }

    .banner-table tbody,
    .banner-table tr,
    .banner-table td {
        display: block;
        width: 100%;
    }

    .banner-table tr {
        margin-bottom: 15px;
        padding: 15px;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        background: white;
    }

    .banner-table td {
        padding: 10px 0;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .banner-table td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #333;
        margin-right: 15px;
        min-width: 100px;
        text-transform: uppercase;
        font-size: 12px;
    }

    .banner-img {
        width: 80px;
        height: 60px;
        margin-left: auto;
    }

    .action-icons {
        justify-content: flex-end !important;
    }

    .action-icons::before {
        content: "Actions";
        font-weight: 600;
        color: #333;
        margin-right: auto;
        text-transform: uppercase;
        font-size: 12px;
    }

    .icon-btn {
        width: 36px;
        height: 36px;
        margin-left: 8px;
    }
}

/* Small Mobile (576px and below) */
@media (max-width: 576px) {
    .custom-tab-card {
        padding: 10px;
        margin: 5px;
    }

    .table-responsive {
        border: none;
    }

    .banner-table tr {
        margin-bottom: 12px;
        padding: 12px;
    }

    .banner-table td {
        padding: 8px 0;
        flex-direction: column;
        align-items: flex-start;
    }

    .banner-table td::before {
        margin-bottom: 5px;
        min-width: auto;
    }

    .banner-img {
        margin-left: 0;
        margin-top: 5px;
        width: 100%;
        max-width: 200px;
        height: auto;
        max-height: 120px;
    }

    .action-icons {
        flex-direction: row !important;
        justify-content: flex-start !important;
        width: 100%;
    }

    .action-icons::before {
        content: "Actions";
        font-weight: 600;
        color: #333;
        margin-right: auto;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        text-transform: uppercase;
        font-size: 12px;
    }

    .icon-btn {
        width: 40px;
        height: 40px;
        margin: 0 5px;
    }

    .details-cell {
        max-width: 100%;
    }
}

/* ================= ENHANCED MOBILE LAYOUT ================= */
@media (max-width: 767px) {
    .banner-table td {
        border-bottom: 1px solid #f0f0f0;
    }

    .banner-table td:last-child {
        border-bottom: none;
    }

    .banner-table tr:last-child {
        margin-bottom: 0;
    }
}

/* ================= ACCESSIBILITY ================= */
@media (prefers-reduced-motion: reduce) {
    .icon-btn {
        transition: none;
    }
}

/* ================= DARK MODE SUPPORT ================= */
@media (prefers-color-scheme: dark) {
    .custom-tab-card {
        background: #2d3748;
        border-color: #4a5568;
        color: #e2e8f0;
    }

    .banner-table th {
        background-color: #4a5568;
        color: #e2e8f0;
        border-bottom-color: #718096;
    }

    .banner-table td {
        border-bottom-color: #4a5568;
        color: #cbd5e0;
    }

    .icon-btn {
        background: #4a5568;
        color: #cbd5e0;
        border-color: #718096;
    }

    @media (max-width: 767px) {
        .banner-table tr {
            background: #2d3748;
            border-color: #4a5568;
        }

        .banner-table td {
            border-bottom-color: #4a5568;
        }
    }
}

.profile-form-label {
    font-size: 16px !important;
    margin-bottom: 20px;
    font-weight: 800px !important;
}
#addCategoryOffcanvas {
    width: 400px;
    max-width: 90%;
}

/* File input dashed style */
.custom-file-drop {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 20px;
    border: 2px dashed #94010E;
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
    color: #94010E;
    font-size: 14px;
    height: 100px;
    transition: background 0.3s;
}

.custom-file-drop i {
    font-size: 24px;
    margin-bottom: 5px;
}

/* Preview image */
.banner-preview {
    width: 100%;
    max-height: 180px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #eaeaea;
}

/* Save button style */
.save-btn {
    background-color: #94010E;
    color: white;
    border: none;
    transition: all 0.3s;
}

.save-btn:hover {
    background-color: transparent;
    color: #94010E;
    border: 1px solid #94010E;
}
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <h1>Store Banners</h1>

            <!-- TAB BUTTONS -->
            <div class="row mt-5">
                <div class="col-12 wg-box-1">
                    <div class="custom-tab-btns mb-0">
                        <button class="tab-btn active" data-bs-toggle="tab" data-bs-target="#account">Hero Banner</button>
                        <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#security">Top Banner</button>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="search-bar-container mb-2 mt-4">
                <!-- Search Form -->
                <form class="form-search">
                    <fieldset class="name">
                        <input type="text" id="searchCategory" placeholder="Search categories..." name="search">
                    </fieldset>
                </form>

                <!-- Add New Button -->
                <button class="tf-button style-1 w208" data-bs-toggle="offcanvas" data-bs-target="#addCategoryOffcanvas">
                    <i class="icon-plus"></i> Add New Banner
                </button>

            </div>

            <!-- TAB CONTENT -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="tab-content">

                        <!-- ACCOUNT TAB -->
                        <div class="tab-pane fade show active" id="account">

                            <!-- PROFILE INFORMATION -->
                            <div class="custom-tab-card mt-4">
                                <h4 class="mb-3 fw-bold">Banner List</h4>

                                <div class="table-responsive">
                                    <table class="table banner-table">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Top Text</th>
                                                <th>Main Title</th>
                                                <th>Sub Title</th>
                                                <th>Details</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('admin/images/placeholder.png') }}" class="banner-img">
                                                </td>

                                                <td data-label="Top Text">Flat Sale</td>
                                                <td data-label="Main Title">50% Off</td>
                                                <td data-label="Sub Title">READY TO WEAR</td>

                                                <td data-label="Details" class="details-cell">
                                                    Explore our curated collection of trendy outfits and timeless classics.
                                                    Your next favorite look is just a click away!
                                                </td>

                                                <td class="text-end action-icons">
                                                    <i class="fi fi-rr-edit icon-btn"></i>
                                                    <i class="fi fi-rr-trash icon-btn"></i>
                                                    <i class="fi fi-rr-lock icon-btn"></i>
                                                </td>
                                            </tr>

                                            <!-- Additional rows for demonstration -->
                                            <tr>
                                                <td>
                                                    <img src="{{ asset('admin/images/placeholder.png') }}" class="banner-img">
                                                </td>

                                                <td data-label="Top Text">Summer Sale</td>
                                                <td data-label="Main Title">30% Off</td>
                                                <td data-label="Sub Title">SUMMER COLLECTION</td>

                                                <td data-label="Details" class="details-cell">
                                                    Get ready for summer with our exclusive collection of beachwear and casual outfits.
                                                </td>

                                                <td class="text-end action-icons">
                                                    <i class="fi fi-rr-edit icon-btn"></i>
                                                    <i class="fi fi-rr-trash icon-btn"></i>
                                                    <i class="fi fi-rr-lock icon-btn"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <!-- SECURITY TAB -->
                        <div class="tab-pane fade" id="security">

                            <h1>Top Banner</h1>

                            <form id="passwordForm">
                                <div class="row row-inputs mt-5">

                                    <!-- TEXT HERE Field -->
                                    <div class="col-12 mb-3">
                                        <label class="profile-form-label fw-bold">Text Here</label>
                                        <textarea class="form-control" rows="4" placeholder="Enter text here..."></textarea>
                                    </div>

                                </div>

                                <!-- Save Button -->
                                <div class="mt-3">
                                    <button type="submit" class="tf-button btn w-auto">Save</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="addCategoryOffcanvas" aria-labelledby="addCategoryOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="addCategoryOffcanvasLabel">Add New Banner</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  
  <div class="offcanvas-body">

    <!-- Heading -->
    <h6>Image Product</h6>
    <p>Note: Format photos SVG, PNG, or JPG (Max size 4mb)</p>

    <!-- Image Input with Dashed Border -->
    <div class="mb-3 mt-3">
        <label for="bannerImageInput" class="custom-file-drop">
            <i class="icon-image"></i>
            <span>Drop your image here, or browse (JPEG, PNG are allowed)</span>
        </label>
        <input type="file" id="bannerImageInput" accept=".svg,.png,.jpg,.jpeg" class="d-none">
        <img id="bannerPreview" src="{{ asset('admin/images/placeholder.png') }}" alt="Preview" class="mt-3 banner-preview">
    </div>

    <!-- Top Text -->
    <div class="mb-3">
        <label class="form-label">Top Text</label>
        <input type="text" class="form-control" placeholder="Enter top text">
    </div>

    <!-- Main Title -->
    <div class="mb-3">
        <label class="form-label">Main Title</label>
        <input type="text" class="form-control" placeholder="Enter main title">
    </div>

    <!-- Sub Title -->
    <div class="mb-3">
        <label class="form-label">Sub Title</label>
        <input type="text" class="form-control" placeholder="Enter sub title">
    </div>

    <!-- Details -->
    <div class="mb-3">
        <label class="form-label">Details</label>
        <textarea class="form-control" rows="4" placeholder="Enter details here..."></textarea>
    </div>

    <!-- Save Button -->
    <div class="mb-3">
        <button type="button" class="tf-button btn w-100 save-btn">Save</button>
    </div>

  </div>
</div>

@endsection

@push('scripts')

<script>
/* TAB SWITCHING */
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".custom-tab-btns .tab-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            document.querySelectorAll(".tab-pane").forEach(tab =>
                tab.classList.remove("show", "active")
            );

            document.querySelector(this.dataset.bsTarget).classList.add("show", "active");
        });
    });
});

/* PASSWORD TOGGLE */
function togglePassword(id) {
    const input = document.getElementById(id);
    const icon = input.parentElement.querySelector(".password-toggle i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye");
    }
}
</script>

<script>
/* IMAGE PREVIEW */
document.getElementById("profileInput").addEventListener("change", event => {
    const reader = new FileReader();
    reader.onload = () => document.getElementById("previewImage").src = reader.result;
    reader.readAsDataURL(event.target.files[0]);
});
</script>
<script>
document.getElementById('bannerImageInput').addEventListener('change', function(event){
    const reader = new FileReader();
    reader.onload = function(e){
        document.getElementById('bannerPreview').src = e.target.result;
    }
    reader.readAsDataURL(event.target.files[0]);
});
</script>

@endpush
