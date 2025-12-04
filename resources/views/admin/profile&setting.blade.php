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
                        <button class="tab-btn active" data-bs-toggle="tab" data-bs-target="#account">Account</button>
                        <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#security">Security</button>
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="tab-content">

                        <!-- ACCOUNT TAB -->
                        <div class="tab-pane fade show active" id="account">

                            <!-- PROFILE INFORMATION -->
                           <!-- PROFILE INFORMATION -->
<div class="custom-tab-card">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Profile Picture -->
        <div class="mb-3 mt-4">
            <label class="profile-form-label fs-bold">Profile Picture</label>
            <div class="profile-flex">
                <div class="preview-box">
                    <img id="previewImage" src="{{ auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('admin/images/placeholder.png') }}" alt="Preview">
                </div>
                <label class="custom-file-label" for="profileInput">
                    <i class="icon-image"></i> Change Picture
                </label>
                <input type="file" id="profileInput" name="profile_photo" class="d-none" accept="image/*">
            </div>
            @error('profile_photo')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Basic Info -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="profile-form-label">First Name</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" 
                       value="{{ old('first_name', auth()->user()->first_name) }}" placeholder="Enter first name">
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="profile-form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" 
                       value="{{ old('last_name', auth()->user()->last_name) }}" placeholder="Enter last name">
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="profile-form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', auth()->user()->email) }}" placeholder="Enter email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Gender & DOB -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="profile-form-label">Gender</label>
                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender', auth()->user()->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', auth()->user()->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', auth()->user()->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
           <div class="col-md-4">
    <label class="profile-form-label">Date of Birth</label>
    <input type="date" name="dob" 
        class="form-control @error('dob') is-invalid @enderror"
        value="{{ old('dob', auth()->user()->dob ? \Carbon\Carbon::parse(auth()->user()->dob)->format('Y-m-d') : '') }}">
    @error('dob')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

        </div>

        <!-- CONTACT DETAILS -->
        <h1>Contact Details</h1>
        
        <div class="row mb-3 mt-5">
            <div class="col-md-4">
                <label class="profile-form-label">Phone</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                       value="{{ old('phone', auth()->user()->phone) }}" placeholder="Enter phone number">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="profile-form-label">Country</label>
                <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" 
                       value="{{ old('country', auth()->user()->country) }}" placeholder="Enter country">
                @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="profile-form-label">Address</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" 
                       value="{{ old('address', auth()->user()->address) }}" placeholder="Enter address">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="tf-button btn w-auto">Update Profile</button>
        </div>
    </form>
</div>

                            <!-- CONTACT DETAILS -->
                            <!-- <div class="custom-tab-card">
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
                            </div> -->

                            <!-- <div class="mt-4">
                                <button type="submit" class="tf-button btn w-auto">Update</button>
                            </div> -->

                        </div>

                        <!-- SECURITY TAB -->
                        <!-- SECURITY TAB -->
<div class="tab-pane fade" id="security">
    <h1>Security Settings</h1>

    <form id="passwordForm" action="{{ route('admin.password.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach($errors->all() as $error)
                    <p class="mb-0">{{ $error }}</p>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row row-inputs mt-5">
            <!-- Current Password -->
            <div class="col-md-4 mb-3 position-relative">
                <label class="profile-form-label">Current Password</label>
                <input type="password" name="current_password" id="currentPassword" 
                       class="form-control @error('current_password') is-invalid @enderror" 
                       placeholder="Enter current password">
                <span class="password-toggle" onclick="togglePassword('currentPassword')">
                    <i class="fa-solid fa-eye"></i>
                </span>
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="col-md-4 mb-3 position-relative">
                <label class="profile-form-label">New Password</label>
                <input type="password" name="password" id="newPassword" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Enter new password">
                <span class="password-toggle" onclick="togglePassword('newPassword')">
                    <i class="fa-solid fa-eye"></i>
                </span>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="col-md-4 mb-3 position-relative">
                <label class="profile-form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="confirmPassword" 
                       class="form-control" placeholder="Confirm password">
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
<script>
    // Image preview functionality
document.getElementById('profileInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('previewImage');
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        
        reader.readAsDataURL(file);
    }
});
</script>

@endpush
