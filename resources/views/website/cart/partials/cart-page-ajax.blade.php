<script>
    class CartPage {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
        }

        bindEvents() {
            // Remove item handler
            $(document).on('click', '.remove-cart-page-item', (e) => this.removeItem(e));

            // Clear cart handler
            $(document).on('click', '.clear-cart-page-btn', (e) => this.clearCart(e));

            // Update cart handler
            $(document).on('click', '.update-cart-btn', (e) => this.updateCart(e));

            // Login form submission
            $('#loginForm').on('submit', (e) => this.handleLogin(e));
        }

        async updateCart(e) {
            e.preventDefault();
            const button = $(e.target);
            const originalText = button.html();
            // Show loading state
            button.prop('disabled', true).html('<i class="fi-rr-spinner spinner"></i> Updating...');
            const quantities = {};
            $('.cart-plus-minus').each(function() {
                const itemId = $(this).data('item-id');
                const quantity = parseInt($(this).val()) || 1;
                if (quantity < 1) {
                    $(this).val(1);
                    quantities[itemId] = 1;
                } else {
                    quantities[itemId] = quantity;
                }
            });
            try {
                const response = await $.ajax({
                    url: '{{ route("cart.page.update") }}',
                    method: 'PUT',
                    data: {
                        quantities: quantities,
                        _token: '{{ csrf_token() }}'
                    }
                });

                if (response.success) {
                    await this.updateCartPage(response);
                    this.showSuccessAlert('Success!', 'Cart updated successfully!');
                    smoothReload();
                }
            } catch (error) {
                if (error.responseJSON && error.responseJSON.message) {
                    this.showErrorAlert('Error!', error.responseJSON.message);
                } else {
                    this.handleAjaxError(error, 'updating cart');
                }
            } finally {
                button.prop('disabled', false).html(originalText);
            }
        }

        async removeItem(e) {
            e.preventDefault();
            const button = $(e.currentTarget);
            const itemId = button.data('item-id');
            const cartItem = button.closest('tr');
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
                if (cartItem) {
                    cartItem.css('opacity', '0.6');
                    button.prop('disabled', true).html('<i class="fi-rr-spinner spinner"></i>');
                }

                try {
                    const response = await $.ajax({
                        url: `/cart/page/remove/${itemId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    if (response.success) {
                        await this.updateCartPage(response);
                        this.showSuccessAlert('Removed!', response.message);
                    }
                } catch (error) {
                    console.error('Remove item error:', error);
                    // Reset loading state
                    if (cartItem) {
                        cartItem.css('opacity', '1');
                        button.prop('disabled', false).html('<i class="fi-rr-cross"></i>');
                    }

                    if (error.status === 404) {
                        await this.loadCartItems();
                        this.showInfoAlert('Info', 'Item was already removed from your cart.');
                    } else {
                        this.handleAjaxError(error, 'removing item');
                    }
                }
            }
        }

        async clearCart(e) {
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
                // Show loading state
                $('#cart-items-container').html(`
                    <div class="text-center py-4">
                        <i class="fi-rr-spinner spinner" style="font-size: 2rem;"></i>
                        <p class="mt-2 text-muted">Clearing cart...</p>
                    </div>
                `);

                try {
                    const response = await $.ajax({
                        url: '{{ route("cart.page.clear") }}',
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    if (response.success) {
                        await this.updateCartPage(response);
                        this.showSuccessAlert('Cleared!', response.message);
                    }
                } catch (error) {
                    await this.loadCartItems();
                    this.handleAjaxError(error, 'clearing cart');
                }
            }
        }

        async updateCartPage(response) {
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
            if (window.shoppingCart) {
                window.shoppingCart.updateCartCount(response.cartCount || 0);
            }

            // Update checkout button based on auth status
            this.updateCheckoutButton();
        }

        async loadCartItems() {
            try {
                const response = await $.ajax({
                    url: '{{ route("cart.page.items") }}',
                    method: 'GET'
                });

                if (response.success) {
                    await this.updateCartPage(response);
                }
            } catch (error) {
                console.error('Load cart items error:', error);
                this.handleAjaxError(error, 'loading cart items');
            }
        }

        updateCheckoutButton() {
            const checkoutSection = $('.ec-cart-summary').find('div').last();
            if ('{{ auth()->check() }}' === '1') {
                checkoutSection.html(`
                    <a href="{{ route('checkout') }}" class="btn btn-dark py-2 mt-4 w-100 h-100">
                        Proceed to checkout <i class="ecicon eci-angle-right ms-2"></i>
                    </a>
                `);
            } else {
                checkoutSection.html(`
                    <button type="button" class="btn btn-dark py-2 mt-4 w-100 h-100" onclick="showLoginModal()">
                        Login to Checkout <i class="ecicon eci-angle-right ms-2"></i>
                    </button>
                `);
            }
        }

        async handleLogin(e) {
            e.preventDefault();
            const formData = $(e.target).serialize();
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
                    // Update UI without page reload
                    this.updateCheckoutButton();
                    this.showSuccessAlert('Success!', 'Login successful!');

                    // Update cart sidebar if exists
                    if (window.shoppingCart) {
                        await window.shoppingCart.loadCartSidebar();
                    }
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
        }

        handleAjaxError(error, action) {
            let errorMessage = `Error ${action}`;
            if (error.responseJSON && error.responseJSON.message) {
                errorMessage = error.responseJSON.message;
            } else if (error.status === 0) {
                errorMessage = 'Network error. Please check your connection.';
            } else if (error.status === 404) {
                errorMessage = 'Service not available. Please try again.';
            } else if (error.statusText) {
                errorMessage = `${errorMessage}: ${error.statusText}`;
            }

            this.showErrorAlert('Error!', errorMessage);
        }

        // Alert Helper Methods
        showSuccessAlert(title, message) {
            Swal.fire({
                title: title,
                text: message,
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }

        showErrorAlert(title, message) {
            Swal.fire({
                title: title,
                text: message,
                icon: 'error',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
            });
        }

        showInfoAlert(title, message) {
            Swal.fire({
                title: title,
                text: message,
                icon: 'info',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }
    }

    function showLoginModal() {
        $('#loginModal').modal('show');
    }


    function smoothReload(delay = 1000) {
        setTimeout(() => {
            document.body.style.transition = "opacity 0.4s";
            document.body.style.opacity = 0;
            setTimeout(() => {
                location.reload();
            }, 400);
        }, delay);
    }

    $(document).ready(function() {
        if (typeof window.cartPage === 'undefined') {
            window.cartPage = new CartPage();
        }
    });
</script>
