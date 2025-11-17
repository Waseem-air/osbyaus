@extends('website.layouts.main')
@section('title', 'Reset Password')
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
                    <li class="ec-breadcrumb-item active">Reset Password</li>
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

                        <!-- Left Banner -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="img-wrapper">
                                <img src="{{ asset('website/assets/images/auth-image/01.png') }}"
                                     class="auth-img" alt="">
                            </div>
                        </div>

                        <!-- Right Form -->
                        <div class="col-lg-6">
                            <div class="ec-auth-content">

                                <div class="auth-head">
                                    <div class="mb-4">
                                        <img src="{{ asset('website/assets/images/logo/logo.svg') }}" alt="Logo">
                                    </div>
                                    <h2>Reset Your Password</h2>
                                    <p class="text-muted">
                                        Enter your new password below to regain access to your account.
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('password.store') }}" class="auth-form">
                                    @csrf

                                    <!-- Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <div class="auth-form-content">

                                        <!-- Email -->
                                        <div class="col-12 mb-3">
                                            <label>Email</label>
                                            <input type="email"
                                                class="form-control auth-input @error('email') is-invalid @enderror"
                                                name="email"
                                                value="{{ old('email', $request->email) }}"
                                                placeholder="Email address"
                                                required autocomplete="username">

                                            @error('email')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- New Password -->
                                        <div class="col-12 mb-3">
                                            <label>New Password</label>
                                            <div class="position-relative">
                                                <input type="password"
                                                    class="form-control auth-input @error('password') is-invalid @enderror"
                                                    name="password"
                                                    id="password"
                                                    placeholder="New password"
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
                                                    id="password_confirmation"
                                                    placeholder="Confirm password"
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
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-dark w-100">
                                                Reset Password
                                            </button>
                                        </div>

                                        <div class="divider"></div>

                                        <p class="auth-bottom text-center">
                                            Remembered your password?
                                            <a href="{{ route('login') }}">Sign In</a>
                                        </p>

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
<!-- Auth section End -->

@endsection
