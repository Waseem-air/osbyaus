<div class="ec-product-content p-0 mb-4">
    <div class="ec-product-inner hot-sale-card">
        <div class="ec-pro-image-outer">
            <div class="ec-pro-image hot-sale-img">
                <a href="{{ route('product.detail', $product->slug) }}" class="image sale-img">
                    <img class="main-image"
                         src="{{ asset(App\Helpers\AppHelper::getProductImage($product)) }}"
                         alt="{{ $product->name }}"
                         loading="lazy"
                         onerror="this.onerror=null; this.src='{{ asset('website/assets/images/product/default-clothing.jpg') }}'"/>
                </a>

                <div class="ec-pro-actions">
                    @if($product->categories->count() > 0)
                        <span class="badge bg-white">{{ $product->categories->first()->name }}</span>
                    @endif
                </div>

                @if($product->discount_price && $product->discount_price < $product->price)
                    <div class="ec-pro-actions-sale">
                        @php
                            $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                        @endphp
                        <span class="badge bg-white">{{ $discountPercent }}% OFF</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="ec-pro-content text-center">
            <a href="{{ route('product.detail', $product->slug) }}">
                <h6 class="ec-pro-stitle">{{ $product->name }}</h6>
            </a>

            <p class="ec-pro-subtitle">
                @php
                    $specs = [];
                    if ($product->embellishment && $product->embellishment !== 'None') {
                        $specs[] = $product->embellishment;
                    }
                    if ($product->fabric) {
                        $specs[] = $product->fabric;
                    }
                    if ($product->cut) {
                        $specs[] = $product->cut . ' Cut';
                    }
                @endphp
                {{ implode(' | ', $specs) }}
            </p>

            <div class="ec-pro-rat-price align-items-center">
                <span class="ec-price">
                    @if($product->discount_price && $product->discount_price < $product->price)
                        <span class="old-price">{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->price, 2) }}</span>
                        <span class="new-price">{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->discount_price, 2) }}</span>
                    @else
                        <span class="new-price">{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->price, 2) }}</span>
                    @endif
                </span>
            </div>

            <div class="ec-pro-size-wrapper">
                @foreach($product->sizes->take(4) as $size)
                    <div class="form-check ec-pro-size-btn {{ $size->is_active ? '' : 'empty' }}">
                        <input class="form-check-input"
                               type="checkbox"
                               id="prod_size_{{ $product->id }}_{{ $size->id }}"
                            {{ !$size->is_active ? 'disabled' : '' }}>
                        <label class="form-check-label" for="prod_size_{{ $product->id }}_{{ $size->id }}">
                            {{ $size->short_code ?? $size->name }}
                        </label>
                    </div>
                @endforeach

                @if($product->sizes->count() > 4)
                    <div class="form-check ec-pro-size-btn more-sizes">
                        <span class="form-check-label">+{{ $product->sizes->count() - 4 }} more</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
