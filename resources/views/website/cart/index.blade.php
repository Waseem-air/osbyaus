@extends('website.layouts.main')
@section('title', 'Shopping Cart')
@section('meta_description', 'Review your shopping cart items')
@section('meta_keywords', 'cart, shopping cart, items, checkout')
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
                                <li class="ec-breadcrumb-item active">Shopping Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec Cart Section Start -->
    <section class="ec-page-content cart_page section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-cart-leftside col-lg-8 col-md-12">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <div class="table-content cart-table-content">
                                    <div id="cart-items-container">
                                        @include('website.cart.partials.cart-items', ['cart' => $cart])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- cart content End -->
                </div>

                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block border-0">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Cart Total</h3>
                            </div>
                            <div class="ec-sb-block-content">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">
                                        <div>
                                            <span class="text-left">Subtotal</span>
                                            <span class="text-right" id="cart-subtotal">
                                            {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($cart->subtotal ?? 0, 2) }}
                                        </span>
                                        </div>
                                        <div>
                                            <span class="text-left">Shipping</span>
                                            <span class="text-right">
                                            <span class="text-left">(Free Delivery)</span>
                                            {{ App\Helpers\AppHelper::currency_symbol() }}0.00
                                        </span>
                                        </div>
                                        <div class="ec-cart-summary-total">
                                            <span class="text-left">Total Amount</span>
                                            <span class="text-right-total" id="cart-total">
                                            {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($cart->total ?? 0, 2) }}
                                        </span>
                                        </div>

                                        @auth
                                            <div>
                                                <a href="{{ route('checkout') }}" class="btn btn-dark py-2 mt-4 w-100 h-100">
                                                    Proceed to checkout <i class="ecicon eci-angle-right ms-2"></i>
                                                </a>
                                            </div>
                                        @else
                                            <div>
                                                <button type="button" class="btn btn-dark py-2 mt-4 w-100 h-100"
                                                        onclick="showLoginModal()">
                                                    Login to Checkout <i class="ecicon eci-angle-right ms-2"></i>
                                                </button>
                                                <p class="text-center mt-2 small text-muted">
                                                    Please login to proceed with checkout
                                                </p>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Ec Cart Section End -->

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login Required</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-dark w-100" id="loginBtn">
                            <span class="login-text">Login</span>
                            <span class="loading-text d-none">
                            <i class="fi-rr-spinner spinner me-2"></i> Logging in...
                        </span>
                        </button>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">Don't have an account?
                            <a href="{{ route('register') }}" class="text-dark">Register here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function showLoginModal() {
            $('#loginModal').modal('show');
        }

        // Login form submission
        $('#loginForm').on('submit', async function(e) {
            e.preventDefault();

            const formData = $(this).serialize();
            const loginBtn = $('#loginBtn');
            const loginText = loginBtn.find('.login-text');
            const loadingText = loginBtn.find('.loading-text');

            // Show loading state
            loginText.addClass('d-none');
            loadingText.removeClass('d-none');
            loginBtn.prop('disabled', true);

            try {
                const response = await $.ajax({
                    url: '{{ route("login") }}',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (response.success) {
                    $('#loginModal').modal('hide');
                    window.location.reload();
                }
            } catch (error) {
                console.error('Login error:', error);
                let errorMessage = 'Login failed. Please try again.';

                if (error.responseJSON && error.responseJSON.errors) {
                    errorMessage = Object.values(error.responseJSON.errors).flat().join('<br>');
                }

                Swal.fire({
                    title: 'Login Failed',
                    html: errorMessage,
                    icon: 'error',
                    confirmButtonColor: '#000'
                });
            } finally {
                // Reset button state
                loginText.removeClass('d-none');
                loadingText.addClass('d-none');
                loginBtn.prop('disabled', false);
            }
        });

        // Quantity update handler
        $(document).on('change', '.cart-quantity-input', async function() {
            const input = $(this);
            const quantity = parseInt(input.val());
            const itemId = input.data('item-id');

            if (quantity < 1) {
                input.val(1);
                return;
            }

            try {
                const response = await $.ajax({
                    url: `/cart/update-quantity/${itemId}`,
                    method: 'PUT',
                    data: {
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    }
                });

                if (response.success) {
                    await updateCartPage(response);
                }
            } catch (error) {
                console.error('Update quantity error:', error);
                window.shoppingCart.handleAjaxError(error, 'updating quantity');
                // Reload cart to sync state
                loadCartItems();
            }
        });

        // Remove item handler
        $(document).on('click', '.remove-cart-item', async function(e) {
            e.preventDefault();
            const button = $(this);
            const itemId = button.data('item-id');

            const result = await Swal.fire({
                title: 'Remove Item',
                text: 'Are you sure you want to remove this item from your cart?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, remove it!'
            });

            if (result.isConfirmed) {
                try {
                    const response = await $.ajax({
                        url: `/cart/remove/${itemId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    if (response.success) {
                        await updateCartPage(response);
                        Swal.fire('Removed!', response.message, 'success');
                    }
                } catch (error) {
                    console.error('Remove item error:', error);
                    window.shoppingCart.handleAjaxError(error, 'removing item');
                }
            }
        });

        // Clear cart handler
        $(document).on('click', '.clear-cart-btn', async function(e) {
            e.preventDefault();

            const result = await Swal.fire({
                title: 'Clear Cart',
                text: 'Are you sure you want to clear your entire cart? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, clear it!'
            });

            if (result.isConfirmed) {
                try {
                    const response = await $.ajax({
                        url: '{{ route("cart.clear") }}',
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    if (response.success) {
                        await updateCartPage(response);
                        Swal.fire('Cleared!', response.message, 'success');
                        // Show empty cart state
                        $('#cart-items-container').html(`
                    <div class="text-center py-5">
                        <i class="fi-rr-shopping-cart" style="font-size: 4rem; color: #ddd;"></i>
                        <h4 class="mt-3 text-muted">Your cart is empty</h4>
                        <p class="text-muted">Start shopping to add items to your cart</p>
                        <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">
                            <i class="fi-rr-shopping-bag me-2"></i>Start Shopping
                        </a>
                    </div>
                `);
                    }
                } catch (error) {
                    console.error('Clear cart error:', error);
                    window.shoppingCart.handleAjaxError(error, 'clearing cart');
                }
            }
        });

        async function updateCartPage(response) {
            // Update cart items
            if (response.html) {
                $('#cart-items-container').html(response.html);
            }

            // Update totals
            if (response.cartSubtotal) {
                $('#cart-subtotal').text(`{{ App\Helpers\AppHelper::currency_symbol() }}${response.cartSubtotal}`);
            }
            if (response.cartTotal) {
                $('#cart-total').text(`{{ App\Helpers\AppHelper::currency_symbol() }}${response.cartTotal}`);
            }

            // Update cart count in header
            if (window.shoppingCart) {
                window.shoppingCart.updateCartCount(response.cartCount || 0);
            }
        }

        async function loadCartItems() {
            try {
                const response = await $.ajax({
                    url: '{{ route("cart.index") }}',
                    method: 'GET'
                });

                // This would require a different approach since we can't easily update the entire page via AJAX
                // For now, we'll reload the page
                window.location.reload();
            } catch (error) {
                console.error('Load cart items error:', error);
            }
        }

        // Initialize when document is ready
        $(document).ready(function() {
            console.log('Cart page initialized');
        });
    </script>
@endpush
