@extends('website.layouts.main')
@section('title', 'Payment - Complete Your Order')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-12 col-sm-12">
                            <ul class="ec-breadcrumb-list text-left">
                                <li class="ec-breadcrumb-item"><a href="{{ route('home') }}"><i class="fi-rr-home"></i> Home</a></li>
                                <li class="ec-breadcrumb-item"><a href="{{ route('cart.index') }}">Shopping Cart</a></li>
                                <li class="ec-breadcrumb-item"><a href="{{ route('checkout') }}">Checkout</a></li>
                                <li class="ec-breadcrumb-item active">Payment</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h4 class="mb-0">Complete Your Payment</h4>
                        </div>
                        <div class="card-body">
                            <div class="order-summary mb-4">
                                <h5>Order #{{ $order->order_number }}</h5>
                                <p class="mb-2">Total Amount: <strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}</strong></p>
                            </div>

                            <div id="payment-form">
                                <div class="form-group mb-3">
                                    <label for="card-element" class="form-label">Credit or Debit Card</label>
                                    <div id="card-element" class="form-control" style="height: 40px; padding: 10px;">
                                        <!-- Stripe Elements will create form elements here -->
                                    </div>
                                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                </div>

                                <button type="button" id="submit-payment" class="btn btn-dark btn-lg w-100">
                                    <span class="btn-text">Pay {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}</span>
                                    <span class="btn-loading d-none">
                                    <i class="fi-rr-spinner spinner me-2"></i> Processing Payment...
                                </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stripe = Stripe('{{ config("services.stripe.key") }}');
            const elements = stripe.elements();

            const cardElement = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#424770',
                        '::placeholder': {
                            color: '#aab7c4',
                        },
                    },
                },
            });

            cardElement.mount('#card-element');
            const submitButton = document.getElementById('submit-payment');
            const cardErrors = document.getElementById('card-errors');
            cardElement.addEventListener('change', function(event) {
                if (event.error) {
                    cardErrors.textContent = event.error.message;
                } else {
                    cardErrors.textContent = '';
                }
            });

            submitButton.addEventListener('click', async function() {
                const btnText = submitButton.querySelector('.btn-text');
                const btnLoading = submitButton.querySelector('.btn-loading');

                // Show loading state
                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');
                submitButton.disabled = true;
                cardErrors.textContent = '';

                try {
                    const { paymentIntent, error } = await stripe.confirmCardPayment(
                        '{{ $client_secret }}', {
                            payment_method: {
                                card: cardElement,
                                billing_details: {
                                    name: '{{ $order->billing_first_name }} {{ $order->billing_last_name }}',
                                    email: '{{ $order->billing_email }}',
                                    phone: '{{ $order->billing_phone }}',
                                    address: {
                                        line1: '{{ $order->billing_address }}',
                                        city: '{{ $order->billing_city }}',
                                        state: '{{ $order->billing_state }}',
                                        country: '{{ $order->billing_country }}',
                                        postal_code: '{{ $order->billing_postal_code }}',
                                    }
                                }
                            }
                        }
                    );

                    if (error) {
                        throw new Error(error.message);
                    }

                    if (paymentIntent.status === 'succeeded') {
                        const response = await fetch('{{ route("checkout.confirm-payment", $order->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                payment_intent_id: paymentIntent.id
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            window.location.href = data.redirect_url;
                        } else {
                            throw new Error(data.message);
                        }
                    }

                } catch (error) {
                    cardErrors.textContent = error.message;
                } finally {
                    btnText.classList.remove('d-none');
                    btnLoading.classList.add('d-none');
                    submitButton.disabled = false;
                }
            });
        });
    </script>

@endsection
