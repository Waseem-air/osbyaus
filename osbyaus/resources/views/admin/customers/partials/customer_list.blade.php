<style>
    /* ========================== */
    /* Table Wrapper & Layout     */
    /* ========================== */
    .wg-table.table-all-customer {
        display: flex !important;
        flex-direction: column !important;
        gap: 10px !important;
        width: 100% !important;
        padding: 10px !important;
    }

    /* ========================== */
    /* Table Header               */
    /* ========================== */
    .wg-table.table-all-customer ul.table-title {
        display: flex !important;
        justify-content: flex-start !important;
        gap: 20px !important;
        font-weight: 600 !important;
        color: var(--Heading) !important;
    }

    /* Header Columns */
    .wg-table.table-all-customer ul.table-title li {
        flex: 1 !important;
        min-width: 120px !important;
        color: var(--Body-Text) !important;
    }

    /* Make name column wider */
    .wg-table.table-all-customer ul.table-title li:first-child {
        flex: 2 !important;
    }

    /* ========================== */
    /* Table Rows                 */
    /* ========================== */
    .wg-table.table-all-customer .wg-product {
        display: flex !important;
        align-items: center !important;
        gap: 20px !important;
        padding: 12px 15px !important;
    }
    /* Columns in rows */
    .wg-table.table-all-customer .wg-product > div {
        flex: 1 !important;
        min-width: 120px !important;
        color: var(--Body-Text) !important;
    }

    /* Name column */
    .wg-table.table-all-customer .wg-product .name {
        flex: 2 !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    /* Avatar images */
    .wg-table.table-all-customer .wg-product .image img {
        width: 50px !important;
        height: 50px !important;
        object-fit: cover !important;
        border-radius: 50% !important;
        display: block !important;
        border: 1px solid var(--Stroke) !important;
    }

    /* Name + verified badge */
    .wg-table.table-all-customer .wg-product .title {
        display: flex !important;
        flex-direction: column !important;
    }

    .wg-table.table-all-customer .wg-product .title a {
        color: var(--Heading) !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }

    .wg-table.table-all-customer .wg-product .title .text-success {
        font-size: 12px !important;
        color: var(--success) !important;
    }

    .wg-table.table-all-customer .wg-product .title .text-warning {
        font-size: 12px !important;
        color: var(--warning) !important;
    }

    /* Contact info & city */
    .wg-table.table-all-customer .wg-product .body-text {
        font-size: 14px !important;
        color: var(--Body-Text) !important;
    }

    /* Status badges */
    .status-badge {
        padding: 4px 12px !important;
        border-radius: 20px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        justify-content: center !important;
        cursor: pointer !important;
        user-select: none !important;
    }

    .status-badge.active {
        background-color: var(--Palette-Green-500) !important;
        color: var(--White) !important;
        border: 1px solid var(--Palette-Green-500) !important;
    }

    .status-badge.inactive {
        background-color: var(--Palette-Red-400) !important;
        color: var(--White) !important;
        border: 1px solid var(--Palette-Red-400) !important;
    }

    /* Actions column */
    .item-actions a {
        color: var(--Body-Text) !important;
        margin-right: 8px !important;
        font-size: 16px !important;
        transition: color 0.2s !important;
    }

    .item-actions a:hover {
        color: var(--Main) !important;
    }

    /* ========================== */
    /* Responsive Adjustments      */
    /* ========================== */
    @media (max-width: 1199px) {
        .wg-table.table-all-customer ul.table-title li,
        .wg-table.table-all-customer .wg-product > div {
            min-width: 100px !important;
        }
    }

    @media (max-width: 768px) {
        .wg-table.table-all-customer ul.table-title,
        .wg-table.table-all-customer .wg-product {
            flex-direction: column !important;
            align-items: flex-start !important;
        }

        .wg-table.table-all-customer .wg-product .name {
            margin-bottom: 10px !important;
        }

        .item-actions {
            margin-top: 10px !important;
        }
    }
</style>
@if($customers->count() > 0)
    <div class="wg-box mt-5">
        <div class="wg-table table-all-customer">
            <ul class="table-title flex gap20 mb-14">
                <li>
                    <div class="body-title">Customer</div>
                </li>
                <li>
                    <div class="body-title">Phone Number</div>
                </li>
                <li>
                    <div class="body-title">Status</div>
                </li>
                <li>
                    <div class="body-title">Created</div>
                </li>
                <li>
                    <div class="body-title">Actions</div>
                </li>
            </ul>

            <div class="flex flex-column" id="customersList">
                @foreach($customers as $customer)
                    <div class="wg-product item-row gap20" id="customer-{{ $customer->id }}">
                        <div class="name">
                            @isset($customer->profile_photo)
                                <div class="image">
                                    <img src="{{ asset($customer->profile_photo ?? 'assets/images/default-avatar.jpg') }}"
                                         alt="{{ $customer->full_name }}" width="60" height="60"
                                         style="object-fit: cover; border-radius: 50%;">
                                </div>
                            @endisset
                            <div class="title line-clamp-2 mb-0">
                                <a href="#" class="body-text fw-bold">{{ $customer->full_name  }}</a>
                                @if($customer->email_verified_at)
                                    <div class="text-success small mt-1">✓ Verified</div>
                                @else
                                    <div class="text-warning small mt-1">Unverified</div>
                                @endif
                            </div>
                        </div>

                        <div class="body-text">
                            @if($customer->phone)
                                <div>{{ $customer->phone }}</div>
                            @else
                                <div class="text-muted">Not specified</div>
                            @endif
                        </div>

                        <div class="body-text">
                            <span class="status-toggle status-badge {{ $customer->is_active ? 'active' : 'inactive' }}"
                                  data-id="{{ $customer->id }}"
                                  title="Click to toggle status">
                                {{ $customer->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        <div class="body-text text-main-dark">{{ $customer->created_at->format('M d, Y') }}</div>

                        <div class="item-actions">
                            <!-- Edit -->
                            <a href="javascript:void(0)" class="edit-customer"
                               data-id="{{ $customer->id }}"
                               data-bs-toggle="modal"
                               data-bs-target="#editCustomerModal"
                               title="Edit Customer">
                                <i class="icon-edit"></i>
                            </a>

                            <!-- Delete -->
                            <a href="javascript:void(0)" class="delete-customer"
                               data-id="{{ $customer->id }}"
                               data-name="{{ $customer->full_name }}"
                               title="Delete Customer">
                                <i class="icon-trash-2"></i>
                            </a>

                            <!-- View -->
                            <a href="{{ route('admin.customer.show', $customer->id) }}"
                               title="View Customer">
                                <i class="icon-eye"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="divider" style="border-top: 1px solid var(--Stroke);"></div>

        <!-- Pagination -->
        <div class="flex items-center justify-between flex-wrap gap10">
            <div class="text-tiny" style="color: var(--Body-Text);">
                Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries
            </div>

            @if($customers->hasPages())
                <nav class="pagination">
                    <ul class="flex items-center gap5">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="#" data-page="{{ $customers->currentPage() - 1 }}"
                               {{ $customers->onFirstPage() ? 'tabindex="-1"' : '' }}
                               style="background: var(--White); color: var(--Body-Text); border: 1px solid var(--Stroke);">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @foreach($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
                            @if($page == $customers->currentPage())
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
                        <li class="page-item {{ !$customers->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="#" data-page="{{ $customers->currentPage() + 1 }}"
                               {{ !$customers->hasMorePages() ? 'tabindex="-1"' : '' }}
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
            <i class="icon-users" style="font-size: 48px; color: var(--Icon);"></i>
        </div>
        <div class="body-text mb-4" style="color: var(--Body-Text);">No customers found matching your criteria.</div>
    </div>
@endif
