@if($products->count() > 0)
    <div class="wg-box mt-5">
        <div class="wg-table table-product-list">
            <ul class="table-title flex gap20 mb-14">
                <li>
                    <div class="body-title" style="color: var(--Heading);">Product</div>
                </li>
                <li>
                    <div class="body-title" style="color: var(--Heading);">Price</div>
                </li>
                <li>
                    <div class="body-title" style="color: var(--Heading);">Color & Size</div>
                </li>
                <li>
                    <div class="body-title" style="color: var(--Heading);">Stock</div>
                </li>
                <li>
                    <div class="body-title" style="color: var(--Heading);">Status</div>
                </li>
                <li>
                    <div class="body-title" style="color: var(--Heading);">Action</div>
                </li>
            </ul>

            <ul class="flex flex-column">
                @foreach($products as $product)
                    <li class="wg-product item-row gap20" data-product-id="{{ $product->id }}" style="border-bottom: 1px solid var(--Stroke);">
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
                                <a href="{{ route('admin.product.show', $product->id) }}" class="body-text" style="color: var(--Body-Text);">{{ $product->name }}</a>
                                <p style="color: var(--Note);">SKU: {{ $product->sku }}</p>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="body-text mt-4" style="color: var(--Secondary-Dark);">
                            {{ \App\Helpers\AppHelper::currency_symbol() }}{{ number_format($product->final_price, 2) }}
                            @if($product->discount_price)
                                <br><small class="text-decoration-line-through" style="color: var(--Note);">
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
                                              style="background-color: {{ $productColor->hex_code }}; border: 2px solid var(--White); box-shadow: 0 0 0 1px var(--Stroke);"></span>
                                    </div>
                                @endif
                            @endforeach

                            <div class="size-display">
                                <p style="color: var(--Body-Text);">
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
                        <div class="body-text mt-4" style="color: var(--Secondary-Dark);">
                            {{ $product->stock_quantity }}
                        </div>

                        <!-- Status -->
                        <div>
                            @if($product->stock_quantity > 0)
                                <div class="block-available fw-7" style="background: var(--Palette-Green-500); color: var(--White); padding: 6px 12px; border-radius: 20px; font-size: 12px; display: inline-block;">In Stock</div>
                            @else
                                <div class="block-stock fw-7" style="background: var(--Palette-Red-500); color: var(--White); padding: 6px 12px; border-radius: 20px; font-size: 12px; display: inline-block;">Out of stock</div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="list-icon-function">
                            <a href="{{ route('admin.product.show', $product->id) }}" class="item eye"
                               title="View" style="background: var(--Surface-3); color: var(--Icon);">
                                <i class="icon-eye"></i>
                            </a>
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="item edit"
                               title="Edit" style="background: var(--Surface-3); color: var(--Icon);">
                                <i class="icon-edit-3"></i>
                            </a>
                            <a href="#" class="item trash delete-product"
                               title="Delete"
                               data-id="{{ $product->id }}"
                               data-name="{{ $product->name }}"
                               style="background: var(--Surface-3); color: var(--Icon);">
                                <i class="icon-trash-2"></i>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="divider" style="border-top: 1px solid var(--Stroke);"></div>

        <!-- Pagination -->
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny" style="color: var(--Body-Text);">
                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
            </div>

            @if($products->hasPages())
                <nav class="pagination">
                    <ul class="flex items-center gap5">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="#" data-page="{{ $products->currentPage() - 1 }}"
                               {{ $products->onFirstPage() ? 'tabindex="-1"' : '' }}
                               style="background: var(--White); color: var(--Body-Text); border: 1px solid var(--Stroke);">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if($page == $products->currentPage())
                                <li class="page-item active">
                                    <span class="page-link" style="background: var(--Secondary); color: var(--White); border: 1px solid var(--Secondary);">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="#" data-page="{{ $page }}"
                                       style="background: var(--White); color: var(--Body-Text); border: 1px solid var(--Stroke);">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        <!-- Next Page Link -->
                        <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="#" data-page="{{ $products->currentPage() + 1 }}"
                               {{ !$products->hasMorePages() ? 'tabindex="-1"' : '' }}
                               style="background: var(--White); color: var(--Body-Text); border: 1px solid var(--Stroke);">
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
        <div class="mb-3">
            <i class="icon-package" style="font-size: 48px; color: var(--Icon);"></i>
        </div>
        <div class="body-text mb-4" style="color: var(--Body-Text);">No products found matching your criteria.</div>
        <a class="tf-button style-1 w208" href="{{ route('admin.product.add') }}"
           style="background: var(--Secondary); color: var(--White); border: 1px solid var(--Secondary);">
            <i class="icon-plus"></i> Add First Product
        </a>
    </div>
@endif
