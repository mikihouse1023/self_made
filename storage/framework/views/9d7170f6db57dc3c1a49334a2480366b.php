<?php $__env->startSection('content'); ?>
    <div class="order-container">
        <h1>注文履歴</h1>

        <?php if (isset($component)) { $__componentOriginal9766f9a7a3677102104a24a84499faae = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9766f9a7a3677102104a24a84499faae = $attributes; } ?>
<?php $component = App\View\Components\Order::resolve(['orders' => $orders] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Order::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9766f9a7a3677102104a24a84499faae)): ?>
<?php $attributes = $__attributesOriginal9766f9a7a3677102104a24a84499faae; ?>
<?php unset($__attributesOriginal9766f9a7a3677102104a24a84499faae); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9766f9a7a3677102104a24a84499faae)): ?>
<?php $component = $__componentOriginal9766f9a7a3677102104a24a84499faae; ?>
<?php unset($__componentOriginal9766f9a7a3677102104a24a84499faae); ?>
<?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/orderlist.blade.php ENDPATH**/ ?>