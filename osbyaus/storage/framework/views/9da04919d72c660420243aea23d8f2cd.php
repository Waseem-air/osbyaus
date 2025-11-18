<div class="row gy-4" id="products-grid">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-4 col-md-6">
            <div class="ec-product-content p-0 mb-4">
                <div class="ec-product-inner hot-sale-card">
                    <div class="ec-pro-image-outer">
                        <div class="ec-pro-image hot-sale-img">
                            <a href="<?php echo e(route('product.detail', $product->slug)); ?>" class="image sale-img">
                                <?php if($product->images->count() > 0): ?>
                                    <img class="main-image" src="<?php echo e(asset($product->images->first()->image_path)); ?>"
                                         alt="<?php echo e($product->name); ?>" loading="lazy"/>
                                <?php else: ?>
                                    <img class="main-image" src="<?php echo e(asset('website/assets/images/product/default-product.jpg')); ?>"
                                         alt="<?php echo e($product->name); ?>" loading="lazy"/>
                                <?php endif; ?>
                            </a>
                            <div class="ec-pro-actions">
                                <?php if($product->categories->count() > 0): ?>
                                    <span class="badge bg-white"><?php echo e($product->categories->first()->name); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if($product->discount_price && $product->discount_price < $product->price): ?>
                                <div class="ec-pro-actions-sale">
                                    <?php
                                        $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                    ?>
                                    <span class="badge bg-white"><?php echo e($discountPercent); ?>% OFF</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="ec-pro-content text-center">
                        <a href="<?php echo e(route('product.detail', $product->slug)); ?>">
                            <h6 class="ec-pro-stitle"><?php echo e($product->name); ?></h6>
                        </a>
                        <p class="ec-pro-subtitle">
                            <?php echo e($product->embellishment ? $product->embellishment . ' | ' : ''); ?>

                            <?php echo e($product->fabric ? $product->fabric . ' | ' : ''); ?>

                            <?php echo e($product->cut ? $product->cut . ' Cut' : ''); ?>

                        </p>
                        <div class="ec-pro-rat-price align-items-center">
                        <span class="ec-price">
                            <?php if($product->discount_price && $product->discount_price < $product->price): ?>
                                <span class="old-price"><?php echo e(App\Helpers\AppHelper::currency_symbol()); ?><?php echo e(number_format($product->price, 2)); ?></span>
                                <span class="new-price"><?php echo e(App\Helpers\AppHelper::currency_symbol()); ?><?php echo e(number_format($product->discount_price, 2)); ?></span>
                            <?php else: ?>
                                <span class="new-price"><?php echo e(App\Helpers\AppHelper::currency_symbol()); ?><?php echo e(number_format($product->price, 2)); ?></span>
                            <?php endif; ?>
                        </span>
                        </div>
                        <div class="ec-pro-size-wrapper">
                            <?php $__currentLoopData = $product->sizes->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check ec-pro-size-btn <?php echo e($size->is_active ? '' : 'empty'); ?>">
                                    <input class="form-check-input"
                                           type="checkbox"
                                           id="prod_size_<?php echo e($product->id); ?>_<?php echo e($size->id); ?>"
                                        <?php echo e(!$size->is_active ? 'disabled' : ''); ?>>
                                    <label class="form-check-label" for="prod_size_<?php echo e($product->id); ?>_<?php echo e($size->id); ?>">
                                        <?php echo e($size->short_code ?? $size->name); ?>

                                    </label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- Load More Section -->
<div id="load-more-section" class="text-center mt-5">
    <div id="load-more-loader" class="text-center py-4" style="display: none;">
        <div class="spinner-border text-dark" role="status">
            <span class="visually-hidden">Loading more...</span>
        </div>
        <p class="mt-2">Loading more...</p>
    </div>

    <button id="load-more-btn" class="btn btn-outline-dark btn-lg px-5" style="display: none;">
        <i class="fi-rr-refresh"></i> Load More
        <span id="loaded-count" class="badge bg-dark ms-2"></span>
    </button>

    <div id="end-of-products" class="text-center py-4" style="display: none;">
        <div class="alert alert-light border">
            <i class="fi-rr-check-circle text-success me-2"></i>
            <strong>All products loaded!</strong>
            <p class="mb-0 mt-1 text-muted">You've viewed all <?php echo e($products->total()); ?> products</p>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views\website\partials\products-grid.blade.php ENDPATH**/ ?>