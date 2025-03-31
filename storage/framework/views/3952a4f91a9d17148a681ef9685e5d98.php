<?php $__env->startSection('content'); ?>

<div class="register-container">
    <h1>■商品登録</h1>
    <div class="w-form">
        <form action="<?php echo e(route('admin.product.store')); ?>" method="POST" enctype="multipart/form-data" novalidate>
            <?php echo csrf_field(); ?>

            
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
            <select class="w-input" name="category" required>
                <option value="">選択してください</option>
                <option value="set_meal">定食</option>
                <option value="dish">丼/麺</option>
                <option value="side_menu">サイドメニュー</option>
            </select>

            
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
            <label>商品名</label>
            <input class="w-input" name="name" value="<?php echo e(old('name')); ?>" required>

            
            <?php $__errorArgs = ['val'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label>値段</label>
            <input class="w-input" name="val" type="number" value="<?php echo e(old('val')); ?>" required>

            
            <?php $__errorArgs = ['explanation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label>説明</label>
            <textarea name="explanation" class="w-input" required><?php echo e(old('explanation')); ?></textarea>

            
            <?php $__errorArgs = ['picture'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error">※<?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label>商品画像</label>
            <input type="file" id="pictureInput" name="picture" class="w-input" accept="image/*" required>

            <div id="imagePreviewContainer" style="margin-top: 15px;">
                <img id="imagePreview" src="" alt="プレビュー画像" style="max-width: 300px; display: none;">
            </div>

            <div class="button-container">
                <button type="button" onclick="location.href='<?php echo e(route('admin.index')); ?>'" class="back-button">戻る</button>
                <input type="submit" class="submit-button" value="登録">
            </div>
        </form>

        <script>
            document.getElementById('pictureInput').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagePreview');
                const reader = new FileReader();

                if (file) {
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = 'none';
                }
            });
        </script>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/create_product.blade.php ENDPATH**/ ?>