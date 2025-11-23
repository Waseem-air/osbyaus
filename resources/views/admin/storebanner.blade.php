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

.profile-form-label {
    font-size: 14px;
    font-weight: 700;
    color: #000;
    margin-bottom: 10px;
}

/* ================= FORM ================= */
.form-control {
    padding-right: 45px;
    padding: 12px 15px;
    border-radius: 8px;
    background-color: #EEEEEE;
    border: 1px solid #ced4da;
    transition: 0.15s ease-in-out;
}

/* ================= PASSWORD TOGGLE ================= */
.password-toggle {
    position: absolute;
    right: 15px;
    top: 38px;
    cursor: pointer;
    color: #000000;
    z-index: 10;
}

/* ================= PROFILE PICTURE FLEX ================= */
.profile-flex {
    display: flex;
    align-items: center;
    gap: 20px;
}

.preview-box {
    width: 73px;
    height: 68px;
    border-radius: 12px;
    overflow: hidden;
    background: transparent;
    border: 1px solid #ced4da;
    display: flex;
    justify-content: center;
    align-items: center;
}

.preview-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.custom-file-label {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 15px 22px;
    border-radius: 12px;
    background: transparent;
    border: 1px solid #B0B0B0;
    cursor: pointer;
    font-size: 14px;
}

.custom-file-label i {
    font-size: 16px;
}

/* ================= BUTTONS ================= */
.btn-primary {
    background-color: #0d6efd;
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-weight: 500;
    transition: 0.2s;
}

.btn-primary:hover {
    background-color: #0b5ed7;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .row-inputs {
        flex-direction: column;
    }
    .password-toggle {
        top: 38px;
    }
}
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

            <h1>Settings & Management</h1>

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
                    <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
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
                            <div class="custom-tab-card">
                                <form>

                                    <!-- Profile Picture -->
                                    <div class="mb-3 mt-4">
                                        <label class="profile-form-label fs-bold">Profile Picture</label>

                                        <div class="profile-flex">
                                            <div class="preview-box">
                                                <img id="previewImage" src="{{ asset('admin/images/placeholder.png') }}" alt="Preview">
                                            </div>

                                            <label class="custom-file-label" for="profileInput">
                                                <i class="icon-image"></i> Change Picture
                                            </label>

                                            <input type="file" id="profileInput" class="d-none" accept="image/*">
                                        </div>
                                    </div>

                                    <!-- Basic Info -->
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="profile-form-label">First Name</label>
                                            <input type="text" class="form-control" placeholder="Enter first name">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="profile-form-label">Last Name</label>
                                            <input type="text" class="form-control" placeholder="Enter last name">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="profile-form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Enter email">
                                        </div>
                                    </div>

                                    <!-- Gender & DOB -->
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label class="profile-form-label">Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="profile-form-label">Date of Birth</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <!-- CONTACT DETAILS -->
                            <div class="custom-tab-card">
                                <h1>Contact Details</h1>

                                <form>
                                    <div class="row mb-3 mt-5">
                                        <div class="col-md-4">
                                            <label class="profile-form-label">Phone</label>
                                            <input type="text" class="form-control" placeholder="Enter phone number">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="profile-form-label">Country</label>
                                            <input type="text" class="form-control" placeholder="Enter country">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="profile-form-label">Address</label>
                                            <input type="text" class="form-control" placeholder="Enter address">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="tf-button btn w-auto">Update</button>
                            </div>

                        </div>

                        <!-- SECURITY TAB -->
                        <div class="tab-pane fade" id="security">

                            <h1>Security Settings</h1>

                            <form id="passwordForm">

                                <div class="row row-inputs mt-5">

                                    <!-- Current Password -->
                                    <div class="col-md-4 mb-3 position-relative">
                                        <label class="profile-form-label">Current Password</label>
                                        <input type="password" id="currentPassword" class="form-control" placeholder="Enter current password">

                                        <span class="password-toggle" onclick="togglePassword('currentPassword')">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>

                                    <!-- New Password -->
                                    <div class="col-md-4 mb-3 position-relative">
                                        <label class="profile-form-label">New Password</label>
                                        <input type="password" id="newPassword" class="form-control" placeholder="Enter new password">

                                        <span class="password-toggle" onclick="togglePassword('newPassword')">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-md-4 mb-3 position-relative">
                                        <label class="profile-form-label">Confirm Password</label>
                                        <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password">

                                        <span class="password-toggle" onclick="togglePassword('confirmPassword')">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>

                                    <!-- Requirements -->
                                    <div class="d-flex flex-column mt-2 gap-2">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('admin/images/check-circle-1.svg') }}" alt="">
                                            <p class="ms-2 mb-0">Minimum 8 characters.</p>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('admin/images/check-circle-1.svg') }}" alt="">
                                            <p class="ms-2 mb-0">Use uppercase & lowercase letters.</p>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('admin/images/check-circle-1.svg') }}" alt="">
                                            <p class="ms-2 mb-0">Use special characters (! @ # $ %)</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="tf-button btn w-auto">Update Password</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>

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

@endpush
