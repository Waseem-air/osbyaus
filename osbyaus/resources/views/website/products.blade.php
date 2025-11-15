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
                            <ul class="ec-breadcrumb-list text-left">
                                <li class="ec-breadcrumb-item"><a href="{{ route('home') }}"><i class="fi-rr-home"></i></a></li>
                                <li class="ec-breadcrumb-item">Products</li>
                                <li class="ec-breadcrumb-item active">All Products</li>
                            </ul>
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
                                <form id="filter-form" method="POST" action="{{ route('products.filter') }}">
                                    @csrf

                                    <!-- Availability Filter -->
                                    <div class="ec-category-items">
                                        <h3 class="ec-category-title">Availability</h3>
                                        <div class="ec-category-item">
                                            <input class="form-check-input availability-filter" type="checkbox"
                                                   name="availability[]" id="in-stock" value="in_stock"
                                                {{ in_array('in_stock', $filters['availability'] ?? []) ? 'checked' : '' }}>
                                            <label for="in-stock">In stock</label>
                                        </div>
                                        <div class="ec-category-item">
                                            <input class="form-check-input availability-filter" type="checkbox"
                                                   name="availability[]" id="out-stock" value="out_of_stock"
                                                {{ in_array('out_of_stock', $filters['availability'] ?? []) ? 'checked' : '' }}>
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
                                                               name="sizes[]" id="size-{{ $size->id }}" value="{{ $size->id }}"
                                                            {{ in_array($size->id, $filters['sizes'] ?? []) ? 'checked' : '' }}
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
                                                <input type="number" class="left-input" id="min-price"
                                                       name="min_price" value="{{ $filters['min_price'] ?? 0 }}"
                                                       min="0" max="1000" readonly/>
                                                <input type="number" class="right-input" id="max-price"
                                                       name="max_price" value="{{ $filters['max_price'] ?? 1000 }}"
                                                       min="0" max="1000" readonly/>
                                            </span>
                                            <div class="slider-range">
                                                <input type="range" id="price-min" value="{{ $filters['min_price'] ?? 0 }}" min="0" max="1000" step="10"/>
                                                <input type="range" id="price-max" value="{{ $filters['max_price'] ?? 1000 }}" min="0" max="1000" step="10"/>
                                            </div>
                                            <span class="price-input down-input">
                                                <input type="number" class="left-input" value="{{ $filters['min_price'] ?? 0 }}" min="0" max="1000" readonly/>
                                                <input type="number" class="right-input" value="{{ $filters['max_price'] ?? 1000 }}" min="0" max="1000" readonly/>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Embellishment Filter -->
                                    <div class="ec-category-items">
                                        <h3 class="ec-category-title">Embellishment</h3>
                                        @foreach($embellishments as $embellishment)
                                            <div class="ec-category-item">
                                                <input class="form-check-input embellishment-filter" type="checkbox"
                                                       name="embellishments[]" id="embellishment-{{ $embellishment }}"
                                                       value="{{ $embellishment }}"
                                                    {{ in_array($embellishment, $filters['embellishments'] ?? []) ? 'checked' : '' }}>
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
                                                       name="cuts[]" id="cut-{{ $cut }}" value="{{ $cut }}"
                                                    {{ in_array($cut, $filters['cuts'] ?? []) ? 'checked' : '' }}>
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
                                                       name="fabrics[]" id="fabric-{{ $fabric }}" value="{{ $fabric }}"
                                                    {{ in_array($fabric, $filters['fabrics'] ?? []) ? 'checked' : '' }}>
                                                <label for="fabric-{{ $fabric }}">{{ $fabric }}</label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Hidden sort field -->
                                    <input type="hidden" name="sort" id="sort-input" value="{{ $filters['sort'] ?? 'latest' }}">

                                    <!-- Clear Filters Button -->
                                    <div class="ec-category-items">
                                        <button type="button" class="btn btn-outline-dark w-100" id="clear-filters">
                                            <i class="fi-rr-refresh"></i> Clear All Filters
                                        </button>
                                    </div>
                                </form>
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
                                <option value="latest" {{ ($filters['sort'] ?? 'latest') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="featured" {{ ($filters['sort'] ?? '') == 'featured' ? 'selected' : '' }}>Featured</option>
                                <option value="name_asc" {{ ($filters['sort'] ?? '') == 'name_asc' ? 'selected' : '' }}>Name, A to Z</option>
                                <option value="name_desc" {{ ($filters['sort'] ?? '') == 'name_desc' ? 'selected' : '' }}>Name, Z to A</option>
                                <option value="price_asc" {{ ($filters['sort'] ?? '') == 'price_asc' ? 'selected' : '' }}>Price, low to high</option>
                                <option value="price_desc" {{ ($filters['sort'] ?? '') == 'price_desc' ? 'selected' : '' }}>Price, high to low</option>
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
                        @include('website.partials.products-grid', ['products' => $products])
                    </div>

                    <!-- No Products Found -->
                    <div id="no-products" class="text-center py-5" style="display: none;">
                        <i class="fi-rr-search-alt" style="font-size: 3rem; color: #ccc;"></i>
                        <h4 class="mt-3">No products found</h4>
                        <p class="text-muted">Try adjusting your filters or search terms</p>
                        <a href="{{ route('products.clear-filters') }}" class="btn btn-dark mt-2">Reset Filters</a>
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
            let isLoading = false;
            let timeout = null;
            let currentPage = 1;
            let hasMore = true;
            let totalProducts = {{ $products->total() }};
            let perPage = 12;

            // Initialize elements
            const priceMin = document.getElementById('price-min');
            const priceMax = document.getElementById('price-max');
            const minPriceDisplay = document.getElementById('min-price');
            const maxPriceDisplay = document.getElementById('max-price');
            const sortInput = document.getElementById('sort-input');
            const filterForm = document.getElementById('filter-form');
            const loadMoreBtn = document.getElementById('load-more-btn');
            const loadMoreLoader = document.getElementById('load-more-loader');
            const endOfProducts = document.getElementById('end-of-products');
            const loadedCount = document.getElementById('loaded-count');
            const resultsCount = document.getElementById('results-count');

            // Initialize load more button
            function initializeLoadMore() {
                updateLoadMoreVisibility();
                updateLoadedCount();
            }

            // Show loading state immediately when filters change
            function showFilterLoadingState() {
                resultsCount.textContent = 'Filtering...';
                const productsContainer = document.getElementById('products-container');
                if (productsContainer) {
                    productsContainer.style.opacity = '0.6';
                }
            }

            // Update URL with current filter state
            function updateURLWithFilters() {
                const formData = new FormData(filterForm);
                const params = new URLSearchParams();

                for (const [key, value] of formData.entries()) {
                    if (key !== '_token') {
                        params.append(key, value);
                    }
                }

                const newURL = window.location.pathname + '?' + params.toString();
                window.history.pushState({path: newURL}, '', newURL);
            }

            // Update load more button visibility - FIXED VERSION
            function updateLoadMoreVisibility() {
                // Always check if there are more products to load based on the response
                if (hasMore) {
                    if (loadMoreBtn) {
                        loadMoreBtn.style.display = 'block';
                    }
                    if (endOfProducts) {
                        endOfProducts.style.display = 'none';
                    }
                } else {
                    if (loadMoreBtn) {
                        loadMoreBtn.style.display = 'none';
                    }
                    if (totalProducts > 0 && endOfProducts) {
                        endOfProducts.style.display = 'block';
                    }
                }

                if (loadMoreLoader) {
                    loadMoreLoader.style.display = 'none';
                }
            }

            // Update loaded count
            function updateLoadedCount() {
                const currentLoaded = Math.min(currentPage * perPage, totalProducts);
                if (loadedCount) {
                    loadedCount.textContent = `${currentLoaded} / ${totalProducts}`;
                }
                resultsCount.textContent = `Showing: ${currentLoaded} of ${totalProducts} Results`;
            }

            // Price range slider
            function updatePriceRange() {
                showFilterLoadingState();
                const minVal = parseInt(priceMin.value);
                const maxVal = parseInt(priceMax.value);
                minPriceDisplay.value = minVal;
                maxPriceDisplay.value = maxVal;
                resetLoadMore();
                loadProducts();
                updateURLWithFilters();
            }

            if (priceMin && priceMax) {
                priceMin.addEventListener('input', updatePriceRange);
                priceMax.addEventListener('input', updatePriceRange);
            }

            // Filter event listeners
            document.querySelectorAll('.size-filter, .availability-filter, .embellishment-filter, .cut-filter, .fabric-filter').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    showFilterLoadingState();
                    resetLoadMore();
                    loadProducts();
                    updateURLWithFilters();
                });
            });

            // Sort select
            document.getElementById('sort-by').addEventListener('change', function() {
                showFilterLoadingState();
                sortInput.value = this.value;
                resetLoadMore();
                loadProducts();
                updateURLWithFilters();
            });

            // Clear filters
            document.getElementById('clear-filters').addEventListener('click', function() {
                window.location.href = "{{ route('products.clear-filters') }}";
            });

            // Load more button
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    loadMoreProducts();
                });
            }

            // Reset load more state - FIXED VERSION
            function resetLoadMore() {
                currentPage = 1;
                // Don't set hasMore to true here, let it be determined by the server response
                if (loadMoreBtn) {
                    loadMoreBtn.style.display = 'none';
                }
                if (loadMoreLoader) {
                    loadMoreLoader.style.display = 'none';
                }
                if (endOfProducts) {
                    endOfProducts.style.display = 'none';
                }
            }

            // Load products with AJAX POST - FIXED VERSION
            function loadProducts() {
                if (isLoading) return;

                if (timeout) {
                    clearTimeout(timeout);
                }

                timeout = setTimeout(function() {
                    isLoading = true;
                    currentPage = 1;

                    document.getElementById('loading-spinner').style.display = 'block';
                    document.getElementById('products-container').style.display = 'none';
                    document.getElementById('no-products').style.display = 'none';
                    if (loadMoreBtn) {
                        loadMoreBtn.style.display = 'none';
                    }
                    if (loadMoreLoader) {
                        loadMoreLoader.style.display = 'none';
                    }
                    if (endOfProducts) {
                        endOfProducts.style.display = 'none';
                    }

                    const formData = new FormData(filterForm);
                    formData.append('page', currentPage);

                    fetch("{{ route('products.filter') }}", {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            const productsContainer = document.getElementById('products-container');
                            productsContainer.style.opacity = '1';
                            productsContainer.innerHTML = data.html;
                            totalProducts = data.total;
                            hasMore = data.hasMore;
                            perPage = data.perPage || 12;

                            document.getElementById('loading-spinner').style.display = 'none';
                            document.getElementById('products-container').style.display = 'block';

                            if (data.total === 0) {
                                document.getElementById('no-products').style.display = 'block';
                                document.getElementById('products-container').style.display = 'none';
                                if (loadMoreBtn) {
                                    loadMoreBtn.style.display = 'none';
                                }
                                if (endOfProducts) {
                                    endOfProducts.style.display = 'none';
                                }
                            } else {
                                updateLoadedCount();
                                // Remove the conditional check here and rely solely on updateLoadMoreVisibility()
                                updateLoadMoreVisibility();
                            }
                        })
                        .catch(error => {
                            console.error('Error loading products:', error);
                            document.getElementById('loading-spinner').style.display = 'none';
                            document.getElementById('products-container').style.display = 'block';
                            document.getElementById('products-container').innerHTML = '<div class="alert alert-danger">Error loading products. Please try again.</div>';
                            updateLoadMoreVisibility();
                        })
                        .finally(() => {
                            isLoading = false;
                        });
                }, 300);
            }

            // Load more products
            function loadMoreProducts() {
                if (isLoading || !hasMore) return;

                isLoading = true;
                currentPage++;

                if (loadMoreBtn) {
                    loadMoreBtn.style.display = 'none';
                }
                if (loadMoreLoader) {
                    loadMoreLoader.style.display = 'block';
                }

                const formData = new FormData(filterForm);
                formData.append('page', currentPage);
                formData.append('load_more', true);

                fetch("{{ route('products.filter') }}", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const productsGrid = document.getElementById('products-grid');
                        if (productsGrid && data.html) {
                            productsGrid.insertAdjacentHTML('beforeend', data.html);
                        }

                        hasMore = data.hasMore;
                        totalProducts = data.total;
                        updateLoadedCount();

                        if (loadMoreLoader) {
                            loadMoreLoader.style.display = 'none';
                        }
                        updateLoadMoreVisibility();

                        if (hasMore && loadMoreBtn) {
                            setTimeout(() => {
                                loadMoreBtn.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center',
                                    inline: 'nearest'
                                });
                            }, 100);
                        }
                    })
                    .catch(error => {
                        console.error('Error loading more products:', error);
                        if (loadMoreLoader) {
                            loadMoreLoader.style.display = 'none';
                        }
                        if (loadMoreBtn) {
                            loadMoreBtn.style.display = 'block';
                            loadMoreBtn.innerHTML = '<i class="fi-rr-exclamation"></i> Error - Click to Retry';
                        }
                        currentPage--;
                    })
                    .finally(() => {
                        isLoading = false;
                    });
            }

            // Initialize on page load
            initializeLoadMore();

            // Debug helper
            document.querySelectorAll('input[type="checkbox"], select').forEach(element => {
                element.addEventListener('change', function() {
                    console.log('Filter changed:', this.name, this.value, this.checked);
                });
            });
        });
    </script>
@endpush
