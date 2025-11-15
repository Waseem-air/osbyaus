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
                        @include('website.partials.products-grid', ['products' => $products])
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentPage = 1;
            let isLoading = false;
            let timeout = null;

            // Filters object
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
            function initializePriceSlider() {
                const priceMin = $('#price-min');
                const priceMax = $('#price-max');
                const minPriceDisplay = $('#min-price');
                const maxPriceDisplay = $('#max-price');

                function updatePriceRange() {
                    filters.minPrice = parseInt(priceMin.val());
                    filters.maxPrice = parseInt(priceMax.val());
                    minPriceDisplay.val(filters.minPrice);
                    maxPriceDisplay.val(filters.maxPrice);
                    loadProducts();
                }

                priceMin.on('input', updatePriceRange);
                priceMax.on('input', updatePriceRange);
            }

            // Initialize filter event listeners
            function initializeFilters() {
                // Size filter
                $('.size-filter').on('change', function() {
                    const value = $(this).val();
                    if ($(this).is(':checked')) {
                        if (!filters.sizes.includes(value)) {
                            filters.sizes.push(value);
                        }
                    } else {
                        filters.sizes = filters.sizes.filter(size => size !== value);
                    }
                    loadProducts();
                });

                // Availability filter
                $('.availability-filter').on('change', function() {
                    const value = $(this).val();
                    if ($(this).is(':checked')) {
                        if (!filters.availability.includes(value)) {
                            filters.availability.push(value);
                        }
                    } else {
                        filters.availability = filters.availability.filter(avail => avail !== value);
                    }
                    loadProducts();
                });

                // Embellishment filter
                $('.embellishment-filter').on('change', function() {
                    const value = $(this).val();
                    if ($(this).is(':checked')) {
                        if (!filters.embellishments.includes(value)) {
                            filters.embellishments.push(value);
                        }
                    } else {
                        filters.embellishments = filters.embellishments.filter(emb => emb !== value);
                    }
                    loadProducts();
                });

                // Cut filter
                $('.cut-filter').on('change', function() {
                    const value = $(this).val();
                    if ($(this).is(':checked')) {
                        if (!filters.cuts.includes(value)) {
                            filters.cuts.push(value);
                        }
                    } else {
                        filters.cuts = filters.cuts.filter(cut => cut !== value);
                    }
                    loadProducts();
                });

                // Fabric filter
                $('.fabric-filter').on('change', function() {
                    const value = $(this).val();
                    if ($(this).is(':checked')) {
                        if (!filters.fabrics.includes(value)) {
                            filters.fabrics.push(value);
                        }
                    } else {
                        filters.fabrics = filters.fabrics.filter(fabric => fabric !== value);
                    }
                    loadProducts();
                });

                // Sort select
                $('#sort-by').on('change', function() {
                    filters.sort = $(this).val();
                    loadProducts();
                });

                // Clear filters
                $('#clear-filters, #reset-filters').on('click', function() {
                    resetFilters();
                    loadProducts();
                });
            }

            // Reset all filters
            function resetFilters() {
                // Uncheck all checkboxes
                $('input[type="checkbox"]').prop('checked', false);

                // Reset price range
                $('#price-min').val(0);
                $('#price-max').val(1000);
                $('#min-price').val(0);
                $('#max-price').val(1000);

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
                $('#sort-by').val('latest');
            }

            // Load products with AJAX
            function loadProducts(page = 1) {
                if (isLoading) return;

                // Clear previous timeout
                if (timeout) {
                    clearTimeout(timeout);
                }

                // Set new timeout for debouncing
                timeout = setTimeout(function() {
                    isLoading = true;
                    currentPage = page;

                    // Show loading spinner
                    $('#loading-spinner').show();
                    $('#products-container').hide();
                    $('#no-products').hide();

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
                    $.ajax({
                        url: `{{ route('products.index') }}?${params.toString()}`,
                        type: 'GET',
                        dataType: 'json',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(data) {
                            $('#products-container').html(data.html);
                            $('#results-count').text(`Showing: ${data.total} Results`);

                            // Show/hide containers
                            $('#loading-spinner').hide();
                            $('#products-container').show();

                            if (data.total === 0) {
                                $('#no-products').show();
                                $('#products-container').hide();
                            }

                            // Re-initialize pagination click handlers
                            initializePagination();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading products:', error);
                            $('#loading-spinner').hide();
                            $('#products-container').show();
                        },
                        complete: function() {
                            isLoading = false;
                        }
                    });
                }, 300); // 300ms debounce
            }

            // Initialize pagination click handlers
            function initializePagination() {
                $(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    const url = new URL($(this).attr('href'));
                    const page = url.searchParams.get('page') || 1;
                    loadProducts(page);
                });
            }

            // Initialize filters from URL parameters
            function initializeFromURL() {
                const urlParams = new URLSearchParams(window.location.search);

                // Sort
                if (urlParams.get('sort')) {
                    filters.sort = urlParams.get('sort');
                    $('#sort-by').val(filters.sort);
                }

                // Sizes
                if (urlParams.get('sizes')) {
                    filters.sizes = urlParams.get('sizes').split(',');
                    filters.sizes.forEach(size => {
                        $(`#size-${size}`).prop('checked', true);
                    });
                }

                // Availability
                if (urlParams.get('availability')) {
                    filters.availability = urlParams.get('availability').split(',');
                    filters.availability.forEach(avail => {
                        $(`#${avail.replace('_', '-')}`).prop('checked', true);
                    });
                }

                // Embellishments
                if (urlParams.get('embellishments')) {
                    filters.embellishments = urlParams.get('embellishments').split(',');
                    filters.embellishments.forEach(emb => {
                        $(`#embellishment-${emb}`).prop('checked', true);
                    });
                }

                // Cuts
                if (urlParams.get('cuts')) {
                    filters.cuts = urlParams.get('cuts').split(',');
                    filters.cuts.forEach(cut => {
                        $(`#cut-${cut}`).prop('checked', true);
                    });
                }

                // Fabrics
                if (urlParams.get('fabrics')) {
                    filters.fabrics = urlParams.get('fabrics').split(',');
                    filters.fabrics.forEach(fabric => {
                        $(`#fabric-${fabric}`).prop('checked', true);
                    });
                }

                // Price range
                if (urlParams.get('min_price')) {
                    filters.minPrice = parseInt(urlParams.get('min_price'));
                    $('#price-min').val(filters.minPrice);
                    $('#min-price').val(filters.minPrice);
                }

                if (urlParams.get('max_price')) {
                    filters.maxPrice = parseInt(urlParams.get('max_price'));
                    $('#price-max').val(filters.maxPrice);
                    $('#max-price').val(filters.maxPrice);
                }
            }

            // Initialize everything
            function initialize() {
                initializePriceSlider();
                initializeFilters();
                initializePagination();
                initializeFromURL();
            }

            // Start initialization
            initialize();
        });
    </script>
@endpush
