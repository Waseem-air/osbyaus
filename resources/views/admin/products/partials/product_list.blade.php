<style>
    /* ========================== */
    /* Table Wrapper & Layout     */
    /* ========================== */
    .wg-table.table-all-product {
        display: flex !important;
        flex-direction: column !important;
        gap: 10px !important;
        width: 100% !important;
        padding: 15px !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        background-color: var(--bg-table) !important;
        border-radius: 12px !important;
    }

    /* ========================== */
    /* Table Header               */
    /* ========================== */
    .wg-table.table-all-product ul.table-title {
        display: flex !important;
        justify-content: flex-start !important;
        gap: 20px !important;
        font-weight: 600 !important;
        color: var(--Heading) !important;
        border-bottom: 2px solid var(--Stroke) !important;
        padding-bottom: 10px !important;
    }

    /* Header Columns */
    .wg-table.table-all-product ul.table-title li {
        flex: 1 !important;
        min-width: 120px !important;
        color: var(--Body-Text) !important;
    }

    /* Make first column wider */
    .wg-table.table-all-product ul.table-title li:first-child {
        flex: 2 !important;
    }

    /* ========================== */
    /* Table Rows                 */
    /* ========================== */
    .wg-table.table-all-product .wg-product {
        display: flex !important;
        align-items: center !important;
        gap: 20px !important;
        padding: 12px 15px !important;
        background-color: var(--White) !important;
        border-radius: 12px !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05) !important;
        transition: transform 0.2s, box-shadow 0.2s !important;
        border-bottom: 1px solid var(--Stroke) !important;
    }

    /* Hover effect */
    .wg-table.table-all-product .wg-product:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }

    /* Columns in row */
    .wg-table.table-all-product .wg-product > div {
        flex: 1 !important;
        min-width: 120px !important;
        color: var(--Body-Text) !important;
    }

    /* Name column */
    .wg-table.table-all-product .wg-product .name {
        flex: 2 !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    /* Product image */
    .wg-table.table-all-product .wg-product .image img {
        width: 50px !important;
        height: 50px !important;
        object-fit: cover !important;
        border-radius: 50% !important;
        display: block !important;
        border: 1px solid var(--Stroke) !important;
    }

    /* Name + SKU */
    .wg-table.table-all-product .wg-product .title {
        display: flex !important;
        flex-direction: column !important;
    }

    .wg-table.table-all-product .wg-product .title a {
        color: var(--Heading) !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }

    .wg-table.table-all-product .wg-product .title p {
        color: var(--Note) !important;
        font-size: 12px !important;
        margin: 2px 0 0 !important;
    }

    /* Price */
    .wg-table.table-all-product .wg-product .body-text {
        font-size: 14px !important;
        color: var(--Body-Text) !important;
    }

    .wg-table.table-all-product .wg-product .body-text small {
        color: var(--Note) !important;
        font-size: 12px !important;
    }

    /* Colors & Sizes */
    .size-display-group {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .size-display .color-circle {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        display: inline-block;
        border: 1px solid var(--Stroke);
    }

    /* Stock status badges */
    .block-available, .block-stock {
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        display: inline-block !important;
    }

    .block-available {
        background-color: var(--Palette-Green-500) !important;
        color: var(--White) !important;
    }

    .block-stock {
        background-color: var(--Palette-Red-500) !important;
        color: var(--White) !important;
    }

    /* Actions column */
    .list-icon-function a.item {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        font-size: 16px !important;
        transition: all 0.2s;
    }

    .list-icon-function a.item:hover {
        background-color: var(--Main) !important;
        color: var(--White) !important;
    }

    /* Responsive Adjustments */
    @media (max-width: 1199px) {
        .wg-table.table-all-product ul.table-title li,
        .wg-table.table-all-product .wg-product > div {
            min-width: 100px !important;
        }
    }

    @media (max-width: 768px) {
        .wg-table.table-all-product ul.table-title,
        .wg-table.table-all-product .wg-product {
            flex-direction: column !important;
            align-items: flex-start !important;
        }

        .wg-table.table-all-product .wg-product .name {
            margin-bottom: 10px !important;
        }

        .list-icon-function {
            margin-top: 10px !important;
        }
    }

</style>
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
                        <div class="item-actions">
                            <a href="{{ route('admin.product.show', $product->id) }}"
                               title="View">
                                <i class="icon-eye"></i>
                            </a>
                            <a href="{{ route('admin.product.edit', $product->id) }}"
                               title="Edit">
                                <i class="icon-edit"></i>
                            </a>
                            <a href="#" class=" trash delete-product"
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
