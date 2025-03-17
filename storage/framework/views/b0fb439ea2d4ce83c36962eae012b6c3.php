<?php $__env->startSection('content'); ?>
<body class="login-body">
<div class="l-container">
    <img src="<?php echo e(asset('images/SetMealShop_Logo.png')); ?>" class="image2">

    <h1>■ログイン画面</h1>
    <div class="l-form">
        <form action="<?php echo e(route('login.process')); ?>" method="post" novalidate>
            <?php echo csrf_field(); ?>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            
                <label>
                    メールアドレス
                </label>
                <input class="l-input" maxlength="256" name="email">
         
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
         
                <label>
                    パスワード
                </label>
                <input class="l-input" maxlength="256" name="password">
        
            <div class="button-container">
                <input type="submit" class="login-button" value="ログイン">
            </div>
        </form>
    </div>


    <a href="<?php echo e(route('registration')); ?>" class="link">ユーザー登録はこちら</a>
</div>

</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/login.blade.php ENDPATH**/ ?>