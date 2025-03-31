
<?php $__env->startSection('content'); ?>  
<body class="login-body">
<div class="register-container">
    <h1>■ユーザー編集</h1>
    <div class="w-form">
    <?php if($errors->any()): ?>
        <div>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>
        <form action="<?php echo e(route('admin.user.update', $user->id)); ?>" method="POST" novalidate>
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
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
            <input class="w-input" maxlength="256" name="name" value="<?php echo e(old('name', $user->name)); ?>">
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
            <input class="w-input" maxlength="256" name="email" value="<?php echo e(old('email', $user->email)); ?>">
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
            <input class="w-input" maxlength="256" name="tel" value="<?php echo e(old('tel', $user->tel)); ?>">
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
            <input class="w-input" maxlength="256" name="post" value="<?php echo e(old('post', $user->post)); ?>">
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
            <input class="w-input" maxlength="256" name="address" value="<?php echo e(old('address', $user->address)); ?>">
            
            <?php $__errorArgs = ['user_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label>ユーザー種別</label>
            <select id="field" name="user_type" class="w-select">
            <option value="0" <?php echo e(old('user_type', $user->is_admin) == 0 ? 'selected' : ''); ?>>一般</option>
            <option value="1" <?php echo e(old('user_type', $user->is_admin) == 1 ? 'selected' : ''); ?>>管理者</option>
            </select>
            <input type="hidden" name="tab" value="user">
            <div class="button-container">
            <button type="button" onclick="location.href='<?php echo e(route('admin.index', ['tab' => request('tab', 'user')])); ?>'" class="back-button">戻る</button>
            <input type="submit" class="submit-button" value="更新">
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin_user_edit.blade.php ENDPATH**/ ?>