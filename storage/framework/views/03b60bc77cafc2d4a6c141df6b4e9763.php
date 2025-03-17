

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>スタンプ・クーポン</h1>
    <p>現在のスタンプ数: <strong><?php echo e($stamps); ?></strong></p>

    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    
    <?php if($stamps >= 5 && ($stamps % 5 == 0 || !in_array(floor($stamps / 5) * 5, $redeemedStamps))): ?>
    <form action="<?php echo e(route('stamps.redeem')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-primary">クーポンを取得</button>
    </form>
    <?php else: ?>
    <p>現在のスタンプ数ではクーポンを取得できません。</p>
    <?php endif; ?>
    
    <h2 class="mt-4">使用可能なクーポン</h2>
    <?php if($coupons->isEmpty()): ?>
    <p>現在、使用可能なクーポンはありません。</p>
    <?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>クーポンコード</th>
                <th>割引額</th>
                <th>有効期限</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($coupon->code); ?></td>
                <td><?php echo e($coupon->discount_value); ?>円</td>
                <td><?php echo e(\Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php endif; ?>


    <a href="<?php echo e(route('index')); ?>" class="btn btn-secondary mt-3">ホームに戻る</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/stamp.blade.php ENDPATH**/ ?>