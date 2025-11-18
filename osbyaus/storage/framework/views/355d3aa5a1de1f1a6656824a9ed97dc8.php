<?php $__env->startSection('styles'); ?>
    <style>
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .status-badge.active { background-color: #28a745; color: #fff; }
        .status-badge.inactive { background-color: #dc3545; color: #fff; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <!-- Header -->
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3><?php echo e($category->name); ?> <span class="status-badge <?php echo e($category->is_active ? 'active' : 'inactive'); ?>"><?php echo e($category->is_active ? 'Active' : 'Inactive'); ?></span></h3>
                    <div class="flex items-center gap20">
                        <span class="body-text">Total Products: <?php echo e($category->products->count()); ?></span>
                        <a href="<?php echo e(route('admin.category.index')); ?>" class="tf-button style-2 w150">
                            <i class="icon-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <!-- Category Details -->
                <div class="wg-box mb-4 mt-5">
                    <div class="wg-table">
                        <ul class="table-title flex gap20 mb-14">
                            <li><div class="body-title">Image</div></li>
                            <li><div class="body-title">Slug</div></li>
                            <li><div class="body-title">Description</div></li>
                            <li><div class="body-title">Created</div></li>
                        </ul>
                        <div class="flex flex-column">
                            <div class="wg-product item-row gap20">
                                <div class="name">
                                    <div class="image">
                                        <img src="<?php echo e(asset($category->image ?? 'assets/images/default-category.jpg')); ?>"
                                             alt="<?php echo e($category->name); ?>" width="80" height="80" style="object-fit: cover; border-radius: 8px;">
                                    </div>
                                </div>
                                <div class="body-text text-main-dark"><?php echo e($category->slug); ?></div>
                                <div class="body-text"><?php echo e($category->description ?? 'N/A'); ?></div>
                                <div class="body-text text-main-dark"><?php echo e($category->created_at->format('M d, Y')); ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products List -->
                <div class="wg-box">
                    <div class="wg-table table-all-category">
                        <ul class="table-title flex gap20 mb-14">
                            <li><div class="body-title">Product</div></li>
                            <li><div class="body-title">SKU</div></li>
                            <li><div class="body-title">Price</div></li>
                            <li><div class="body-title">Status</div></li>
                            <li><div class="body-title">Created</div></li>
                            <li><div class="body-title">Actions</div></li>
                        </ul>

                        <div class="flex flex-column" id="productsList">
                            <?php $__empty_1 = true; $__currentLoopData = $category->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="wg-product item-row gap20" id="product-<?php echo e($product->id); ?>">
                                    <div class="name d-flex align-items-center gap10">
                                        <div class="image">
                                            <img src="<?php echo e(asset($product->image ?? 'assets/images/default-product.jpg')); ?>" alt="<?php echo e($product->name); ?>" width="60" height="60" style="object-fit: cover; border-radius: 8px;">
                                        </div>
                                        <div class="title line-clamp-2 mb-0">
                                            <a href="<?php echo e(route('admin.product.show', $product->id)); ?>" class="body-text fw-bold"><?php echo e($product->name); ?></a>
                                        </div>
                                    </div>

                                    <div class="body-text text-main-dark"><?php echo e($product->sku ?? 'N/A'); ?></div>
                                    <div class="body-text">$<?php echo e(number_format($product->price,2)); ?></div>
                                    <div class="body-text">
                                <span class="status-badge <?php echo e($product->is_active ? 'active' : 'inactive'); ?>">
                                    <?php echo e($product->is_active ? 'Active' : 'Inactive'); ?>

                                </span>
                                    </div>
                                    <div class="body-text text-main-dark"><?php echo e($product->created_at->format('M d, Y')); ?></div>

                                    <div class="item-actions">
                                        <a href="<?php echo e(route('admin.product.edit', $product->id)); ?>" title="Edit"><i class="icon-edit"></i></a>
                                        <a href="javascript:void(0)" class="delete-product" data-id="<?php echo e($product->id); ?>" title="Delete"><i class="icon-trash-2"></i></a>
                                        <a href="<?php echo e(route('admin.product.show', $product->id)); ?>" title="View"><i class="icon-eye"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="text-center py-5">
                                    <div class="body-text text-muted mb-3">No products found in this category</div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php echo $__env->make('admin.components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.main", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views\admin\categories\show.blade.php ENDPATH**/ ?>