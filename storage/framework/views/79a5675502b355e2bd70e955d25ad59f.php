<?php $__env->startSection('content'); ?>
<body class="login-body">
<div class="register-container" style=gap:20px;>
    <h1>登録情報確認</h1>
    <div class="l-form">

        <form action="<?php echo e(route('registration.complete')); ?>" method="post" style=gap:20px;>
            <?php echo csrf_field(); ?>
            <label>ユーザー名</label>
            <div class="text-block"><?php echo e($data['name']); ?></div>


            <label>メールアドレス</label>
            <div class="text-block"><?php echo e($data['email']); ?></div>

            <label>電話番号</label>
            <div class="text-block"><?php echo e($data['tel']); ?></div>

            <label>郵便番号</label>
            <div class="text-block"><?php echo e($data['post']); ?></div>

            <label>住所</label>
            <div class="text-block"><?php echo e($data['address']); ?></div>

            <label>パスワード</label>
            <div class="text-block">********</div>


            <div class="button-container">
                <input type="button" class="back-button" onclick="location.href='<?php echo e(route('registration')); ?>'" value="戻る">
                <input type="submit" class="submit-button" value="登録する">
            </div>
        </form>


    </div>

</div>
</body>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/registration_confirm.blade.php ENDPATH**/ ?>