@extends('website.layouts.main')
@section('title', 'Checkout - Shipping Details')
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
                                <li class="ec-breadcrumb-item active">Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <section class="ec-page-content cart_page checkout section-space-p">
        <div class="container">
            <div class="row">
                <div class="checkout-header">
                    <h2>Shipping Details</h2>
                </div>
            </div>
            <div class="row">
                <!-- Billing Area Start -->
                <div class="ec-cart-leftside col-lg-8 col-md-12">
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <form id="checkoutForm">
                                @csrf
                                <div class="ec-cart-inner-billing-address">
                                    <h4>Billing Address</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>First Name</label>
                                            <input type="text" name="billing_first_name" class="form-control billing-input"
                                                   value="{{ $user->first_name }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Last Name</label>
                                            <input type="text" name="billing_last_name" class="form-control billing-input"
                                                   value="{{ $user->last_name }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Phone</label>
                                            <input type="text" name="billing_phone" class="form-control billing-input"
                                                   value="{{ $user->phone }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <input type="email" name="billing_email" class="form-control billing-input"
                                                   value="{{ $user->email }}" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Address</label>
                                            <textarea name="billing_address" rows="3" class="form-control" required>{{ $user->address }}</textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label>City</label>
                                            <input type="text" name="billing_city" class="form-control billing-input"
                                                   value="{{ $user->city }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>State</label>
                                            <input type="text" name="billing_state" class="form-control billing-input"
                                                   value="{{ $user->state }}" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Postal Code</label>
                                            <input type="text" name="billing_postal_code" class="form-control billing-input"
                                                   value="{{ $user->postal_code }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="ec-cart-inner-shipping-address mt-4">
                                    <div class="accordion" id="shippingAccordion">
                                        <div class="accordion-item">
                                            <div class="accordion-header" id="headingOne">
                                                <div class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                     data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    <input class="form-check-input" type="checkbox" id="ship-different-address" value="1">
                                                    <label for="ship-different-address" class="m-0"> Ship to a different address</label>
                                                </div>
                                            </div>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                                 data-bs-parent="#shippingAccordion">
                                                <div class="accordion-body">
                                                    <h5>Shipping Address</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>First Name</label>
                                                            <input type="text" name="shipping_first_name" class="form-control shipping-input">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Last Name</label>
                                                            <input type="text" name="shipping_last_name" class="form-control shipping-input">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Phone</label>
                                                            <input type="text" name="shipping_phone" class="form-control shipping-input">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Email</label>
                                                            <input type="email" name="shipping_email" class="form-control shipping-input">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Address</label>
                                                            <textarea name="shipping_address" rows="3" class="form-control shipping-input"></textarea>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>City</label>
                                                            <input type="text" name="shipping_city" class="form-control shipping-input">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>State</label>
                                                            <input type="text" name="shipping_state" class="form-control shipping-input">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label>Postal Code</label>
                                                            <input type="text" name="shipping_postal_code" class="form-control shipping-input">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ec-cart-inner-additional-address mt-4">
                                    <div class="checkout-header">
                                        <h2>Additional Info</h2>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Order Notes (Optional)</label>
                                        <textarea name="order_notes" class="form-control" rows="3"
                                                  placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-dark btn-lg w-100" id="checkoutBtn">
                                        <span class="btn-text">Proceed to Payment</span>
                                        <span class="btn-loading d-none">
                                        <i class="fi-rr-spinner spinner me-2"></i> Processing...
                                    </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Checkout Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <div class="ec-sidebar-block border-0">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Cart Total</h3>
                            </div>

                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">

                                        {{-- Cart Items --}}
                                        @foreach($cart->items as $item)
                                            <div>
                                                <div class="ec-cart-summary-inner">
                                                    <img src="{{ asset($item->product->main_image?->image_path ?? 'website/assets/images/product/default-product.jpg') }}"
                                                         alt="{{ $item->product->name }}"
                                                         style="width: 60px; height: 60px; object-fit: cover;">

                                                    <span class="text-left-name">{{ $item->product->name }}</span>

                                                    <span class="text-left-qty">x{{ $item->quantity }}</span>
                                                </div>

                                                <span class="text-right">
                            {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($item->price * $item->quantity, 2) }}
                        </span>
                                            </div>
                                        @endforeach

                                        <div class="divider"></div>

                                        {{-- Subtotal --}}
                                        <div>
                                            <span class="text-left">Subtotal</span>
                                            <span class="text-right">
                        {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($cart->subtotal, 2) }}
                    </span>
                                        </div>

                                        {{-- GST TAX (dynamic if needed) --}}
                                        <div>
                                            <span class="text-left">GST Tax</span>
                                            <span class="text-right">
                        {{ App\Helpers\AppHelper::currency_symbol() }}0.00
                    </span>
                                        </div>

                                        {{-- Shipping --}}
                                        <div>
                                            <span class="text-left">Shipping</span>
                                            <span class="text-right">
                        <span class="text-left">(Free Delivery)</span>
                        {{ App\Helpers\AppHelper::currency_symbol() }}0.00
                    </span>
                                        </div>

                                        {{-- TOTAL --}}
                                        <div class="ec-cart-summary-total">
                                            <span class="text-left">Total</span>
                                            <span class="text-right-total">
                        {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($cart->total, 2) }}
                    </span>
                                        </div>

                                        {{-- Proceed Button --}}
{{--                                        <div>--}}
{{--                                            <button type="submit"  class="btn btn-dark py-2 mt-4 w-100 h-100" id="checkoutBtn">--}}
{{--                                                <span class="btn-text">Proceed to Payment--}}
{{--                                                    <i class="ecicon eci-angle-right ms-2"></i>--}}
{{--                                                </span>--}}
{{--                                                <span class="btn-loading d-none">--}}
{{--                                                        <i class="fi-rr-spinner spinner me-2"></i> Processing...--}}
{{--                                                    </span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkoutForm = document.getElementById('checkoutForm');
            const checkoutBtn = document.getElementById('checkoutBtn');
            const shipDifferentCheckbox = document.getElementById('ship-different-address');
            shipDifferentCheckbox.addEventListener('change', function() {
                const shippingCollapse = document.getElementById('collapseOne');
                const shippingInputs = document.querySelectorAll('.shipping-input');
                if (this.checked) {
                    shippingInputs.forEach(input => {
                        input.required = true;
                    });
                } else {
                    shippingInputs.forEach(input => {
                        input.required = false;
                        input.value = '';
                    });
                }
            });

            // Handle form submission
            checkoutForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                const btnText = checkoutBtn.querySelector('.btn-text');
                const btnLoading = checkoutBtn.querySelector('.btn-loading');
                // Show loading state
                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');
                checkoutBtn.disabled = true;

                try {
                    const formData = new FormData(this);
                    formData.append('shipping_same_as_billing', !shipDifferentCheckbox.checked);
                    const response = await fetch('{{ route("checkout.process") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();
                    if (data.success) {
                        window.location.href = data.redirect_url;
                    } else {
                        throw new Error(data.message);
                    }

                } catch (error) {
                    Swal.fire({
                        title: 'Error!',
                        text: error.message,
                        icon: 'error',
                        confirmButtonColor: '#000'
                    });
                } finally {
                    // Reset button state
                    btnText.classList.remove('d-none');
                    btnLoading.classList.add('d-none');
                    checkoutBtn.disabled = false;
                }
            });
        });
    </script>
@endsection
