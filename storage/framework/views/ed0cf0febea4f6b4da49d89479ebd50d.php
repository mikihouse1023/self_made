

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>予約設定</h1>
    <p>注文コード: <?php echo e($orderCode); ?></p>

    <form action="<?php echo e(route('order.reserve', ['orderCode' => $orderCode])); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <label for="reservation_datetime">予約日時:</label>
        <input type="text" id="reservation_datetime" name="reservation_datetime" required>

        <label for="guest_count">人数:</label>
        <input type="number" id="guest_count" name="guest_count" min="1" required>

        <button type="submit">予約を確定</button>
    </form>

    <a href="<?php echo e(route('order.view')); ?>" class="btn btn-secondary">戻る</a>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    flatpickr("#reservation_datetime", {
        locale: "ja", // ← 日本語に設定
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        inline: true,
        showMonths: 3
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/reservation.blade.php ENDPATH**/ ?>