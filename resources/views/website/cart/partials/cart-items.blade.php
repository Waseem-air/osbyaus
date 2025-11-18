@if($cart->items_count > 0)
    <table>
        <tbody>
        @foreach($cart->items as $item)
            <tr>
                <td data-label="Product" class="ec-cart-pro-name">
                    <a href="{{ route('product.detail', $item->product->slug) }}">
                        <img class="ec-cart-pro-img mr-4"
                             src="{{ asset($item->product->main_image?->image_path ?? 'website/assets/images/product/default-product.jpg') }}"
                             alt="{{ $item->product->name }}" />
                        <div class="ec-cart-pro-info">
                            <span class="ec-cart-pro-title">{{ $item->product->name }}</span>
                            @if($item->variant)
                                <div class="ec-cart-pro-variant">
                                    @if($item->variant->color)
                                        <span class="color-badge" style="background-color: {{ $item->variant->color->color->hex_code ?? '#ccc' }}"></span>
                                        <small>Color: {{ $item->variant->color->color->name ?? 'N/A' }}</small>
                                    @endif
                                    @if($item->variant->size)
                                        <small>Size: {{ $item->variant->size->size->name ?? 'N/A' }}</small>
                                    @endif
                                </div>
                            @endif
                            @if($item->customSize)
                                <div class="ec-cart-pro-custom">
                                    <small class="text-info">Custom Size</small>
                                </div>
                            @endif
                        </div>
                    </a>
                </td>
                <td data-label="Price" class="ec-cart-pro-price">
                    <span class="amount">{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($item->price, 2) }}</span>
                </td>
                <td data-label="Quantity" class="ec-cart-pro-qty" style="text-align: center;">
                    <div class="cart-qty-plus-minus">
                        <div class="dec ec_qtybtn">-</div>
                        <input class="cart-plus-minus cart-quantity-input cart-page-quantity-input" type="number"
                               name="quantity"
                               value="{{ $item->quantity }}"
                               min="1"
                               data-item-id="{{ $item->id }}"
                               style="text-align: center; width: 60px;" />
                        <div class="inc ec_qtybtn">+</div>
                    </div>
                </td>
                <td data-label="Total" class="ec-cart-pro-subtotal">
                    {{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($item->price * $item->quantity, 2) }}
                </td>
                <td data-label="Remove" class="ec-cart-pro-remove">
                    <a href="javascript:void(0);" class="remove-cart-page-item" data-item-id="{{ $item->id }}">
                        <i class="fi-rr-cross"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-lg-12">
            <div class="ec-cart-update-bottom">
                <a href="{{ route('products.index') }}" class="btn-return">Return to shop</a>
                <a href="javascript:void(0);" class="btn btn-dark clear-cart-page-btn">Clear Cart</a>
            </div>
        </div>
    </div>
@else
    <div class="text-center py-5">
        <i class="fi-rr-shopping-cart" style="font-size: 4rem; color: #ddd;"></i>
        <h4 class="mt-3 text-muted">Your cart is empty</h4>
        <p class="text-muted">Start shopping to add items to your cart</p>
        <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">
            <i class="fi-rr-shopping-bag me-2"></i>Start Shopping
        </a>
    </div>
@endif

