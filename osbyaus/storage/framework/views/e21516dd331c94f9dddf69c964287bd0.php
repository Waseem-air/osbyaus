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

<?php if($customers->count() > 0): ?>
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
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="customer-<?php echo e($customer->id); ?>">
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if(isset($customer->profile_photo)): ?>
                                        <div class="me-3">
                                            <img class="customer-avatar" 
                                                 src="<?php echo e(asset($customer->profile_photo ?? 'assets/images/default-avatar.jpg')); ?>"
                                                 alt="<?php echo e($customer->full_name); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="customer-name">
                                        <a href="#"><?php echo e($customer->full_name); ?></a>
                                        <?php if($customer->email_verified_at): ?>
                                            <div class="text-success small mt-1">✓ Verified</div>
                                        <?php else: ?>
                                            <div class="text-warning small mt-1">Unverified</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if($customer->phone): ?>
                                    <div><?php echo e($customer->phone); ?></div>
                                <?php else: ?>
                                    <div class="text-muted">Not specified</div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="status-toggle status-badge <?php echo e($customer->is_active ? 'active' : 'inactive'); ?>"
                                      data-id="<?php echo e($customer->id); ?>"
                                      title="Click to toggle status">
                                    <?php echo e($customer->is_active ? 'Active' : 'Inactive'); ?>

                                </span>
                            </td>
                            <td><?php echo e($customer->created_at->format('M d, Y')); ?></td>
                            <td>
                                <div class="item-actions">
                                    <!-- Edit -->
                                    <a href="javascript:void(0)" class="edit-customer"
                                       data-id="<?php echo e($customer->id); ?>"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editCustomerModal"
                                       title="Edit Customer">
                                        <i class="icon-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <a href="javascript:void(0)" class="delete-customer"
                                       data-id="<?php echo e($customer->id); ?>"
                                       data-name="<?php echo e($customer->full_name); ?>"
                                       title="Delete Customer">
                                        <i class="icon-trash-2"></i>
                                    </a>

                                    <!-- View -->
                                    <a href="<?php echo e(route('admin.customer.show', $customer->id)); ?>"
                                       title="View Customer">
                                        <i class="icon-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="divider" style="border-top: 1px solid var(--Stroke);"></div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
            <div class="text-tiny" style="color: var(--Body-Text);">
                Showing <?php echo e($customers->firstItem()); ?> to <?php echo e($customers->lastItem()); ?> of <?php echo e($customers->total()); ?> entries
            </div>

            <?php if($customers->hasPages()): ?>
                <nav>
                    <ul class="pagination mb-0">
                        <!-- Previous Page Link -->
                        <li class="page-item <?php echo e($customers->onFirstPage() ? 'disabled' : ''); ?>">
                            <a class="page-link" href="#" data-page="<?php echo e($customers->currentPage() - 1); ?>"
                               <?php echo e($customers->onFirstPage() ? 'tabindex="-1"' : ''); ?>

                               style="background: var(--White); color: var(--Body-Text); ">
                                <i class="icon-chevron-left"></i>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        <?php $__currentLoopData = $customers->getUrlRange(1, $customers->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($page == $customers->currentPage()): ?>
                                <li class="page-item active">
                                    <span class="page-link" style="background: var(--Secondary); color: var(--White); "><?php echo e($page); ?></span>
                                </li>
                            <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="#" data-page="<?php echo e($page); ?>"
                                       style="background: var(--White); color: var(--Body-Text); "><?php echo e($page); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Next Page Link -->
                        <li class="page-item <?php echo e(!$customers->hasMorePages() ? 'disabled' : ''); ?>">
                            <a class="page-link" href="#" data-page="<?php echo e($customers->currentPage() + 1); ?>"
                               <?php echo e(!$customers->hasMorePages() ? 'tabindex="-1"' : ''); ?>

                               style="background: var(--White); color: var(--Body-Text);">
                                <i class="icon-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="text-center py-5">
        <div class="mb-3">
            <i class="icon-users" style="font-size: 48px; color: var(--Icon);"></i>
        </div>
        <div class="body-text mb-4" style="color: var(--Body-Text);">No customers found matching your criteria.</div>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views/admin/customers/partials/customer_list.blade.php ENDPATH**/ ?>