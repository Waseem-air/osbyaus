<!DOCTYPE html>
<html lang="en">


<?php echo $__env->make('website.components.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<body>
<div id="ec-overlay">
    <div class="ec-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>


<?php echo $__env->make('website.components.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->yieldContent('content'); ?>



<?php echo $__env->make('website.components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<?php echo $__env->make('website.components.shopping-cart', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- Chat Btn Start -->
<a href="" class="chat-btn">
    <i class="ecicon eci-whatsapp"></i>
</a>
<!-- Chat Btn End -->


<?php echo $__env->make('website.components.script-links', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\2025_projects\osbyaus\osbyaus\resources\views\website\layouts\main.blade.php ENDPATH**/ ?>