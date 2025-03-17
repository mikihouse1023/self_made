<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderCode => $orderItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $totalAmount = $orderItems->sum(fn($item) => $item->price * $item->quantity);

        // ✅ `$appliedCoupons` が定義されているか確認
        $appliedCouponForOrder = isset($appliedCoupons) && $appliedCoupons->isNotEmpty() ? $appliedCoupons->first() : null;
        
        // ✅ クーポンが適用されている場合のみ割引を適用
        $discountedTotal = $appliedCouponForOrder ? max(0, $totalAmount - $appliedCouponForOrder->discount_value) : $totalAmount;
    ?>

    <h3>注文コード: <?php echo e($orderCode); ?></h3>
    <table class="table">
        <thead>
            <tr>
                <th>商品名</th>
                <th>値段</th>
                <th>数量</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->name); ?></td>
                    <td><?php echo e(number_format($item->price)); ?>円</td>
                    <td><?php echo e($item->quantity); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    
    <h4>合計金額（クーポン適用前）: <strong><?php echo e(number_format($totalAmount)); ?> 円</strong></h4>
    <h4>クーポン適用後の合計金額: <strong><?php echo e(number_format($discountedTotal)); ?> 円</strong></h4>

    <button onclick="location.href='<?php echo e(route('order.qr', ['orderCode' => $orderCode])); ?>'" class="QR-button">
        QRコードを発行
    </button>

    <form action="<?php echo e(route('order.delete', ['orderCode' => $orderCode])); ?>" method="POST" style="display:inline;">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="delete-button" onclick="return confirm('この注文を削除しますか？');">
            注文を削除
        </button>
    </form>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /var/www/html/resources/views/components/order.blade.php ENDPATH**/ ?>