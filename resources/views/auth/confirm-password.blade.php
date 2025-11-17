@extends('website.layouts.main')
@section('title', 'Confirm Password')
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
                    <li class="ec-breadcrumb-item active">Confirm Password</li>
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

                        <!-- Left Image -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="img-wrapper">
                                <img src="{{ asset('website/assets/images/auth-image/01.png') }}"
                                     class="auth-img" alt="">
                            </div>
                        </div>

                        <!-- Right Content -->
                        <div class="col-lg-6">
                            <div class="ec-auth-content">

                                <div class="auth-head">
                                    <div class="mb-4">
                                        <img src="{{ asset('website/assets/images/logo/logo.svg') }}" alt="Logo">
                                    </div>

                                    <h2>Confirm Your Password</h2>
                                    <p class="text-muted">
                                        This is a secure area of the application. Please confirm your password before continuing.
                                    </p>
                                </div>

                                <!-- FORM START -->
                                <form method="POST" action="{{ route('password.confirm') }}" class="auth-form">
                                    @csrf

                                    <div class="auth-form-content">

                                        <!-- Password -->
                                        <div class="col-12 mb-3">
                                            <label>Password</label>
                                            <div class="position-relative">
                                                <input type="password"
                                                       class="form-control auth-input @error('password') is-invalid @enderror"
                                                       name="password"
                                                       id="password"
                                                       required
                                                       placeholder="Enter your password"
                                                       autocomplete="current-password">

                                                <span class="password-show" onclick="togglePassword('password', this)">
                                                    <i class="fi-rr-eye"></i>
                                                </span>

                                                @error('password')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12 mt-3">
                                            <button type="submit" class="btn btn-dark w-100">
                                                Confirm
                                            </button>
                                        </div>

                                        <div class="divider"></div>

                                        <p class="auth-bottom text-center">
                                            Want to login instead?
                                            <a href="{{ route('login') }}">Sign In</a>
                                        </p>

                                    </div>
                                </form>
                                <!-- FORM END -->

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
