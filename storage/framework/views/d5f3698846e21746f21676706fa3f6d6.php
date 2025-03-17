
<?php $__env->startSection('content'); ?>
<div class="w-layout-blockcontainer container-36 w-container">
    <h1>■新規ニュース登録</h1>
</div>

<form action="<?php echo e(route('admin.news.add')); ?>" method="post" novalidate>
    <?php echo csrf_field(); ?>
    <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error">※<?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <label>日付</label>
    <input type="date" class="w-input" maxlength="256" name="date" value="<?php echo e(old('date')); ?>">
    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error">※<?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <label>カテゴリ</label>
    <input class="w-input" maxlength="256" name="category" value="<?php echo e(old('category')); ?>">
    <?php $__errorArgs = ['is_new'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error">※<?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <label>ニュース種別</label>
    <select id="field" name="is_new" class="w-select">
        <!--<option value="0">non_new</option>
        <option value="1">new</option>-->
        <option value="0" <?php echo e(old('is_new') == '0' ? 'selected' : ''); ?>>non_new</option>
        <option value="1" <?php echo e(old('is_new') == '1' ? 'selected' : ''); ?>>new</option>
    </select>

    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error">※<?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <label>タイトル</label>
    <input class="w-input" maxlength="256" name="title" value="<?php echo e(old('title')); ?>">

    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <div class="error">※<?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <label>詳細</label>
    <input type="textarea" class="w-input" maxlength="256" name="description" value="<?php echo e(old('description')); ?>">

    <input type="hidden" name="tab" value="user">
    <div class="div-block-11">
        <a href="<?php echo e(route('admin.index', ['tab' => request('tab', 'news')])); ?>" class="button-17 w-button">戻る</a>
        <input type="submit" class="submit-button-6 w-button" value="登録">
    </div>
</form>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin_news_add.blade.php ENDPATH**/ ?>