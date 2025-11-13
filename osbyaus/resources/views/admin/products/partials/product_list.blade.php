@if($products->count() > 0)
    <div class="wg-box mt-5">
        <div class="wg-table table-product-list">
            <ul class="table-title flex gap20 mb-14">
                <li>
                    <div class="body-title">Product</div>
                </li>
                <li>
                    <div class="body-title">Price</div>
                </li>
                <li>
                    <div class="body-title">Color & Size</div>
                </li>
                <li>
                    <div class="body-title">Stock</div>
                </li>
                <li>
                    <div class="body-title">Status</div>
                </li>
                <li>
                    <div class="body-title">Action</div>
                </li>
            </ul>

            <ul class="flex flex-column">
                @foreach($products as $product)
                    <li class="wg-product item-row gap20" data-product-id="{{ $product->id }}">
                        <!-- Product Image & Name -->
                        <div class="name">
                            <div class="image">
                                @if($product->mainImage)
                                    <img src="{{ asset($product->mainImage->image_path) }}"
                                         alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('admin/admin-ecomus/images/products/product-1.jpg') }}"
                                         alt="No Image">
                                @endif
                            </div>
                            <div class="title line-clamp-2 mb-0">
                                <a href="{{ route('admin.product.show', $product->id) }}" class="body-text">{{ $product->name }}</a>
                                <p>SKU: {{ $product->sku }}</p>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="body-text text-main-dark mt-4">
                            {{ \App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->final_price, 2) }}
                            @if($product->discount_price)
                                <br><small class="text-muted text-decoration-line-through">
                                    {{ \App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->price, 2) }}
                                </small>
                            @endif
                        </div>

                        <!-- Colors & Sizes -->
                        <div class="size-display-group">
                            @foreach($product->colors->take(3) as $productColor)
                                @if($productColor)
                                    <div class="size-display">
                                        <span class="color-circle"
                                              style="background-color: {{ $productColor->hex_code }};"></span>
                                    </div>
                                @endif
                            @endforeach

                            <div class="size-display">
                                <p>
                                    @foreach($product->sizes->take(3) as $productSize)
                                        @if($productSize)
                                            {{ $productSize->short_code }}@if(!$loop->last)
                                                /
                                            @endif
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>

                        <!-- Stock -->
                        <div class="body-text text-main-dark mt-4">
                            {{ $product->stock_quantity }}
                        </div>

                        <!-- Status -->
                        <div>
                            @if($product->stock_quantity > 0)
                                <div class="block-available bg-1 fw-7">In Stock</div>
                            @else
                                <div class="block-stock bg-1 fw-7">Out of stock</div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="list-icon-function">
                            <a href="{{ route('admin.product.show', $product->id) }}" class="item eye"
                               title="View">
                                <i class="icon-eye"></i>
                            </a>
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="item edit"
                               title="Edit">
                                <i class="icon-edit-3"></i>
                            </a>
                            <a href="#" class="item trash delete-product"
                               title="Delete"
                               data-id="{{ $product->id }}"
                               data-name="{{ $product->name }}">
                                <i class="icon-trash-2"></i>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="divider"></div>

        <!-- Pagination -->
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny">
                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
            </div>

            @if($products->hasPages())
                <nav class="pagination">
                    <ul class="flex items-center gap5">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="#" data-page="{{ $products->currentPage() - 1 }}"
                                {{ $products->onFirstPage() ? 'tabindex="-1"' : '' }}>
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if($page == $products->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="#" data-page="{{ $page }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        <!-- Next Page Link -->
                        <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="#" data-page="{{ $products->currentPage() + 1 }}"
                                {{ !$products->hasMorePages() ? 'tabindex="-1"' : '' }}>
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>
    </div>
@else
    <div class="text-center py-5">
        <div class="text-muted mb-3">
            <i class="icon-package" style="font-size: 48px;"></i>
        </div>
        <div class="body-text text-muted mb-4">No products found matching your criteria.</div>
        <a class="tf-button style-1 w208" href="{{ route('admin.product.add') }}">
            <i class="icon-plus"></i> Add First Product
        </a>
    </div>
@endif
