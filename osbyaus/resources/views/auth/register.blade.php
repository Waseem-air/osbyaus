@extends('website.layouts.main')
@section('title', 'Register')
@section('content')

<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="ec-breadcrumb-list text-left">
                    <li class="ec-breadcrumb-item">
                        <a href="{{ url('/') }}"><i class="fi-rr-home"></i></a>
                    </li>
                    <li class="ec-breadcrumb-item active">Register</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Ec breadcrumb end -->

<!-- Auth section Start -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-xl-10 col-md-12 mx-auto">
                <div class="auth-card cover">
                    <div class="row">

                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="img-wrapper">
                                <img src="{{ asset('website/assets/images/auth-image/01.png') }}" class="auth-img" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="ec-auth-content">
                                <div class="auth-head">
                                    <div class="mb-4">
                                        <img src="{{ asset('website/assets/images/logo/logo.svg') }}" alt="Logo">
                                    </div>
                                    <h2>Create Your Account</h2>
                                    <p class="text-muted">Join TechCart for a better shopping experience.</p>
                                </div>

                                <!-- REGISTER FORM -->
                                <form method="POST" action="{{ route('register') }}" class="auth-form">
                                    @csrf

                                    <div class="auth-form-content">

                                        <!-- Name -->
                                        <div class="col-12 mb-3">
                                            <label>Name</label>
                                            <input type="text"
                                                class="form-control auth-input @error('name') is-invalid @enderror"
                                                name="name"
                                                value="{{ old('name') }}"
                                                placeholder="Your name"
                                                required autocomplete="name">

                                            @error('name')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-12 mb-3">
                                            <label>Email</label>
                                            <input type="email"
                                                class="form-control auth-input @error('email') is-invalid @enderror"
                                                name="email"
                                                value="{{ old('email') }}"
                                                placeholder="Email address"
                                                required autocomplete="username">

                                            @error('email')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12 mb-3">
                                            <label>Password</label>
                                            <div class="position-relative">
                                                <input type="password"
                                                    class="form-control auth-input @error('password') is-invalid @enderror"
                                                    name="password"
                                                    placeholder="Enter password"
                                                    id="password"
                                                    required autocomplete="new-password">

                                                <span class="password-show" onclick="togglePassword('password', this)">
                                                    <i class="fi-rr-eye"></i>
                                                </span>

                                                @error('password')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-12 mb-3">
                                            <label>Confirm Password</label>
                                            <div class="position-relative">
                                                <input type="password"
                                                    class="form-control auth-input @error('password_confirmation') is-invalid @enderror"
                                                    name="password_confirmation"
                                                    placeholder="Re-enter password"
                                                    id="password_confirmation"
                                                    required autocomplete="new-password">

                                                <span class="password-show" onclick="togglePassword('password_confirmation', this)">
                                                    <i class="fi-rr-eye"></i>
                                                </span>

                                                @error('password_confirmation')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark w-100">Register</button>
                                        </div>

                                        <div class="divider"></div>

                                        <p class="auth-bottom">
                                            Already have an account?
                                            <a href="{{ route('login') }}">Sign In</a>
                                        </p>

                                    </div>
                                </form>
                                <!-- END REGISTER FORM -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Auth section End -->

@endsection
