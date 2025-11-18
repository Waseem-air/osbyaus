<script>
    class ShoppingCart {
        constructor() {
            this.isInitialized = false;
            this.init();
        }

        init() {
            if (this.isInitialized) return;

            this.bindEvents();
            this.loadCartCount();
            this.isInitialized = true;

            console.log('ShoppingCart initialized successfully');
        }

        bindEvents() {
            // Add to cart
            $(document).on('click', '.add-to-cart-btn', (e) => this.addToCart(e));

            // Custom size form
            $(document).on('submit', '#custom-size-form', (e) => this.addCustomSizeToCart(e));

            // Cart sidebar toggle
            $(document).on('click', '.ec-side-cart-toggle', (e) => this.toggleCartSidebar(e));

            // Close buttons
            $(document).on('click', '.ec-close', (e) => this.closeAllSidebars());
            $(document).on('click', '.ec-side-cart-overlay', (e) => this.closeAllSidebars());

            // Close custom size
            $(document).on('click', '.close-custom-size', (e) => this.closeCustomSizeSidebar());

            // Prevent event propagation
            $(document).on('click', '.ec-side-cart', (e) => e.stopPropagation());
            $(document).on('click', '#ec-side-size-chart', (e) => e.stopPropagation());
        }

        async toggleCartSidebar(e) {
            e.preventDefault();
            await this.loadCartSidebar();
            this.openCartSidebar();
        }

        async loadCartSidebar() {
            console.log('Loading cart sidebar...');

            // Show loading state
            $('#ec-side-cart .ec-cart-inner').html(`
            <div class="text-center py-4">
                <i class="fi-rr-spinner spinner" style="font-size: 2rem;"></i>
                <p class="mt-2 text-muted">Loading cart...</p>
            </div>
        `);

            try {
                const response = await $.ajax({
                    url: '{{ route("cart.sidebar") }}',
                    method: 'GET',
                    timeout: 10000
                });

                console.log('Cart sidebar response:', response);

                if (response.success) {
                    $('#ec-side-cart .ec-cart-inner').html(response.html);
                    this.bindCartItemEvents();
                } else {
                    throw new Error(response.message || 'Failed to load cart');
                }
            } catch (error) {
                console.error('Error loading cart sidebar:', error);
                this.showCartError();
            }
        }

        showCartError() {
            $('#ec-side-cart .ec-cart-inner').html(`
            <div class="text-center py-4">
                <i class="fi-rr-exclamation" style="font-size: 3rem; color: #dc3545;"></i>
                <p class="mt-2 text-danger">Error loading cart</p>
                <button class="btn btn-dark btn-sm mt-2" onclick="window.shoppingCart.loadCartSidebar()">
                    Retry
                </button>
            </div>
        `);
        }

        bindCartItemEvents() {
            // Remove previous event handlers to avoid duplicates
            $(document).off('click', '.remove-cart-item');
            $(document).off('click', '.clear-cart-btn');

            // Bind new event handlers
            $(document).on('click', '.remove-cart-item', (e) => this.removeItem(e));
            $(document).on('click', '.clear-cart-btn', (e) => this.clearCart(e));
        }

        async removeItem(e) {
            e.preventDefault();
            const button = $(e.currentTarget);
            const itemId = button.data('item-id');
            const cartItem = button.closest('.cart-item');

            console.log('Remove item clicked:', itemId);

            // Show confirmation FIRST - wait for user response
            const result = await this.showConfirmationAlert(
                'Remove Item',
                'Are you sure you want to remove this item from your cart?',
                'Yes, remove it!'
            );

            // Only proceed if user confirms
            if (result.isConfirmed) {
                // Show loading state on the specific item
                this.showItemLoading(cartItem);

                try {
                    const response = await $.ajax({
                        url: `/cart/remove/${itemId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        timeout: 5000
                    });

                    if (response.success) {
                        // Remove from UI only after successful database removal
                        this.removeItemFromUI(cartItem);

                        // Update cart UI with server response
                        await this.updateCartUI(response);

                        this.showSuccessAlert('Removed!', response.message);
                    }
                } catch (error) {
                    console.error('Remove item error:', error);
                    // Remove loading state on error (item stays in cart)
                    this.hideItemLoading(cartItem);
                    this.handleAjaxError(error, 'removing item');
                }
            }
        }

        showItemLoading(cartItem) {
            cartItem.css('opacity', '0.6');
            cartItem.find('.remove-cart-item').html('<i class="fi-rr-spinner spinner"></i>');
        }

        hideItemLoading(cartItem) {
            cartItem.css('opacity', '1');
            cartItem.find('.remove-cart-item').html('<i class="ecicon eci-trash"></i>');
        }

        async removeItem(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent event bubbling

            const button = $(e.currentTarget);
            const itemId = button.data('item-id');
            const cartItem = button.closest('.cart-item');
            const result = await this.showConfirmationAlert(
                'Remove Item',
                'Are you sure you want to remove this item from your cart?',
                'Yes, remove it!'
            );

            if (result.isConfirmed) {
                this.showItemLoading(cartItem);
                try {
                    const response = await $.ajax({
                        url: `/cart/remove/${itemId}`,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        timeout: 5000
                    });

                    if (response.success) {
                        this.removeItemFromUI(cartItem);
                        await this.updateCartUI(response);
                        this.showSuccessAlert('Removed!', response.message);
                    }
                } catch (error) {
                    this.hideItemLoading(cartItem);
                    this.handleAjaxError(error, 'removing item');
                }
            }
        }
        async clearCart(e) {
            e.preventDefault();

            const result = await this.showConfirmationAlert(
                'Clear Cart',
                'Are you sure you want to clear your entire cart? This action cannot be undone.',
                'Yes, clear it!'
            );

            if (result.isConfirmed) {
                // Show loading state for entire cart
                $('#ec-side-cart .ec-cart-inner').html(`
                <div class="text-center py-4">
                    <i class="fi-rr-spinner spinner" style="font-size: 2rem;"></i>
                    <p class="mt-2 text-muted">Clearing cart...</p>
                </div>
            `);

                try {
                    const response = await $.ajax({
                        url: '{{ route("cart.clear") }}',
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        timeout: 10000
                    });

                    if (response.success) {
                        // Update with empty cart UI
                        await this.updateCartUI(response);
                        this.showSuccessAlert('Cleared!', response.message);
                        this.closeCartSidebar();
                    }
                } catch (error) {
                    console.error('Clear cart error:', error);
                    // Reload cart sidebar on error
                    await this.loadCartSidebar();
                    this.handleAjaxError(error, 'clearing cart');
                }
            }
        }

        async updateCartUI(response) {
            if (response.html) {
                $('#ec-side-cart .ec-cart-inner').html(response.html);
                this.bindCartItemEvents();
            }

            this.updateCartCount(response.cartCount);
            const subtotalElement = $('.cart-sub-total');
            if (subtotalElement.length && response.cartSubtotal) {
                subtotalElement.find('td:last').text(`{{ App\Helpers\AppHelper::currency_symbol() }}${response.cartSubtotal}`);
            }
        }

        async addToCart(e) {
            e.preventDefault();
            const button = $(e.currentTarget);
            if (button.prop('disabled')) return;
            const formData = this.getAddToCartData(button);
            if (!formData) {
                this.showErrorAlert('Error!', 'Product information not found.');
                return;
            }

            button.prop('disabled', true);
            const originalText = button.html();
            button.html('<i class="fi-rr-spinner spinner"></i> Adding...');
            try {
                const response = await $.ajax({
                    url: '{{ route("cart.add") }}',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    timeout: 5000
                });

                if (response.success) {
                    this.showSuccessAlert('Success!', response.message);
                    await this.updateCartUI(response);
                    setTimeout(() => this.openCartSidebar(), 500);
                }
            } catch (error) {
                this.handleAjaxError(error, 'adding item to cart');
            } finally {
                button.prop('disabled', false).html(originalText);
            }
        }

        getAddToCartData(button) {
            let productId = button.data('product-id');
            if (!productId) {
                productId = $('input[name="product_id"]').val();
            }
            if (!productId && window.currentProductId) {
                productId = window.currentProductId;
            }

            if (!productId) {
                return null;
            }

            const selectedColor = $('input[name="color_id"]:checked').val();
            const selectedSize = $('input[name="size_id"]:checked').val();
            const quantity = $('input[name="quantity"]').val() || 1;
            return {
                product_id: productId,
                quantity: parseInt(quantity),
                color_id: selectedColor || null,
                size_id: selectedSize || null,
                _token: '{{ csrf_token() }}'
            };
        }

        async addCustomSizeToCart(e) {
            e.preventDefault();
            const form = $(e.currentTarget);
            const button = form.find('.add-custom-size-to-cart');
            const productId = form.data('product-id');

            if (!this.validateCustomSizeForm(form)) {
                this.showErrorAlert('Validation Error', 'Please fill all required fields with valid measurements.');
                return;
            }

            button.prop('disabled', true);
            const originalText = button.html();
            button.html('<i class="fi-rr-spinner spinner"></i> Adding...');
            try {
                const customSizeData = this.getCustomSizeData(form);
                const response = await $.ajax({
                    url: '{{ route("cart.add-custom-size") }}',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        custom_size: customSizeData,
                        _token: '{{ csrf_token() }}'
                    },
                    timeout: 10000
                });

                if (response.success) {
                    this.showSuccessAlert('Success!', 'Custom size item added to cart!');
                    await this.updateCartUI(response);
                    this.closeCustomSizeSidebar();
                    setTimeout(() => this.openCartSidebar(), 500);
                }
            } catch (error) {
                this.handleAjaxError(error, 'adding custom size to cart');
            } finally {
                button.prop('disabled', false).html(originalText);
            }
        }

        validateCustomSizeForm(form) {
            let isValid = true;
            const requiredFields = form.find('input[required]');
            $('.custom-size-error').remove();
            $('.form-control').removeClass('is-invalid');

            requiredFields.each(function() {
                const field = $(this);
                const value = field.val().trim();

                if (!value || isNaN(value) || parseFloat(value) <= 0) {
                    field.addClass('is-invalid');
                    field.after('<div class="custom-size-error text-danger small mt-1">Please enter a valid measurement</div>');
                    isValid = false;
                }
            });

            return isValid;
        }

        getCustomSizeData(form) {
            const formData = new FormData(form[0]);
            const customSizeData = {};
            for (let [key, value] of formData.entries()) {
                if (key.startsWith('custom_size[')) {
                    const fieldName = key.match(/custom_size\[(.*?)\]/)[1];
                    if (value && !isNaN(value) && value.trim() !== '') {
                        customSizeData[fieldName] = parseFloat(value);
                    } else {
                        customSizeData[fieldName] = null;
                    }
                }
            }

            return customSizeData;
        }

        async loadCartCount() {
            try {
                const response = await $.ajax({
                    url: '{{ route("cart.sidebar") }}',
                    method: 'GET',
                    timeout: 5000
                });
                if (response.success) {
                    this.updateCartCount(response.cartCount);
                }
            } catch (error) {
                this.updateCartCount(0);
            }
        }

        updateCartCount(count) {
            // Update all cart count elements
            $('.ec-cart-count').text(count);
            $('.mobile-cart-count').text(count);
            $('.cart-count-lable').text(count);
            const badge = $('.cart-count-badge');
            if (badge.length) {
                badge.text(count);
                if (count > 0) {
                    badge.show();
                } else {
                    badge.hide();
                }
            }

            // Update cart title in sidebar
            const cartTitle = $('.cart_title');
            if (cartTitle.length) {
                cartTitle.text(`Shopping Cart (${count})`);
            }
        }

        openCartSidebar() {
            this.closeAllSidebars();
            $('#ec-side-cart').addClass('ec-open');
            $('.ec-side-cart-overlay').addClass('ec-close');
        }

        closeCartSidebar() {
            $('#ec-side-cart').removeClass('ec-open');
            $('.ec-side-cart-overlay').removeClass('ec-close');
        }

        openCustomSizeSidebar() {
            this.closeAllSidebars();
            $('#ec-side-size-chart').addClass('ec-open');
            $('.ec-side-cart-overlay').addClass('ec-close');
        }

        closeCustomSizeSidebar() {
            $('#ec-side-size-chart').removeClass('ec-open');
            $('.ec-side-cart-overlay').removeClass('ec-close');
            this.resetCustomSizeForm();
        }

        closeAllSidebars() {
            this.closeCartSidebar();
            this.closeCustomSizeSidebar();
        }

        resetCustomSizeForm() {
            $('#custom-size-form')[0].reset();
            $('.custom-size-error').remove();
            $('.form-control').removeClass('is-invalid');
        }

        handleAjaxError(error, action) {
            let errorMessage = `Error ${action}`;
            if (error.responseJSON && error.responseJSON.message) {
                errorMessage = error.responseJSON.message;
            } else if (error.status === 0) {
                errorMessage = 'Network error. Please check your connection.';
            } else if (error.status === 404) {
                errorMessage = 'Cart service not available. Please try again.';
            } else if (error.statusText) {
                errorMessage = `${errorMessage}: ${error.statusText}`;
            }

            this.showErrorAlert('Error!', errorMessage);
        }

        // SweetAlert2 Helper Methods
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

        showConfirmationAlert(title, text, confirmButtonText) {
            return Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Cancel',
            });
        }
    }

    // Initialize shopping cart when document is ready
    $(document).ready(function() {
        if (typeof window.shoppingCart === 'undefined') {
            window.shoppingCart = new ShoppingCart();
            setTimeout(() => {
                window.shoppingCart.loadCartSidebar();
            }, 1000);
        }
    });

    // Global function for retry button
    function retryCartLoad() {
        if (window.shoppingCart) {
            window.shoppingCart.loadCartSidebar();
        }
    }
</script>
