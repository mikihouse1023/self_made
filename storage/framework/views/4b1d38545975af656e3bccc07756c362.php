<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['items', 'category']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['items', 'category']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?> 

<?php $__env->startSection('content'); ?>

<div class="register-container">
    <h1>■商品編集
    </h1>
    <div class="w-form">
    <form action="<?php echo e(route('admin.food.update', ['id' => $item->id, 'category' => $category])); ?>" method="POST" enctype="multipart/form-data">

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <label>カテゴリ</label>
            <select class="w-input" name="category" required>
                <option value="set_meals" <?php echo e($category === 'set_meals' ? 'selected' : ''); ?>>定食</option>
                <option value="dishes" <?php echo e($category === 'dishes' ? 'selected' : ''); ?>>丼/麺</option>
                <option value="side_menus" <?php echo e($category === 'side_menus' ? 'selected' : ''); ?>>サイドメニュー</option>
            </select>

            <label>商品名</label>
            <input class="w-input" name="name" value="<?php echo e(old('name', $item->name)); ?>" required>

            <label>値段</label>
            <input class="w-input" name="val" type="number" value="<?php echo e(old('val', $item->val)); ?>" required>

            <label>説明</label>
            <textarea name="explanation" class="w-input" required><?php echo e(old('explanation', $item->explanation)); ?></textarea>

            <label>ジャンル</label>
            <input class="w-input" name="genre" value="<?php echo e(old('genre', $item->genre)); ?>" required>

            <label>商品画像</label>
            <input type="file" id="pictureInput" name="picture" class="w-input" accept="image/*">

            <div id="imagePreviewContainer" style="margin-top: 15px;">
                <img id="imagePreview" src="<?php echo e(asset('storage/' . $item->picture)); ?>" alt="プレビュー画像" style="max-width: 300px; display: block;">
            </div>


       
        <div class="button-container">
            <button type="button" onclick="location.href='<?php echo e(route('admin.index')); ?>'" class="back-button">戻る</button>

            <input type="submit" class="submit-button" value="更新">
            </form>
        </div>
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
<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/food_edit.blade.php ENDPATH**/ ?>