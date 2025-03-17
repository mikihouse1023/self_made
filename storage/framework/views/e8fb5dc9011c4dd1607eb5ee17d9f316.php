<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>QRコード</h1>
    <p>注文コード: <?php echo e($orderCode); ?></p>
    <div class="qr-code">
        <?php echo $qrCode; ?>

    </div>

    <h2>QRコードの読み込みを待っています...</h2>
    <p>QRコードを読み込んだら、このページは自動的に更新されます。</p>
    <p>注文コード: <strong><?php echo e($orderCode); ?></strong></p>

    <script>
    function checkScanStatus() {
        fetch("<?php echo e(route('order.check', ['orderCode' => $orderCode])); ?>")
            .then(response => response.json())
            .then(data => {
                console.log("QRコードチェック:", data.scanned);
                if (data.scanned) {
                    console.log("QRコードスキャン完了！ complete.blade.php に遷移します");
                    window.location.href = "<?php echo e(route('order.complete', ['orderCode' => $orderCode])); ?>";
                } else {
                    setTimeout(checkScanStatus, 3000);
                }
            })
            .catch(error => console.error("エラー発生:", error));
    }

    checkScanStatus(); // ページが開かれたらすぐに実行
</script>

    <a href="<?php echo e(route('order.view')); ?>" class="btn btn-secondary">注文履歴に戻る</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/qr.blade.php ENDPATH**/ ?>