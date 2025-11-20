@extends('website.layouts.main')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-12 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list text-left">
                                <li class="ec-breadcrumb-item"><a href="{{ route('home') }}"><i class="fi-rr-home"></i></a></li>
                                <li class="ec-breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                <li class="ec-breadcrumb-item active">Profile Settings</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Vendor dashboard section -->
    <section class="ec-page-content ec-vendor-dashboard section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                @include('customer.components.sidebar')

                <div class="ec-shop-rightside col-lg-9 col-md-12">

                    <!-- Error Message -->
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="ec-vendor-dashboard space-bottom-30">
                        <div class="ec-vendor-dashboard-card">
                            <div class="ec-vendor-card-setting-header">
                                <h5>Account Settings</h5>
                            </div>
                            <div class="ec-vendor-card-body">
                                <div class="container ec-vendor-card-setting-table">
                                    <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data" class="setting-form">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="setting-image mb-lg-0 mb-4">
                                                    <img src="{{ $user->profile_photo
                                                            ? asset('storage/'.$user->profile_photo)
                                                            : asset('website/assets/images/user/1.jpg') }}"
                                                         alt="User Image"
                                                         id="userImage"
                                                         class="img-fluid">
                                                    <div class="edit-avatar">
                                                        <input type="file" id="imageUpload" name="profile_photo" class="ec-image-upload"
                                                               accept="image/png, image/jpg, image/jpeg"
                                                               onchange="previewImage(event)">
                                                        <label for="imageUpload" class="change-btn">Change Image</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-9">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="first_name">First name</label>
                                                        <input type="text" class="form-control auth-input"
                                                               placeholder="First name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="last_name">Last name</label>
                                                        <input type="text" class="form-control auth-input"
                                                               placeholder="Last name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control auth-input"
                                                               placeholder="Email address" name="email" value="{{ old('email', $user->email) }}" required>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="phone">Phone Number</label>
                                                        <input type="text" class="form-control auth-input"
                                                               placeholder="Phone number" name="phone" value="{{ old('phone', $user->phone) }}">
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-dark d-grid ms-auto">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ec-vendor-dashboard space-bottom-30">
                        <div class="ec-vendor-dashboard-card">
                            <div class="ec-vendor-card-setting-header">
                                <h5>Billing Address</h5>
                            </div>
                            <div class="ec-vendor-card-body">
                                <div class="container ec-vendor-card-setting-table">
                                    <form action="{{ route('customer.profile.address.update') }}" method="POST" class="setting-form">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="first_name">First name</label>
                                                <input type="text" class="form-control auth-input"
                                                       placeholder="First name" name="first_name" value="{{ old('first_name', $user->first_name) }}" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="last_name">Last name</label>
                                                <input type="text" class="form-control auth-input"
                                                       placeholder="Last name" name="last_name" value="{{ old('last_name', $user->last_name) }}" readonly>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="address">Street Address</label>
                                                <input type="text" class="form-control auth-input"
                                                       placeholder="Address" name="address" value="{{ old('address', $user->address) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control auth-input"
                                                       placeholder="Email address" name="email" value="{{ old('email', $user->email) }}" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" class="form-control auth-input"
                                                       placeholder="Phone number" name="phone" value="{{ old('phone', $user->phone) }}" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="country">Country / Region</label>
                                                <input type="text" class="form-control auth-input"
                                                       placeholder="Country / Region" name="country" value="{{ old('country', $user->country) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control auth-input" placeholder="State"
                                                       name="state" value="{{ old('state', $user->state) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="state">City</label>
                                                <input type="text" class="form-control auth-input" placeholder="City"
                                                       name="city" value="{{ old('city', $user->state) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="postal_code">Postal Code</label>
                                                <input type="text" class="form-control auth-input"
                                                       placeholder="Postal code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}">
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-dark d-grid ms-auto">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ec-vendor-dashboard space-bottom-30">
                        <div class="ec-vendor-dashboard-card">
                            <div class="ec-vendor-card-setting-header">
                                <h5>Change Password</h5>
                            </div>
                            <div class="ec-vendor-card-body">
                                <div class="container ec-vendor-card-setting-table">
                                    <form action="{{ route('customer.profile.password.update') }}" method="POST" class="setting-form">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="current_password">Current Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control auth-input"
                                                           placeholder="Enter current password" name="current_password" id="current_password" required>
                                                    <span class="password-show" onclick="togglePassword('current_password', this)">
                                                        <i class="fi-rr-eye" id="toggleIcon"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="password">New Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control auth-input"
                                                           placeholder="Enter new password" name="password" id="password" required>
                                                    <span class="password-show" onclick="togglePassword('password', this)">
                                                        <i class="fi-rr-eye" id="toggleIcon"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="password_confirmation">Confirm New Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control auth-input"
                                                           placeholder="Confirm new password" name="password_confirmation" id="password_confirmation" required>
                                                    <span class="password-show" onclick="togglePassword('password_confirmation', this)">
                                                        <i class="fi-rr-eye" id="toggleIcon"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-dark d-grid ms-auto">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Vendor dashboard section -->
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('userImage');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function togglePassword(fieldId, element) {
            const passwordField = document.getElementById(fieldId);
            const icon = element.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fi-rr-eye');
                icon.classList.add('fi-rr-eye-crossed');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fi-rr-eye-crossed');
                icon.classList.add('fi-rr-eye');
            }
        }
    </script>
@endpush
