<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('meta_description', 'Discover the best global fashion trends. Shop stylish clothing for men & women with fast worldwide delivery.'); ?>
<?php $__env->startSection('meta_keywords', 'fashion store, clothing shop, global fashion, men fashion, women fashion, ecommerce clothing'); ?>
<?php $__env->startSection('content'); ?>

<!-- Main Slider Start -->
<div class="ec-main-slider section">
    <div class="position-relative">
        <img src="website/assets/images/banner/01.png" class="ec-slide-bg" alt="">
        <div class="container align-self-center">
            <div class="row">
                <div class="col-12">
                    <div class="ec-slide-content">
                        <h2 class="ec-slide-stitle">Flat Sale</h2>
                        <h1 class="ec-slide-title">50% OFF</h1>
                        <div class="ec-slide-scontent">
                            <h5>Ready To Wear</h5>
                            <p>
                                Explore our curated collection of trendy outfits and timeless classics. Your next
                                favorite look is just a click away!
                            </p>
                        </div>
                        <a href="products.html" class="btn btn-lg">
                            Shop Now
                            <i class="fi-rr-arrow-small-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->

<!-- Main Slider Start -->
<div class="ec-main-slider slider-2 mt-1 section">
    <div class="position-relative">
        <img src="website/assets/images/banner/02.png" class="ec-slide-bg" alt="">
        <div class="container align-self-center">
            <div class="row">
                <div class="col-12">
                    <div class="ec-slide-content">
                        <h2 class="ec-slide-stitle">Flat Sale</h2>
                        <h1 class="ec-slide-title">50% OFF</h1>
                        <div class="ec-slide-scontent">
                            <h5>Ready To Wear</h5>
                            <p>
                                Explore our curated collection of trendy outfits and timeless classics. Your next
                                favorite look is just a click away!
                            </p>
                        </div>
                        <a href="products.html" class="btn btn-lg">
                            Shop Now
                            <i class="fi-rr-arrow-small-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->


<!-- Popular Products Section Start -->
<section class="section ec-exe-spe-section section-space-ptb-100 section-space-mt section-space-mb-100">
    <div class="container">
        <div class="row">
            <!-- Popular Products Section Start -->
            <div class="ec-exe-section col-lg-12 col-md-12 col-sm-12">
                <div class="col-md-12 text-left">
                    <div class="section-title mb-6 d-flex justify-content-between">
                        <h2 class="ec-title">Popular This Week</h2>
                        <a href="<?php echo e(route('products.index')); ?>" class="ec-stitle">View All
                            <img src="website/assets/images/icon/arrow_right.svg" alt="">
                        </a>
                    </div>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                            <div class="ec-product-content p-0">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="<?php echo e(route('product.detail', $product->slug)); ?>" class="image sale-img">
                                                <?php if($product->images->count() > 0): ?>
                                                    <img class="main-image" src="<?php echo e(asset($product->images->first()->image_path)); ?>" alt="<?php echo e($product->name); ?>" />
                                                <?php else: ?>
                                                    <img class="main-image" src="website/assets/images/product/default-product.jpg" alt="<?php echo e($product->name); ?>" />
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
                                                <span class="old-price"><?php echo e(App\Helpers\AppHelper::currency_symbol()); ?>.<?php echo e(number_format($product->price, 2)); ?></span>
                                                <span class="new-price"><?php echo e(App\Helpers\AppHelper::currency_symbol()); ?>.<?php echo e(number_format($product->discount_price, 2)); ?></span>
                                            <?php else: ?>
                                                <span class="new-price"><?php echo e(App\Helpers\AppHelper::currency_symbol()); ?>.<?php echo e(number_format($product->price, 2)); ?></span>
                                            <?php endif; ?>
                                        </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check ec-pro-size-btn <?php echo e($size->is_active ? '' : 'empty'); ?>">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           id="size_<?php echo e($product->id); ?>_<?php echo e($size->id); ?>"
                                                        <?php echo e(!$size->is_active ? 'disabled' : ''); ?>>
                                                    <label class="form-check-label" for="size_<?php echo e($product->id); ?>_<?php echo e($size->id); ?>">
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
            </div>
            <!-- Popular Products Section End -->
        </div>
    </div>
</section>
<!-- Popular Products Section End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views\website\index.blade.php ENDPATH**/ ?>