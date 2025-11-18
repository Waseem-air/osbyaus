<div class="ec-cart-inner">
    <div class="ec-cart-top">
        <div class="ec-cart-title">
            <span class="cart_title">Shopping Cart (<span class="ec-cart-count">{{ $cartCount ?? 0 }}</span>)</span>
            <button class="ec-close" type="button">×</button>
        </div>

        @if(isset($cart) && $cart->items_count > 0)
            <ul class="eccart-pro-items">
                @foreach($cart->items as $item)
                    <li class="cart-item">
                        <a href="{{ route('product.detail', $item->product->slug) }}" class="sidecart_pro_img">
                            <img src="{{ asset($item->product->main_image?->image_path ?? 'website/assets/images/product/default-product.jpg') }}" alt="{{ $item->product->name }}">
                        </a>
                        <div class="ec-pro-content pt-0">
                            <a href="{{ route('product.detail', $item->product->slug) }}" class="cart_pro_title">
                                {{ $item->product->name }}
                            </a>

                            <span class="cart-price text-left">
                                {{ $item->quantity }} x <span>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($item->price, 2) }}</span>
                            </span>

                            <div class="cart-item-actions d-flex align-items-center mt-2">
                                <a href="javascript:void(0);" class="remove-cart-item ms-2" data-item-id="{{ $item->id }}" title="Remove Item">
                                    <i class="ecicon eci-trash"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="text-center py-4">
                <i class="fi-rr-shopping-cart" style="font-size: 3rem; color: #ddd;"></i>
                <p class="mt-2 text-muted">Your cart is empty</p>
                <a href="{{ route('products.index') }}" class="btn btn-dark btn-sm mt-2">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>

    @if(isset($cart) && $cart->items_count > 0)
        <div class="ec-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                    <tr>
                        <td class="text-left">Cart Total</td>
                        <td class="text-right">{{ App\Helpers\AppHelper::currency_symbol() }}{{ $cartSubtotal ?? number_format($cart->subtotal, 2) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="cart_btn">
                <a href="{{ route('cart.index') }}" class="btn btn-soft-dark">
                    <i class="fi-rr-shopping-cart me-2"></i> Go to cart
                </a>

                <button class="btn btn-soft-dark clear-cart-btn w-100 mt-2">
                    <i class="ecicon eci-trash me-1"></i> Clear Entire Cart
                </button>
            </div>
        </div>
    @endif
</div>
