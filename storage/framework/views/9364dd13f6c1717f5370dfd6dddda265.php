<?php $__env->startSection('content'); ?>
<body class="login-body">
<div class="register-container" style=height:500px;>
    <h1>会員登録が完了しました
    </h1>
    <div class="r-form">
        <p>ご利用いただきありがとうございます<br>
            今後ともご愛顧賜りますようよろしくお願い申し上げます。<br>
            どうぞよろしくお願いいたします。
        </p>


    </div>
    <div class="button-container" style="margin-top:20px;">
        <input type='button' class="back-button" onclick="location.href='<?php echo e(route('login')); ?>'" value="ログイン画面に戻る">
    </div>
</div>
</body>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/registration_complete.blade.php ENDPATH**/ ?>