<div class="row gy-4">
    @foreach($products as $product)
        <div class="col-lg-4 col-md-6">
            <div class="ec-product-content p-0 mb-4">
                <div class="ec-product-inner hot-sale-card">
                    <div class="ec-pro-image-outer">
                        <div class="ec-pro-image hot-sale-img">
                            <a href="{{ route('product.detail', $product->slug) }}" class="image sale-img">
                                @if($product->images->count() > 0)
                                    <img class="main-image" src="{{ asset($product->images->first()->image_path) }}"
                                         alt="{{ $product->name }}" loading="lazy"/>
                                @else
                                    <img class="main-image" src="{{ asset('website/assets/images/product/default-product.jpg') }}"
                                         alt="{{ $product->name }}" loading="lazy"/>
                                @endif
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
                            {{ $product->embellishment ? $product->embellishment . ' | ' : '' }}
                            {{ $product->fabric ? $product->fabric . ' | ' : '' }}
                            {{ $product->cut ? $product->cut . ' Cut' : '' }}
                        </p>
                        <div class="ec-pro-rat-price align-items-center">
                        <span class="ec-price">
                            @if($product->discount_price && $product->discount_price < $product->price)
                                <span class="old-price">{{ App\Helpers\AppHelper::currency_symbol() }}.{{ number_format($product->price, 2) }}</span>
                                <span class="new-price">{{ App\Helpers\AppHelper::currency_symbol() }}.{{ number_format($product->discount_price, 2) }}</span>
                            @else
                                <span class="new-price">{{ App\Helpers\AppHelper::currency_symbol() }}.{{ number_format($product->price, 2) }}</span>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if($products->hasPages())
    <div class="row mt-5">
        <div class="col-12">
            <nav aria-label="Products pagination">
                <ul class="pagination justify-content-center">
                    {{ $products->links('website.vendor.pagination.custom') }}
                </ul>
            </nav>
        </div>
    </div>
@endif
