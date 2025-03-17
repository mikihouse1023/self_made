

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>QRコードの読み込みを待っています...</h1>
        <p>QRコードを読み込んだら、このページは自動的に更新されます。</p>
        <p>注文コード: <?php echo e($orderCode); ?></p>

        <script>
            function checkScanStatus() {
                fetch("<?php echo e(route('order.check', ['orderCode' => $orderCode])); ?>")
                    .then(response => response.json())
                    .then(data => {
                        if (data.scanned) {
                            window.location.href = "<?php echo e(route('order.complete', ['orderCode' => $orderCode])); ?>";
                        } else {
                            setTimeout(checkScanStatus, 3000);
                        }
                    });
            }

            checkScanStatus();
        </script>

        <a href="<?php echo e(route('order.view')); ?>" class="btn btn-secondary">注文履歴に戻る</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/wait.blade.php ENDPATH**/ ?>