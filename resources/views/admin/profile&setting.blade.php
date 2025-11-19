
@extends("admin.layout.main")
@section('content')
<style>
/* Main Tab Buttons Wrapper */
.custom-tab-btns {
    display: flex;
    width: 100%;
    gap: 10px;
}

/* Each Button */
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

/* Active Button */
.custom-tab-btns .tab-btn.active {
    background-color: #94010E1A;
    font-weight: 600;
    color: #94010E;
}

/* Card Body */
.custom-tab-card {
    background: #fff;
    padding: 25px;
    border-top: none;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
    margin-bottom: 20px;
}

.profile-form-label {
    margin-bottom: 10px;
    color: black;
    font-size: 14px;
    font-weight: 700;
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 38px;
    cursor: pointer;
    color: #000000;
    z-index: 10;
}

.form-control {
    padding-right: 45px;
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: 0.15s ease-in-out;
}
.profile-flex {
    display: flex;
    align-items: center;
    gap: 20px; /* space between image & button */
}

.preview-box {
    width: 73px;
    height: 68px;
    border-radius: 12px;
    overflow: hidden;
    background: transparent;
    border: 1px solid #ced4da;
    display: flex;
    align-items: center;
    justify-content: center;
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


.btn-primary {
    background-color: #0d6efd;
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-weight: 500;
    transition: background-color 0.2s;
}

.btn-primary:hover {
    background-color: #0b5ed7;
}

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
            <!-- Tab Buttons -->
            <div class="row">
                <div class="col-12 wg-box-1">
                    <div class="custom-tab-btns mb-0">
                        <button class="tab-btn active" data-bs-toggle="tab" data-bs-target="#account">Account</button>
                        <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#security">Security</button>
                    </div>
                </div>
            </div>

            <!-- Tab Content -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="tab-content">

                        <!-- Account Tab -->
                        <div class="tab-pane fade show active" id="account">

                            <!-- Profile Information Card -->
                            <div class="custom-tab-card">
                                <form>
<div class="mb-3 mt-4">
    <label class="profile-form-label fs-bold">Profile Picture</label>

    <div class="profile-flex">
        
        <!-- Image Preview Box -->
        <div class="preview-box">
            <img id="previewImage" src="{{ asset('admin/images/placeholder.png') }}" alt="Preview">
        </div>

        <!-- Change Picture Button -->
        <label class="custom-file-label" for="profileInput">
            <i class="icon-image"></i> Change Picture
        </label>

        <input type="file" id="profileInput" class="d-none" accept="image/*">
    </div>
</div>



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

                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="editCustomerGender" class="profile-form-label">Gender</label>
                                            <select class="form-control" id="editCustomerGender" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <div class="text-danger small mt-1" id="editGenderError"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="profile-form-label">Date of Birth</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Contact Details Card -->
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

                        <!-- Security Tab -->
                        <div class="tab-pane fade" id="security">
                            <h1>Security Settings</h1>
                            <form id="passwordForm">
                                <div class="row row-inputs mt-5">

                                    <!-- Current Password -->
                                    <div class="col-md-4 mb-3 position-relative">
                                        <label class="profile-form-label">Current Password</label>
                                        <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password">
                                        <span class="password-toggle" onclick="togglePassword('currentPassword')">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>

                                    <!-- New Password -->
                                    <div class="col-md-4 mb-3 position-relative">
                                        <label class="profile-form-label">New Password</label>
                                        <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                                        <span class="password-toggle" onclick="togglePassword('newPassword')">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-md-4 mb-3 position-relative">
                                        <label class="profile-form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password">
                                        <span class="password-toggle" onclick="togglePassword('confirmPassword')">
                                            <i class="fa-solid fa-eye"></i>
                                        </span>
                                    </div>

                                    <!-- Password Requirements -->
                                    <div class="d-flex flex-column mt-2 gap-2">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('admin/images/check-circle-1.svg') }}" alt="">
                                            <p class="ms-2 mb-0">Minimum 8 characters.</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('admin/images/check-circle-1.svg') }}" alt="">
                                            <p class="ms-2 mb-0">Use combination of uppercase and lowercase letters.</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('admin/images/check-circle-1.svg') }}" alt="">
                                            <p class="ms-2 mb-0">Use of special characters (e.g., !, @, #, $, %)</p>
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
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".custom-tab-btns .tab-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            document.querySelectorAll(".custom-tab-btns .tab-btn").forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            document.querySelectorAll(".tab-pane").forEach(tab => tab.classList.remove("show", "active"));

            let target = this.getAttribute("data-bs-target");
            document.querySelector(target).classList.add("show", "active");
        });
    });
});

function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = passwordInput.parentElement.querySelector('.password-toggle i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
<script>
document.getElementById('profileInput').addEventListener('change', function (event) {
    const reader = new FileReader();

    reader.onload = function () {
        document.getElementById('previewImage').src = reader.result;
    };

    reader.readAsDataURL(event.target.files[0]);
});
</script>

@endpush
