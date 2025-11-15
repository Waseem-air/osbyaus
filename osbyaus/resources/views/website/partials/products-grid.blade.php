<div class="row gy-4" id="products-grid">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Load More Section -->
<div id="load-more-section" class="text-center mt-5">
    <div id="load-more-loader" class="text-center py-4" style="display: none;">
        <div class="spinner-border text-dark" role="status">
            <span class="visually-hidden">Loading more...</span>
        </div>
        <p class="mt-2">Loading more...</p>
    </div>

    <button id="load-more-btn" class="btn btn-outline-dark btn-lg px-5" style="display: none;">
        <i class="fi-rr-refresh"></i> Load More
        <span id="loaded-count" class="badge bg-dark ms-2"></span>
    </button>

    <div id="end-of-products" class="text-center py-4" style="display: none;">
        <div class="alert alert-light border">
            <i class="fi-rr-check-circle text-success me-2"></i>
            <strong>All products loaded!</strong>
            <p class="mb-0 mt-1 text-muted">You've viewed all {{ $products->total() }} products</p>
        </div>
    </div>
</div>
