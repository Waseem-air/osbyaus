@extends('website.layouts.main')
@section('title', 'Forgot Password')
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
                    <li class="ec-breadcrumb-item active">Forgot Password</li>
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
                                    <h2>Forgot Your Password?</h2>
                                    <p class="text-muted">
                                        No problem. Enter your email and we'll send you a password reset link.
                                    </p>
                                </div>

                                <!-- SESSION STATUS -->
                                @if (session('status'))
                                    <div class="alert alert-success mb-3">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <!-- FORGOT PASSWORD FORM -->
                                <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                                    @csrf

                                    <div class="auth-form-content">

                                        <!-- Email -->
                                        <div class="col-12 mb-3">
                                            <label>Email Address</label>
                                            <input type="email"
                                                class="form-control auth-input @error('email') is-invalid @enderror"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required autofocus
                                                placeholder="Enter your email">

                                            @error('email')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark w-100">
                                                Email Password Reset Link
                                            </button>
                                        </div>

                                        <div class="divider"></div>

                                        <p class="auth-bottom text-center">
                                            Remember your password?
                                            <a href="{{ route('login') }}">Sign In</a>
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
