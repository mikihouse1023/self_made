<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['orders']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['orders']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderCode => $orderItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
// ✅ クーポン適用前の合計金額
$totalAmount = $orderItems->sum(fn($item) => $item->price * $item->quantity);

// ✅ orders テーブルの discounted_total を取得
$discountedTotal = $orderItems->first()->discounted_total ?? $totalAmount;

$isReserved = $orderItems->contains(fn($item) => $item->is_reserved); // ←1件でも true ならOK
$reservedAt = $orderItems->firstWhere('is_reserved', true)?->reserved_at;
?>

<div class="order-container <?php if($isReserved): ?> reserved <?php endif; ?>">
    <h3>注文コード: <?php echo e($orderCode); ?></h3>
    <table class="table">
        <thead>
            <tr>
                <th class="order-name">商品名</th>
                <th class="order-price">値段</th>
                <th class="order-quantity">数量</th>
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

    <h2>合計金額（クーポン適用前）: <strong><?php echo e(number_format($totalAmount)); ?> 円</strong></h2>
    <h2>クーポン適用後の合計金額: <strong><?php echo e(number_format($discountedTotal)); ?> 円</strong></h2>
    <?php if($isReserved && $reservedAt): ?>
    <p class="reserved-label">
        予約済み （<?php echo e(\Carbon\Carbon::parse($reservedAt)->format('Y年n月j日 H:i')); ?>）
    </p>
<?php endif; ?>

    <div class="order-button-container">
        <button onclick="location.href='<?php echo e(route('order.qr', ['orderCode' => $orderCode])); ?>'" class="QR-button">
            QRコードを発行
        </button>


        <?php if(!$isReserved): ?>

        <button onclick="location.href='<?php echo e(route('order.reservation', ['orderCode' => $orderCode])); ?>'" class="reservation-button">予約する</button>
        <?php else: ?>

        <form action="<?php echo e(route('order.cancel', ['orderCode' => $orderCode])); ?>" method="POST" class="reservation-form">
            <?php echo csrf_field(); ?>
            <button type="submit" class="reservation-delete-button" onclick="return confirm('予約を解除しますか？');" >予約解除</button>
        </form>
        <?php endif; ?>
    </div>

    <form action="<?php echo e(route('order.delete', ['orderCode' => $orderCode])); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit" class="order-delete-button" onclick="return confirm('この注文を削除しますか？');">
            注文を削除
        </button>
    </form>
</div>
<?php if(session('error')): ?>
    <div class="error">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/html/resources/views/components/order.blade.php ENDPATH**/ ?>