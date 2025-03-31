<div>
    <table class="table">
        <thead>
            <tr>
                <th>注文コード</th>
                <th>ユーザーID</th>
                <th>予約時間</th>
                <th>人数</th>
                <th>予約内容</th>
                <th>合計金額</th>
                <th>予約キャンセル</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($reservation->order_code); ?></td>
                    <td><?php echo e($reservation->user_id); ?></td>
                    <td><?php echo e($reservation->reserved_at); ?></td>
                    <td><?php echo e($reservation->guest_count); ?></td>
                    <td><?php echo e($reservation->product_names); ?></td>
                    <td><?php echo e(number_format($reservation->total_amount)); ?>円</td>
                    <td>
                        <form action="<?php echo e(route('order.cancel', ['orderCode' => $reservation->order_code])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger">キャンセル</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH /var/www/html/resources/views/components/reservation-list-admin.blade.php ENDPATH**/ ?>