

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>登録完了</h1>
        <p>注文が正常に登録されました。</p>

        <?php if(isset($gameCount) && $gameCount > 0): ?>
            <div class="alert alert-success">
                <h3>🎮 ミニゲームの挑戦回数: <?php echo e($gameCount); ?> 回 🎮</h3>
                <p>4桁の番号: <strong><?php echo e($gameCode); ?></strong></p>
                <p>この番号を入力してミニゲームをプレイできます！</p>
                <a href="<?php echo e(route('minigame')); ?>" class="btn btn-primary">ミニゲームをプレイする</a>
            </div>
        <?php else: ?>
            <p>ミニゲームの回数はありません。</p>
        <?php endif; ?>

        <a href="<?php echo e(route('order.view')); ?>" class="btn btn-secondary">注文履歴に戻る</a>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/complete.blade.php ENDPATH**/ ?>