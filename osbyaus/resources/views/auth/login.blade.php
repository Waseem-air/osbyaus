@extends('website.layouts.main')
@section('title', 'Sign In')
@section('content')



<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="ec-breadcrumb-list text-left">
                    <li class="ec-breadcrumb-item"><a href="{{ url('/') }}"><i class="fi-rr-home"></i></a></li>
                    <li class="ec-breadcrumb-item active">Sign In</li>
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
                                    <h2>Welcome Back to TechCart</h2>
                                    <p class="text-muted">
                                        Log in to access exclusive deals, track orders, and enjoy a seamless experience.
                                    </p>
                                </div>

                                <!-- SESSION STATUS -->
                                @if (session('status'))
                                    <div class="alert alert-success mb-3">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <!-- LOGIN FORM -->
                                <form method="POST" action="{{ route('login') }}" class="auth-form">
                                    @csrf

                                    <div class="auth-form-content">

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
                                                    required autocomplete="current-password">

                                                <span class="password-show" onclick="togglePassword('password', this)">
                                                    <i class="fi-rr-eye" id="toggleIcon"></i>
                                                </span>

                                                @error('password')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Remember & Forgot -->
                                        <div class="col-12 mb-3">
                                            <div class="remember d-flex justify-content-between">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="remember">
                                                    <label>Remember me</label>
                                                </div>

                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="forgot-pass">Forgot password?</a>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark w-100">Sign In</button>
                                        </div>

                                        <div class="divider"></div>

                                        <!-- Google Login -->
                                        <div class="col-12">
                                            <button type="button" class="btn btn-dark btn-google w-100">
                                                <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="">
                                                Sign in with Google
                                            </button>
                                        </div>

                                        <p class="auth-bottom">
                                            Don't have an account?
                                            <a href="{{ route('register') }}">Create a new account</a>
                                        </p>

                                    </div>
                                </form>
                                <!-- END FORM -->

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
