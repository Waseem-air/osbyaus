<?php $__env->startSection('title', 'Forgot Password'); ?>
<?php $__env->startSection('content'); ?>

<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="ec-breadcrumb-list text-left">
                    <li class="ec-breadcrumb-item">
                        <a href="<?php echo e(url('/')); ?>"><i class="fi-rr-home"></i></a>
                    </li>
                    <li class="ec-breadcrumb-item active">Forgot Password</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Ec breadcrumb end -->

<!-- Auth section Start -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-xxl-8 col-xl-10 col-md-12 mx-auto">
                <div class="auth-card cover">
                    <div class="row">

                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="img-wrapper">
                                <img src="<?php echo e(asset('website/assets/images/auth-image/01.png')); ?>" class="auth-img" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="ec-auth-content">

                                <div class="auth-head">
                                    <div class="mb-4">
                                        <img src="<?php echo e(asset('website/assets/images/logo/logo.svg')); ?>" alt="Logo">
                                    </div>
                                    <h2>Forgot Your Password?</h2>
                                    <p class="text-muted">
                                        No problem. Enter your email and we'll send you a password reset link.
                                    </p>
                                </div>

                                <!-- SESSION STATUS -->
                                <?php if(session('status')): ?>
                                    <div class="alert alert-success mb-3">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>

                                <!-- FORGOT PASSWORD FORM -->
                                <form method="POST" action="<?php echo e(route('password.email')); ?>" class="auth-form">
                                    <?php echo csrf_field(); ?>

                                    <div class="auth-form-content">

                                        <!-- Email -->
                                        <div class="col-12 mb-3">
                                            <label>Email Address</label>
                                            <input type="email"
                                                class="form-control auth-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                name="email"
                                                value="<?php echo e(old('email')); ?>"
                                                required autofocus
                                                placeholder="Enter your email">

                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark w-100">
                                                Email Password Reset Link
                                            </button>
                                        </div>

                                        <div class="divider"></div>

                                        <p class="auth-bottom text-center">
                                            Remember your password?
                                            <a href="<?php echo e(route('login')); ?>">Sign In</a>
                                        </p>

                                    </div>
                                </form>
                                <!-- END FORM -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Auth section End -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views\auth\forgot-password.blade.php ENDPATH**/ ?>