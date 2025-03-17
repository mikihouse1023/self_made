

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>ミニゲーム</h1>

        
        <p>セッションデータ: game_count = <?php echo e(session('game_count')); ?>, game_code = <?php echo e(session('game_code')); ?></p>

        <?php if(session('game_count') && session('game_count') > 0): ?>
            <p>あなたは <strong><?php echo e(session('game_count')); ?></strong> 回のミニゲームをプレイできます！</p>

            <form method="POST" action="<?php echo e(route('minigame.play')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="game_code">4桁の番号を入力してください:</label>
                    <input type="text" name="game_code" id="game_code" class="form-control" required maxlength="4" pattern="\d{4}" placeholder="例: 1234">
                </div>
                <button type="submit" class="btn btn-primary mt-2">ゲームをプレイする</button>
            </form>
        <?php else: ?>
            <p>ミニゲームの回数がありません。</p>
            <a href="<?php echo e(route('order.view')); ?>" class="btn btn-secondary">注文履歴に戻る</a>
        <?php endif; ?>

        <?php if(session('game_result')): ?>
            <div class="alert alert-warning mt-3">
                <h3><?php echo e(session('game_result')); ?></h3>
                <p>🎯 獲得スタンプ: <strong><?php echo e(session('stamps_earned')); ?></strong> 個</p>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger mt-3">
                <h3><?php echo e(session('error')); ?></h3>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/minigame.blade.php ENDPATH**/ ?>