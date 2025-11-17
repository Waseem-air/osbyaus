<style>
    /* ========================== */
    /* Table Styling              */
    /* ========================== */
    .table-customers {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border:none;
    }
    
    .table-customers thead th {
        font-size:18px;
        border:none;
        background-color: transparent !important;
        color: var(--Body-Text) !important;
        font-weight: 600 !important;
        padding: 12px 15px !important;
        vertical-align: middle !important;
    }
    
    .table-customers tbody td {
        font-size:16px;
        border:none;
        padding: 12px 15px !important;
        vertical-align: middle !important;
        color: var(--Body-Text) !important;
    }
    
    
    /* Avatar images */
    .customer-avatar {
        width: 50px !important;
        height: 50px !important;
        object-fit: cover !important;
        border-radius: 50% !important;
        display: block !important;
    }
    
    /* Name + verified badge */
    .customer-name {
        display: flex !important;
        flex-direction: column !important;
    }
    
    .customer-name a {
        color: var(--Heading) !important;
        font-weight: 600 !important;
        text-decoration: none !important;
    }
    
    .customer-name .text-success {
        font-size: 12px !important;
        color: var(--success) !important;
    }
    
    .customer-name .text-warning {
        font-size: 12px !important;
        color: var(--warning) !important;
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
        display: inline-block !important;
    }
    
    .status-badge.active {
        background-color: var(--Palette-Green-500) !important;
        color: var(--White) !important;
    }
    
    .status-badge.inactive {
        background-color: var(--Palette-Red-400) !important;
        color: var(--White) !important;
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
    @media (max-width: 768px) {
        .table-customers {
            display: block !important;
            overflow-x: auto !important;
        }
        
        .customer-avatar {
            width: 40px !important;
            height: 40px !important;
        }
        
        /* Status filter buttons in single row on mobile */
        .status-filter-container .btn-group {
            display: flex !important;
            width: 100% !important;
        }
        
        .status-filter-container .btn-group .btn {
            flex: 1 !important;
            text-align: center !important;
        }
        
        /* Sort and Clear filters in single row on mobile */
        .sort-filter-container {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100% !important;
            gap: 10px !important;
        }
        
        .sort-filter-container .d-flex {
            flex: 1 !important;
        }
        
        /* Add New Customer button full width on mobile */
        .add-customer-container .btn {
            width: 100% !important;
        }
    }
</style>

@if($customers->count() > 0)
    <div class="wg-box mt-5">
        <div class="table-responsive">
            <table class="table table-customers">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Phone Number</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="customersList">
                    @foreach($customers as $customer)
                        <tr id="customer-{{ $customer->id }}">
                            <td>
                                <div class="d-flex align-items-center">
                                    @isset($customer->profile_photo)
                                        <div class="me-3">
                                            <img class="customer-avatar" 
                                                 src="{{ asset($customer->profile_photo ?? 'assets/images/default-avatar.jpg') }}"
                                                 alt="{{ $customer->full_name }}">
                                        </div>
                                    @endisset
                                    <div class="customer-name">
                                        <a href="#">{{ $customer->full_name }}</a>
                                        @if($customer->email_verified_at)
                                            <div class="text-success small mt-1">✓ Verified</div>
                                        @else
                                            <div class="text-warning small mt-1">Unverified</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($customer->phone)
                                    <div>{{ $customer->phone }}</div>
                                @else
                                    <div class="text-muted">Not specified</div>
                                @endif
                            </td>
                            <td>
                                <span class="status-toggle status-badge {{ $customer->is_active ? 'active' : 'inactive' }}"
                                      data-id="{{ $customer->id }}"
                                      title="Click to toggle status">
                                    {{ $customer->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $customer->created_at->format('M d, Y') }}</td>
                            <td>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="divider" style="border-top: 1px solid var(--Stroke);"></div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
            <div class="text-tiny" style="color: var(--Body-Text);">
                Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries
            </div>

            @if($customers->hasPages())
                <nav>
                    <ul class="pagination mb-0">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="#" data-page="{{ $customers->currentPage() - 1 }}"
                               {{ $customers->onFirstPage() ? 'tabindex="-1"' : '' }}
                               style="background: var(--White); color: var(--Body-Text); ">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        @foreach($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
                            @if($page == $customers->currentPage())
                                <li class="page-item active">
                                    <span class="page-link" style="background: var(--Secondary); color: var(--White); ">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="#" data-page="{{ $page }}"
                                       style="background: var(--White); color: var(--Body-Text); ">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        <!-- Next Page Link -->
                        <li class="page-item {{ !$customers->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="#" data-page="{{ $customers->currentPage() + 1 }}"
                               {{ !$customers->hasMorePages() ? 'tabindex="-1"' : '' }}
                               style="background: var(--White); color: var(--Body-Text);">
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