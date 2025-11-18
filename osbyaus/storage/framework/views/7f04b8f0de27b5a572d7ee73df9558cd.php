<?php echo $__env->make("admin.components.head", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make("admin.components.header", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- #wrapper -->
<div id="wrapper">
    <!-- #page -->
    <div id="page" class="">
        <!-- layout-wrap -->
        <div class="layout-wrap loader-off">
            <!-- preload -->
            <div id="preload" class="preload-container">
                <div class="preloading">
                    <span></span>
                </div>
            </div>
            <!-- /preload -->
            <?php echo $__env->make("admin.components.sidebar", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <!-- section-content-right -->
            <div class="section-content-right">
                <?php echo $__env->make("admin.components.header", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- /section-content-right -->
        </div>
        <!-- /layout-wrap -->
    </div>
    <!-- /#page -->
</div>
<!-- /#wrapper -->
<?php echo $__env->make("admin.components.scripts", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views\admin\layout\main.blade.php ENDPATH**/ ?>