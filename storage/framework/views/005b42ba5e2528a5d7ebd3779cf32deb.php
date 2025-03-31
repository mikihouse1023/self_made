<?php $__env->startSection('content'); ?>

<div class="register-container">
    <h1>新規会員登録</h1>

    <div class="l-form">
        <form action="<?php echo e(route('registration.process')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label>ユーザー名</label>
            <input class="l-input" maxlenght="256" name="name" value="<?php echo e(old('name')); ?>">

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
            <label>メールアドレス</label>
            <input class="l-input" maxlength="256" name="email" value="<?php echo e(old('email')); ?>">
           
            <?php $__errorArgs = ['tel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label>電話番号</label>
            <input class="l-input" maxlength="256" name="tel" value="<?php echo e(old('tel')); ?>">

            <?php $__errorArgs = ['post'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label>郵便番号</label>
            <input class="l-input" maxlength="256" name="post" value="<?php echo e(old('post')); ?>">

            <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label>住所</label>
            <input class="l-input" maxlength="256" name="address" value="<?php echo e(old('address')); ?>">

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
            <label>パスワード</label>
            <input class="l-input" maxlength="256" name="password" type="password">


            <label>パスワード確認</label>
            <input class="l-input" maxlength="256" name="password_confirmation" type="password">

            <div class="button-container" style="padding-bottom:20px;">
            <input type="button" class="back-button" onclick="location.href='<?php echo e(route('login')); ?>'" value="戻る">
            <input type="submit" class="submit-button" value="登録">
            </div>
        </form>
       
   
    </div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/registration.blade.php ENDPATH**/ ?>