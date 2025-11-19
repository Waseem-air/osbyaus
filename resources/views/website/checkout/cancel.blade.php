@extends('website.layouts.main')
@section('title', 'Checkout - Stripe Cancelled')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="alert alert-danger">
                    <h2><i class="fas fa-times-circle"></i> Payment Cancelled</h2>
                </div>
                <p class="lead">{{ session('error') ?? 'Your payment was cancelled.' }}</p>
                <p>You can try again or contact support if you need assistance.</p>
                <div class="mt-4">
                    <a href="{{ route('cart.index') }}" class="btn btn-primary">Return to Cart</a>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
@endsection
