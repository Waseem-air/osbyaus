@extends('website.layouts.main')
@section('title', 'Products')
@section('meta_description', 'Discover the best global fashion trends. Shop stylish clothing for men & women with fast worldwide delivery.')
@section('meta_keywords', 'fashion store, clothing shop, global fashion, men fashion, women fashion, ecommerce clothing')

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
                                <li class="ec-breadcrumb-item">Products</li>
                                <li class="ec-breadcrumb-item active">All Products</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Products Section -->
    <section class="ec-page-content category-tab section-space-p section-space-mb">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="ec-pro-leftside ec-common-leftside col-lg-3 order-lg-first col-md-12 order-md-last">
                    <div class="ec-sidebar-wrap mt-md-3 mt-4">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-category-wrapper">
                                <!-- Availability Filter -->
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Availability</h3>
                                    <div class="ec-category-item">
                                        <input class="form-check-input availability-filter" type="checkbox" id="in-stock" value="in_stock">
                                        <label for="in-stock">In stock</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input availability-filter" type="checkbox" id="out-stock" value="out_of_stock">
                                        <label for="out-stock">Out of stock</label>
                                    </div>
                                </div>

                                <!-- Size Filter -->
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Size</h3>
                                    <div class="d-flex align-items-start">
                                        <div class="w-100">
                                            @foreach($sizes as $size)
                                                <div class="ec-category-item">
                                                    <input class="form-check-input size-filter" type="checkbox"
                                                           id="size-{{ $size->id }}" value="{{ $size->id }}"
                                                        {{ $size->is_active ? '' : 'disabled' }}>
                                                    <label for="size-{{ $size->id }}">{{ $size->short_code ?? $size->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Price Range Filter -->
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Price Range</h3>
                                    <div class="range-slider">
                                        <span class="price-input up-input">
                                            <input type="number" class="left-input" id="min-price" value="0" min="0" max="1000" readonly/>
                                            <input type="number" class="right-input" id="max-price" value="1000" min="0" max="1000" readonly/>
                                        </span>
                                        <div class="slider-range">
                                            <input type="range" id="price-min" value="0" min="0" max="1000" step="10"/>
                                            <input type="range" id="price-max" value="1000" min="0" max="1000" step="10"/>
                                        </div>
                                        <span class="price-input down-input">
                                            <input type="number" class="left-input" value="0" min="0" max="1000" readonly/>
                                            <input type="number" class="right-input" value="1000" min="0" max="1000" readonly/>
                                        </span>
                                    </div>
                                </div>

                                <!-- Embellishment Filter -->
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Embellishment</h3>
                                    @foreach($embellishments as $embellishment)
                                        <div class="ec-category-item">
                                            <input class="form-check-input embellishment-filter" type="checkbox"
                                                   id="embellishment-{{ $embellishment }}" value="{{ $embellishment }}">
                                            <label for="embellishment-{{ $embellishment }}">{{ $embellishment }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Cut Style Filter -->
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Cut Style</h3>
                                    @foreach($cuts as $cut)
                                        <div class="ec-category-item">
                                            <input class="form-check-input cut-filter" type="checkbox"
                                                   id="cut-{{ $cut }}" value="{{ $cut }}">
                                            <label for="cut-{{ $cut }}">{{ $cut }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Fabric Filter -->
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Fabric</h3>
                                    @foreach($fabrics as $fabric)
                                        <div class="ec-category-item">
                                            <input class="form-check-input fabric-filter" type="checkbox"
                                                   id="fabric-{{ $fabric }}" value="{{ $fabric }}">
                                            <label for="fabric-{{ $fabric }}">{{ $fabric }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Clear Filters Button -->
                                <div class="ec-category-items">
                                    <button class="btn btn-outline-dark w-100" id="clear-filters">
                                        <i class="fi-rr-refresh"></i> Clear All Filters
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Area End -->

                <!-- Products Section Start -->
                <div class="ec-pro-rightside ec-common-rightside col-lg-9 order-lg-last col-md-12 order-md-first">
                    <!-- Products Header with Sort and Results -->
                    <div class="ec-pro-content-sort">
                        <span class="sort-result" id="results-count">
                            Showing: {{ $products->total() }} Results
                        </span>
                        <div class="ec-select-inner">
                            <select name="sort-by" id="sort-by" class="form-select">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name, A to Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name, Z to A</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price, low to high</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price, high to low</option>
                            </select>
                        </div>
                    </div>

                    <!-- Loading Spinner -->
                    <div id="loading-spinner" class="text-center py-5" style="display: none;">
                        <div class="spinner-border text-dark" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Loading products...</p>
                    </div>

                    <!-- Products Grid -->
                    <div id="products-container">
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
                                                        <span class="old-price">Rs.{{ number_format($product->price, 2) }}</span>
                                                        <span class="new-price">Rs.{{ number_format($product->discount_price, 2) }}</span>
                                                    @else
                                                        <span class="new-price">Rs.{{ number_format($product->price, 2) }}</span>
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

                        <!-- Pagination -->
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
                    </div>

                    <!-- No Products Found -->
                    <div id="no-products" class="text-center py-5" style="display: none;">
                        <i class="fi-rr-search-alt" style="font-size: 3rem; color: #ccc;"></i>
                        <h4 class="mt-3">No products found</h4>
                        <p class="text-muted">Try adjusting your filters or search terms</p>
                        <button class="btn btn-dark mt-2" id="reset-filters">Reset Filters</button>
                    </div>
                </div>
                <!-- Products Section End -->
            </div>
        </div>
    </section>
    <!-- End Products Section -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentPage = 1;
            let isLoading = false;
            let filters = {
                sizes: [],
                availability: [],
                minPrice: 0,
                maxPrice: 1000,
                embellishments: [],
                cuts: [],
                fabrics: [],
                sort: 'latest'
            };

            // Initialize price range slider
            const priceMin = document.getElementById('price-min');
            const priceMax = document.getElementById('price-max');
            const minPriceDisplay = document.getElementById('min-price');
            const maxPriceDisplay = document.getElementById('max-price');

            function updatePriceRange() {
                filters.minPrice = parseInt(priceMin.value);
                filters.maxPrice = parseInt(priceMax.value);
                minPriceDisplay.value = filters.minPrice;
                maxPriceDisplay.value = filters.maxPrice;
                loadProducts();
            }

            priceMin.addEventListener('input', updatePriceRange);
            priceMax.addEventListener('input', updatePriceRange);

            // Filter event listeners
            document.querySelectorAll('.size-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        filters.sizes.push(this.value);
                    } else {
                        filters.sizes = filters.sizes.filter(size => size !== this.value);
                    }
                    loadProducts();
                });
            });

            document.querySelectorAll('.availability-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        filters.availability.push(this.value);
                    } else {
                        filters.availability = filters.availability.filter(avail => avail !== this.value);
                    }
                    loadProducts();
                });
            });

            document.querySelectorAll('.embellishment-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        filters.embellishments.push(this.value);
                    } else {
                        filters.embellishments = filters.embellishments.filter(emb => emb !== this.value);
                    }
                    loadProducts();
                });
            });

            document.querySelectorAll('.cut-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        filters.cuts.push(this.value);
                    } else {
                        filters.cuts = filters.cuts.filter(cut => cut !== this.value);
                    }
                    loadProducts();
                });
            });

            document.querySelectorAll('.fabric-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        filters.fabrics.push(this.value);
                    } else {
                        filters.fabrics = filters.fabrics.filter(fabric => fabric !== this.value);
                    }
                    loadProducts();
                });
            });

            // Sort select
            document.getElementById('sort-by').addEventListener('change', function() {
                filters.sort = this.value;
                loadProducts();
            });

            // Clear filters
            document.getElementById('clear-filters').addEventListener('click', function() {
                resetFilters();
                loadProducts();
            });

            document.getElementById('reset-filters').addEventListener('click', function() {
                resetFilters();
                loadProducts();
            });

            function resetFilters() {
                // Reset all checkboxes
                document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                    checkbox.checked = false;
                });

                // Reset price range
                priceMin.value = 0;
                priceMax.value = 1000;
                minPriceDisplay.value = 0;
                maxPriceDisplay.value = 1000;

                // Reset filters object
                filters = {
                    sizes: [],
                    availability: [],
                    minPrice: 0,
                    maxPrice: 1000,
                    embellishments: [],
                    cuts: [],
                    fabrics: [],
                    sort: 'latest'
                };

                // Reset sort select
                document.getElementById('sort-by').value = 'latest';
            }

            // Load products with AJAX
            function loadProducts(page = 1) {
                if (isLoading) return;

                isLoading = true;
                currentPage = page;

                // Show loading spinner
                document.getElementById('loading-spinner').style.display = 'block';
                document.getElementById('products-container').style.display = 'none';
                document.getElementById('no-products').style.display = 'none';

                // Prepare query parameters
                const params = new URLSearchParams();
                params.append('page', page);
                params.append('sort', filters.sort);

                if (filters.sizes.length) params.append('sizes', filters.sizes.join(','));
                if (filters.availability.length) params.append('availability', filters.availability.join(','));
                if (filters.embellishments.length) params.append('embellishments', filters.embellishments.join(','));
                if (filters.cuts.length) params.append('cuts', filters.cuts.join(','));
                if (filters.fabrics.length) params.append('fabrics', filters.fabrics.join(','));
                params.append('min_price', filters.minPrice);
                params.append('max_price', filters.maxPrice);

                // Update URL without page reload
                const newUrl = `${window.location.pathname}?${params.toString()}`;
                window.history.pushState({}, '', newUrl);

                // AJAX request
                fetch(`{{ route('products.index') }}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('products-container').innerHTML = data.html;
                        document.getElementById('results-count').textContent = `Showing: ${data.total} Results`;

                        // Show/hide containers
                        document.getElementById('loading-spinner').style.display = 'none';
                        document.getElementById('products-container').style.display = 'block';

                        if (data.total === 0) {
                            document.getElementById('no-products').style.display = 'block';
                            document.getElementById('products-container').style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error loading products:', error);
                        document.getElementById('loading-spinner').style.display = 'none';
                        document.getElementById('products-container').style.display = 'block';
                    })
                    .finally(() => {
                        isLoading = false;
                    });
            }

            // Handle pagination clicks
            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination a')) {
                    e.preventDefault();
                    const url = new URL(e.target.closest('a').href);
                    const page = url.searchParams.get('page') || 1;
                    loadProducts(page);
                }
            });

            // Initialize filters from URL
            function initializeFromURL() {
                const urlParams = new URLSearchParams(window.location.search);

                if (urlParams.get('sort')) {
                    filters.sort = urlParams.get('sort');
                    document.getElementById('sort-by').value = filters.sort;
                }

                if (urlParams.get('sizes')) {
                    filters.sizes = urlParams.get('sizes').split(',');
                    filters.sizes.forEach(size => {
                        const checkbox = document.getElementById(`size-${size}`);
                        if (checkbox) checkbox.checked = true;
                    });
                }

                // Initialize other filters similarly...
            }

            // Debounce function to prevent too many requests
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Debounce the loadProducts function
            const debouncedLoadProducts = debounce(loadProducts, 300);

            // Replace original loadProducts calls with debounced version
            const originalLoadProducts = loadProducts;
            loadProducts = debouncedLoadProducts;

            // Initialize from URL on page load
            initializeFromURL();
        });
    </script>
@endpush
