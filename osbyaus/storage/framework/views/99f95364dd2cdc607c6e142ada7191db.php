<?php $__env->startSection('title', 'Email Verification'); ?>
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
                    <li class="ec-breadcrumb-item active">Verify Email</li>
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

                        <!-- Left Banner -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="img-wrapper">
                                <img src="<?php echo e(asset('website/assets/images/auth-image/01.png')); ?>"
                                     class="auth-img" alt="">
                            </div>
                        </div>

                        <!-- Right Content -->
                        <div class="col-lg-6">
                            <div class="ec-auth-content">

                                <div class="auth-head text-center">
                                    <div class="mb-4">
                                        <img src="<?php echo e(asset('website/assets/images/logo/logo.svg')); ?>" alt="Logo">
                                    </div>
                                    <h2>Verify Your Email</h2>
                                    <p class="text-muted">
                                        Thanks for signing up! Before getting started, please verify your email address
                                        by clicking the link we just sent you.
                                        <br>
                                        If you didn’t receive the email, you can request another one.
                                    </p>
                                </div>

                                <!-- Status Message -->
                                <?php if(session('status') == 'verification-link-sent'): ?>
                                    <div class="alert alert-success mb-3 text-center">
                                        A new verification link has been sent to your email.
                                    </div>
                                <?php endif; ?>

                                <div class="auth-form-content">

                                    <!-- RESEND VERIFICATION -->
                                    <form method="POST" action="<?php echo e(route('verification.send')); ?>" class="mb-3">
                                        <?php echo csrf_field(); ?>

                                        <button class="btn btn-dark w-100">
                                            Resend Verification Email
                                        </button>
                                    </form>

                                    <!-- LOG OUT -->
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-light w-100">
                                            Log Out
                                        </button>
                                    </form>

                                </div>

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

<?php echo $__env->make('website.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views\auth\verify-email.blade.php ENDPATH**/ ?>