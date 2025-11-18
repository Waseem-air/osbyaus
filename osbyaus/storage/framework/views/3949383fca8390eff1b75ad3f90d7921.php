<?php $__env->startSection('title', 'Register'); ?>
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
                    <li class="ec-breadcrumb-item active">Register</li>
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
                                    <h2>Create Your Account</h2>
                                    <p class="text-muted">Join TechCart for a better shopping experience.</p>
                                </div>

                                <!-- REGISTER FORM -->
                                <form method="POST" action="<?php echo e(route('register')); ?>" class="auth-form">
                                    <?php echo csrf_field(); ?>

                                    <div class="auth-form-content">

                                        <!-- Name -->
                                        <div class="col-12 mb-3">
                                            <label>Name</label>
                                            <input type="text"
                                                class="form-control auth-input <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                name="name"
                                                value="<?php echo e(old('name')); ?>"
                                                placeholder="Your name"
                                                required autocomplete="name">

                                            <?php $__errorArgs = ['name'];
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

                                        <!-- Email -->
                                        <div class="col-12 mb-3">
                                            <label>Email</label>
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
                                                placeholder="Email address"
                                                required autocomplete="username">

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

                                        <!-- Password -->
                                        <div class="col-12 mb-3">
                                            <label>Password</label>
                                            <div class="position-relative">
                                                <input type="password"
                                                    class="form-control auth-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="password"
                                                    placeholder="Enter password"
                                                    id="password"
                                                    required autocomplete="new-password">

                                                <span class="password-show" onclick="togglePassword('password', this)">
                                                    <i class="fi-rr-eye"></i>
                                                </span>

                                                <?php $__errorArgs = ['password'];
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
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-12 mb-3">
                                            <label>Confirm Password</label>
                                            <div class="position-relative">
                                                <input type="password"
                                                    class="form-control auth-input <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                    name="password_confirmation"
                                                    placeholder="Re-enter password"
                                                    id="password_confirmation"
                                                    required autocomplete="new-password">

                                                <span class="password-show" onclick="togglePassword('password_confirmation', this)">
                                                    <i class="fi-rr-eye"></i>
                                                </span>

                                                <?php $__errorArgs = ['password_confirmation'];
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
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark w-100">Register</button>
                                        </div>

                                        <div class="divider"></div>

                                        <p class="auth-bottom">
                                            Already have an account?
                                            <a href="<?php echo e(route('login')); ?>">Sign In</a>
                                        </p>

                                    </div>
                                </form>
                                <!-- END REGISTER FORM -->

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

<?php echo $__env->make('website.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views\auth\register.blade.php ENDPATH**/ ?>