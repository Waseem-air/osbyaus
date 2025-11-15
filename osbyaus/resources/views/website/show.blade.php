@extends('website.layouts.main')
@section('title', $product->name)
@section('meta_description', Str::limit($product->description, 160))
@section('meta_keywords', $product->fabric . ', ' . $product->cut . ', ' . $product->embellishment . ', fashion, clothing')
@section('content')

    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-12 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list text-left">
                                <li class="ec-breadcrumb-item"><a href="{{ route('home') }}"><i class="fi-rr-home"></i></a></li>
                                <li class="ec-breadcrumb-item">Categories</li>
                                @if($product->categories->count() > 0)
                                    <li class="ec-breadcrumb-item active">{{ $product->categories->first()->name }}</li>
                                @endif
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Sart Single product -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 order-lg-last col-md-12 order-md-first">
                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="single-pro-img">
                                        <div class="single-product-scroll">
                                            <div class="row">
                                                <div class="col-lg-9 order-lg-2">
                                                    <div class="single-product-cover">
                                                        @foreach($product->images as $image)
                                                            <div class="single-slide zoom-image-hover">
                                                                <img class="img-responsive"
                                                                     src="{{ asset($image->image_path) }}" alt="{{ $product->name }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 order-lg-1 single-nav-thumb-left-side">
                                                    <div class="single-nav-thumb">
                                                        @foreach($product->images as $image)
                                                            <div class="single-slide">
                                                                <img class="img-responsive"
                                                                     src="{{ asset($image->image_path) }}" alt="{{ $product->name }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-pro-desc">
                                        <div class="single-pro-content">
                                            <h5 class="ec-single-title">{{ $product->name }}</h5>
                                            <div class="ec-single-rating-wrap">
                                                <div class="d-flex align-items-center">
                                                    <span class="ec-review-sold-item">
                                                        <a class="text-success">
                                                            @if($product->stock_quantity > 0)
                                                                In Stock ({{ $product->stock_quantity }} available)
                                                            @else
                                                                Out of Stock
                                                            @endif
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="ec-read-review-sku">
                                                        <a>SKU: <span class="sku-number">{{ $product->sku }}</span></a>
                                                    </span>
                                                    <span class="ec-review-sold-item border-0 p-0">
                                                        <a>
                                                            <i class="ecicon eci-check"></i>
                                                            <span class="ec-sold">Popular This Week</span>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ec-single-desc">
                                                {{ $product->description }}
                                            </div>
                                            <div class="ec-single-price-stoke">
                                                <div class="ec-single-price">
                                                    @if($product->discount_price && $product->discount_price < $product->price)
                                                        <span class="new-price">Rs.{{ number_format($product->discount_price, 2) }}</span>
                                                        <span class="ec-single-ps-title">Rs.{{ number_format($product->price, 2) }}</span>
                                                        @php
                                                            $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                                        @endphp
                                                        <span class="ec-single-ps-title-badge">{{ $discountPercent }}%</span>
                                                    @else
                                                        <span class="new-price">Rs.{{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="ec-pro-size">
                                                <div class="ec-pro-size-inner ec-pro-variation-size">
                                                    <div class="ec-pro-size-header">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="title">Size:</span>
                                                            <span class="stitle">Select Size</span>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <span class="title">
                                                                <svg width="20" height="14" viewBox="0 0 20 14"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M6.57177 4.36826C6.32677 4.46876 6.63677 4.64426 6.80827 4.64526C6.88628 4.65555 6.96562 4.6467 7.03945 4.61947C7.11328 4.59225 7.17937 4.54747 7.23203 4.48901C7.28469 4.43054 7.32234 4.36014 7.34171 4.28387C7.36109 4.20761 7.36163 4.12778 7.34327 4.05126C7.18977 3.61876 6.46477 3.44476 5.89977 3.58126C5.08527 3.77876 4.77127 4.45126 5.08077 4.98076C5.48677 5.67676 6.70527 5.93876 7.66327 5.64626C8.85527 5.28276 9.29627 4.26526 8.76327 3.46776C8.12327 2.51126 6.40827 2.16176 5.06877 2.60876C3.50377 3.13126 2.93627 4.49226 3.69127 5.55176C4.55727 6.76576 6.76627 7.20276 8.47977 6.60226C10.4148 5.92476 11.1073 4.22226 10.1318 2.90576C9.04427 1.43626 6.34627 0.912763 4.26277 1.66476C1.96177 2.49526 1.14527 4.53526 2.33777 6.10776C3.64427 7.82976 6.82777 8.43876 9.27777 7.53676C11.9413 6.55526 12.8813 4.17976 11.4728 2.35476C9.94927 0.381763 6.28377 -0.313237 3.47127 0.738763C0.446269 1.86976 -0.616231 4.57876 1.00727 6.65426C2.03977 7.97476 4.00427 8.86076 6.15527 9.00826"
                                                                        stroke="black" stroke-width="0.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M6.15543 9.00816H19.7504V13.5297H6.12043C2.81143 13.5297 0.25293 11.3247 0.25293 8.44316V4.48716M2.79593 12.5687V11.4387M4.49143 13.2472V10.9862M6.18693 13.5297V12.3997M7.88243 13.5297V11.2687M9.57743 13.5297V12.3997M11.2734 13.5297V11.2687M12.9684 13.5297V12.3997M16.3594 13.5297V12.3997M14.6644 13.5297V11.2687M18.0549 13.5297V11.2687M12.1209 8.95166V4.03516"
                                                                        stroke="black" stroke-width="0.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                            <span class="stitle">Size Guide</span>
                                                        </div>
                                                    </div>
                                                    <div class="ec-pro-size-content">
                                                        @foreach($product->sizes as $size)
                                                            <span>
                                                            <input type="checkbox" name="size" id="size_{{ $size->id }}"
                                                                   {{ $size->is_active ? '' : 'disabled' }}>
                                                            <label for="size_{{ $size->id }}" class="size-badge">
                                                                {{ $size->short_code ?? $size->name }}
                                                            </label>
                                                        </span>
                                                        @endforeach
                                                        <span>
                                                            <a href="#ec-side-size-chart" class="ec-side-toggle">
                                                                <label for="" class="size-badge-custom">
                                                                    Custom Size
                                                                </label>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ec-single-qty">
                                                <div class="qty-plus-minus">
                                                    <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                                </div>
                                                <div class="ec-single-cart">
                                                    <button class="btn btn-dark"
                                                        {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                                        <i class="fi-rr-shopping-cart"></i>
                                                        {{ $product->stock_quantity > 0 ? 'Add To Cart' : 'Out of Stock' }}
                                                    </button>
                                                </div>
                                                <div class="ec-single-wishlist">
                                                    <a class="ec-btn-product-group product-wishlist" title="Wishlist">
                                                        <i class="fi-rr-heart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="ec-single-tags">
                                                <p class="tag-stitle fs-9 mb-1">ACTUAL COLOR MAY SLIGHTLY VARY DUE TO
                                                    DIFFERENT LIGHTS</p>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <span class="d-flex gap-1">
                                                        <i class="fi-rr-clock"></i>
                                                        <span class="tag-stitle">Estimated delivery between</span>
                                                    </span>
                                                    <span class="tag-title">
                                                        {{ now()->addDays(3)->format('l d F') }} - {{ now()->addDays(7)->format('l d F') }}
                                                    </span>
                                                </div>
                                                @if($product->colors->count() > 0)
                                                    <div class="mt-2">
                                                        <span class="tag-stitle">Available Colors: </span>
                                                        @foreach($product->colors as $color)
                                                            <span class="badge" style="background-color: {{ $color->hex_code }}; color: white;">
                                                        {{ $color->name }}
                                                    </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->

                    <!-- Single product tab start -->
                    <div class="ec-single-pro-tab">
                        <div class="ec-single-pro-tab-wrapper">
                            <div class="ec-single-pro-tab-nav">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                           data-bs-target="#ec-spt-nav-chart" role="tab"
                                           aria-controls="ec-spt-nav-chart" aria-selected="true">Size Chart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-shipping"
                                           role="tab" aria-controls="ec-spt-nav-shipping"
                                           aria-selected="false">Shipping & Returns </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details"
                                           role="tab" aria-controls="ec-spt-nav-details"
                                           aria-selected="false">Product Details</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content ec-single-pro-tab-content">
                                <div id="ec-spt-nav-chart" class="tab-pane fade show active">
                                    <div class="ec-single-pro-tab-desc-left">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-6">
                                                <div class="ec-size-chart-wrapper">
                                                    <div class="ec-size-chart-content">
                                                        <div class="ec-size-chart-item item-header">
                                                            <span class="ec-chart-title">{{ $product->cut }} {{ $product->categories->first()->name ?? 'Product' }}</span>
                                                            <div class="ec-chart-info">
                                                                @foreach($product->sizes as $size)
                                                                    <span class="ec-chart-info-text">{{ $size->short_code ?? $size->name }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="ec-size-chart-item">
                                                            <span class="ec-chart-title">Shoulder</span>
                                                            <div class="ec-chart-info">
                                                                @foreach($product->sizes as $size)
                                                                    <span class="ec-chart-info-text">{{ rand(32, 38) }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="ec-size-chart-item">
                                                            <span class="ec-chart-title">Chest</span>
                                                            <div class="ec-chart-info">
                                                                @foreach($product->sizes as $size)
                                                                    <span class="ec-chart-info-text">{{ rand(34, 42) }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="ec-size-chart-item">
                                                            <span class="ec-chart-title">Length</span>
                                                            <div class="ec-chart-info">
                                                                @foreach($product->sizes as $size)
                                                                    <span class="ec-chart-info-text">{{ rand(40, 46) }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-6">
                                                <div class="ec-size-chart-wrapper-right">
                                                    <div class="ec-size-chart-wrapper-right-item">
                                                        <h5 class="ec-chart-right-title">Women's Standard Size Guide</h5>
                                                        <p class="ec-chart-right-text">Measurement in inches</p>
                                                    </div>
                                                    <div class="ec-size-img-wrapper">
                                                        <img src="{{ asset('website/assets/images/product/size.png') }}" alt="Size Guide">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ec-spt-nav-shipping" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-desc mb-5">
                                        <div class="ec-single-pro-tab-moreinfo">
                                            <ul>
                                                <li>COD facility is not available for international customers.</li>
                                                <li>No exchange/returns for international customers.</li>
                                                <li>Payment (in advance) accepted through Credit/Debit Cards and bank
                                                    transfer only.</li>
                                                <li>Please note there could be delays to a certain extent due to
                                                    external factors which may be beyond our control.</li>
                                            </ul>
                                            <div class="tab-moreinfo-item">
                                                <h6>Care Instructions:</h6>
                                                <p>
                                                    @if($product->fabric == 'Silk' || $product->fabric == 'Chiffon')
                                                        Dry clean recommended. Do not machine wash.
                                                    @elseif($product->fabric == 'Wool' || $product->fabric == 'Velvet')
                                                        Dry clean and steam iron recommended. Do not dry clothes in direct sunlight.
                                                    @else
                                                        Machine wash cold. Tumble dry low. Iron on low heat.
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="tab-moreinfo-item">
                                                <h6>Disclaimer:</h6>
                                                <span>Actual color may slightly vary from the pictures due to controlled lighting used in the shoot and/or due to your screen resolution.</span>
                                                <p>
                                                    The model's height is 5.4" and wearing small size.
                                                    {{ $product->embellishment != 'None' ? 'This ' . strtolower($product->embellishment) . ' is individually and exclusively created by each karigar.' : '' }}
                                                    Button and lace design may or may not vary depending upon the availability of same as original design from the vendor.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ec-spt-nav-details" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-desc mb-5">
                                        <div class="ec-single-pro-tab-moreinfo">
                                            <div class="tab-moreinfo-item">
                                                <h6>Product Specifications:</h6>
                                                <ul>
                                                    <li><strong>Fabric:</strong> {{ $product->fabric }}</li>
                                                    <li><strong>Cut:</strong> {{ $product->cut }}</li>
                                                    <li><strong>Embellishment:</strong> {{ $product->embellishment }}</li>
                                                    <li><strong>SKU:</strong> {{ $product->sku }}</li>
                                                    @if($product->categories->count() > 0)
                                                        <li><strong>Category:</strong> {{ $product->categories->first()->name }}</li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="tab-moreinfo-item">
                                                <h6>Description:</h6>
                                                <p>{{ $product->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details description area end -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Single product -->

    <!-- Related Products Section Start -->
    @if($relatedPopular->count() > 0)
        <section class="section ec-exe-spe-section section-space-mb-100">
            <div class="container">
                <div class="row">
                    <div class="ec-exe-section col-lg-12 col-md-12 col-sm-12">
                        <div class="col-md-12 text-left">
                            <div class="section-title mb-6 d-flex justify-content-between">
                                <h2 class="ec-title">Related Products</h2>
                                <a href="{{ route('products.index') }}" class="ec-stitle">View All
                                    <img src="{{ asset('website/assets/images/icon/arrow_right.svg') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($relatedPopular as $relatedProduct)
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="ec-product-content p-0">
                                        <div class="ec-product-inner hot-sale-card">
                                            <div class="ec-pro-image-outer">
                                                <div class="ec-pro-image hot-sale-img">
                                                    <a href="{{ route('product.detail', $relatedProduct->slug) }}" class="image sale-img">
                                                        @if($relatedProduct->images->count() > 0)
                                                            <img class="main-image" src="{{ asset($relatedProduct->images->first()->image_path) }}" alt="{{ $relatedProduct->name }}" />
                                                        @else
                                                            <img class="main-image" src="{{ asset('website/assets/images/product/default-product.jpg') }}" alt="{{ $relatedProduct->name }}" />
                                                        @endif
                                                    </a>
                                                    <div class="ec-pro-actions">
                                                        @if($relatedProduct->categories->count() > 0)
                                                            <span class="badge bg-white">{{ $relatedProduct->categories->first()->name }}</span>
                                                        @endif
                                                    </div>
                                                    @if($relatedProduct->discount_price && $relatedProduct->discount_price < $relatedProduct->price)
                                                        <div class="ec-pro-actions-sale">
                                                            @php
                                                                $discountPercent = round((($relatedProduct->price - $relatedProduct->discount_price) / $relatedProduct->price) * 100);
                                                            @endphp
                                                            <span class="badge bg-white">{{ $discountPercent }}% OFF</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="ec-pro-content text-center">
                                                <a href="{{ route('product.detail', $relatedProduct->slug) }}">
                                                    <h6 class="ec-pro-stitle">{{ $relatedProduct->name }}</h6>
                                                </a>
                                                <p class="ec-pro-subtitle">
                                                    {{ $relatedProduct->embellishment ? $relatedProduct->embellishment . ' | ' : '' }}
                                                    {{ $relatedProduct->fabric ? $relatedProduct->fabric . ' | ' : '' }}
                                                    {{ $relatedProduct->cut ? $relatedProduct->cut . ' Cut' : '' }}
                                                </p>
                                                <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                @if($relatedProduct->discount_price && $relatedProduct->discount_price < $relatedProduct->price)
                                                    <span class="old-price">Rs.{{ number_format($relatedProduct->price, 2) }}</span>
                                                    <span class="new-price">Rs.{{ number_format($relatedProduct->discount_price, 2) }}</span>
                                                @else
                                                    <span class="new-price">Rs.{{ number_format($relatedProduct->price, 2) }}</span>
                                                @endif
                                            </span>
                                                </div>
                                                <div class="ec-pro-size-wrapper">
                                                    @foreach($relatedProduct->sizes->take(4) as $size)
                                                        <div class="form-check ec-pro-size-btn {{ $size->is_active ? '' : 'empty' }}">
                                                            <input class="form-check-input"
                                                                   type="checkbox"
                                                                   id="rel_size_{{ $relatedProduct->id }}_{{ $size->id }}"
                                                                {{ !$size->is_active ? 'disabled' : '' }}>
                                                            <label class="form-check-label" for="rel_size_{{ $relatedProduct->id }}_{{ $size->id }}">
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
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Related Products Section End -->
@endsection
