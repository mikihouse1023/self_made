<?php $__env->startSection('content'); ?>
<body class="login-body">
<div class="register-container">
    <h1>■商品編集</h1>
    <div class="w-form">
        <form action="<?php echo e(route('admin.product.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <label>カテゴリ</label>
            <select class="w-input" name="category" required>
                <option value="set_meal" <?php echo e($product->category === 'set_meal' ? 'selected' : ''); ?>>定食</option>
                <option value="dish" <?php echo e($product->category === 'dish' ? 'selected' : ''); ?>>丼/麺</option>
                <option value="side_menu" <?php echo e($product->category === 'side_menu' ? 'selected' : ''); ?>>サイドメニュー</option>
            </select>

            
            <label>商品名</label>
            <input class="w-input" name="name" value="<?php echo e(old('name', $product->name)); ?>" required>

            
            <label>値段</label>
            <input class="w-input" name="val" type="number" value="<?php echo e(old('val', $product->val)); ?>" required>

            
            <label>説明</label>
            <textarea name="explanation" class="w-input" required><?php echo e(old('explanation', $product->explanation)); ?></textarea>

            
            <label>商品画像</label>
            <input type="file" id="pictureInput" name="picture" class="w-input" accept="image/*">
            <div id="imagePreviewContainer" style="margin-top: 15px;">
                <img id="imagePreview" src="<?php echo e(asset('storage/' . $product->picture)); ?>" alt="プレビュー画像" style="max-width: 300px;">
            </div>

            <div class="button-container">
                <button type="button" onclick="location.href='<?php echo e(route('admin.index')); ?>'" class="back-button">戻る</button>
                <input type="submit" class="submit-button" value="更新">
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
                }
            });
        </script>
    </div>
</div>
</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/edit_product.blade.php ENDPATH**/ ?>