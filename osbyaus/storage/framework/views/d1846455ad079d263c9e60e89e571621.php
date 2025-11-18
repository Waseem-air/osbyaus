<!-- Javascript -->
<script src="<?php echo e(asset('admin/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/zoom.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/switcher.js')); ?>"></script>
<script defer src="<?php echo e(asset('admin/js/theme-settings.js')); ?>"></script>
<script defer src="<?php echo e(asset('admin/js/main.js')); ?>"></script>

<script defer src="<?php echo e(asset('js/sweet-alert-helper.js')); ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Page-specific scripts -->
<?php echo $__env->yieldPushContent('scripts'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-category').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault(); // default link action roko
                let url = this.getAttribute('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#94010E',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url; // delete route call karo
                    }
                });
            });
        });
    });
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views/admin/components/scripts.blade.php ENDPATH**/ ?>