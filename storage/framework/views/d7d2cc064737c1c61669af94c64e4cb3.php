

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>QRコードをスキャンしました</h1>
    <p>注文コード: <?php echo e($orderCode); ?></p>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('order.scan', ['orderCode' => $orderCode])); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <button type="submit" class="btn btn-primary">読み込み完了</button>
</form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/access.blade.php ENDPATH**/ ?>