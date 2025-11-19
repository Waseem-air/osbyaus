<style>
    /* Cart Table Responsive Styles */
    .ec-cart-pro-name {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .ec-cart-pro-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .ec-cart-pro-info {
        flex: 1;
    }

    .ec-cart-pro-title {
        font-weight: 600;
        display: block;
        margin-bottom: 5px;
    }

    .ec-cart-pro-variant,
    .ec-cart-pro-custom {
        font-size: 12px;
        color: #666;
    }

    .color-badge {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 5px;
        vertical-align: middle;
    }

    /* Cart Action Buttons - Desktop */
    .ec-cart-update-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
    }

    .btn-return {
        background: #f8f9fa;
        color: #333;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .btn-return:hover {
        background: #e9ecef;
        text-decoration: none;
        color: #333;
    }

    .update-cart-btn {
        margin-left: auto;
    }

    .clear-cart-page-btn {
        background: #dc3545;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        border: none;
        transition: all 0.3s ease;
    }

    .clear-cart-page-btn:hover {
        background: #c82333;
        color: white;
        text-decoration: none;
    }

    /* Mobile Responsive Styles */
    @media (max-width: 767px) {
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Hide table headers on mobile */
        thead {
            display: none;
        }

        tbody tr {
            display: block;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border: none;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody td:last-child {
            border-bottom: none;
        }

        /* Data label attributes for mobile */
        tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #333;
            text-transform: uppercase;
            font-size: 12px;
            flex: 0 0 100px;
        }

        tbody td .ec-cart-pro-name::before {
            content: none;
        }

        /* Specific column adjustments */
        .ec-cart-pro-name {
            display: block;
            text-align: center;
            padding-bottom: 15px;
        }

        .ec-cart-pro-name a {
            display: block;
            text-decoration: none;
        }

        .ec-cart-pro-img {
            width: 100px;
            height: 100px;
            margin: 0 auto 10px;
        }

        .ec-cart-pro-info {
            text-align: center;
        }

        .ec-cart-pro-price,
        .ec-cart-pro-subtotal {
            font-weight: 600;
            font-size: 16px;
        }

        .ec-cart-pro-qty {
            justify-content: center;
        }

        .cart-qty-plus-minus {
            margin: 0 auto;
        }

        .ec-cart-pro-remove {
            justify-content: center;
            padding-top: 10px;
        }

        .ec-cart-pro-remove a {
            background: #ff4444;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        /* Cart action buttons mobile */
        .ec-cart-update-bottom {
            display: flex;
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }

        .ec-cart-update-bottom .btn-return,
        .ec-cart-update-bottom .update-cart-btn,
        .ec-cart-update-bottom .clear-cart-page-btn {
            display: block;
            width: 100%;
            margin-bottom: 0;
            padding: 12px 20px;
            font-size: 14px;
            text-align: center;
        }

        .update-cart-btn {
            margin-left: 0;
            order: 1;
        }

        .btn-return {
            order: 2;
        }

        .clear-cart-page-btn {
            order: 3;
        }
    }

    /* Small mobile devices */
    @media (max-width: 480px) {
        tbody tr {
            padding: 10px;
            margin-bottom: 10px;
        }

        tbody td {
            padding: 8px 0;
        }

        tbody td::before {
            flex: 0 0 80px;
            font-size: 11px;
        }

        .ec-cart-pro-img {
            width: 80px;
            height: 80px;
        }

        .ec-cart-pro-title {
            font-size: 14px;
        }

        .ec-cart-pro-price,
        .ec-cart-pro-subtotal {
            font-size: 14px;
        }

        /* Button adjustments for very small screens */
        .ec-cart-update-bottom .btn-return,
        .ec-cart-update-bottom .update-cart-btn,
        .ec-cart-update-bottom .clear-cart-page-btn {
            padding: 14px 20px;
            font-size: 15px;
        }
    }

    /* Tablet devices */
    @media (min-width: 768px) and (max-width: 1024px) {
        .ec-cart-pro-img {
            width: 70px;
            height: 70px;
        }

        .ec-cart-pro-title {
            font-size: 14px;
        }

        table {
            font-size: 14px;
        }

        .cart-qty-plus-minus input {
            width: 60px;
            padding: 5px;
        }

        /* Tablet button adjustments */
        .ec-cart-update-bottom {
            gap: 10px;
        }

        .ec-cart-update-bottom .btn-return,
        .ec-cart-update-bottom .update-cart-btn,
        .ec-cart-update-bottom .clear-cart-page-btn {
            padding: 8px 15px;
            font-size: 13px;
        }
    }

    /* Large desktop */
    @media (min-width: 1200px) {
        .ec-cart-update-bottom {
            gap: 20px;
        }

        .ec-cart-update-bottom .btn-return,
        .ec-cart-update-bottom .update-cart-btn,
        .ec-cart-update-bottom .clear-cart-page-btn {
            padding: 12px 25px;
            font-size: 16px;
        }
    }
</style>
@if($cart->items_count > 0)
    <table>
        <tbody>
        @foreach($cart->items as $item)
            <tr>
                <td data-label="" class="ec-cart-pro-name">
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
                                        <br>
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
                <td data-label="Quantity" class="ec-cart-pro-qty"
                    style="text-align: center;">
                    <div class="cart-qty-plus-minus">
                        <input class="cart-plus-minus" type="text"
                               name="quantity"
                               value="{{ $item->quantity }}"
                               min="1"
                               data-item-id="{{ $item->id }}"
                        />
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
                <button class="btn btn-secondary update-cart-btn">Update Cart</button>
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
