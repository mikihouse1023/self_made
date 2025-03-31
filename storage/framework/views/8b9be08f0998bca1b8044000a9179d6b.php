<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['products']));

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

foreach (array_filter((['products']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    // カテゴリごとに分類
    $grouped = $products->groupBy('category');
?>

<?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="category-block">
        <div class="one-button-container">
            <h2>
                <?php switch($category):
                    case ('set_meal'): ?> 定食 <?php break; ?>
                    <?php case ('dish'): ?> 丼・麺 <?php break; ?>
                    <?php case ('side_menu'): ?> サイドメニュー <?php break; ?>
                    <?php default: ?> その他
                <?php endswitch; ?>
            </h2>
        </div>

        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="admin-container">

                <div class="category">
                    <div class="category_name"><p>ID</p></div>
                    <div class="category_content"><a><?php echo e($item->id); ?></a></div>
                </div>

                <div class="category">
                    <div class="category_name"><p>商品名</p></div>
                    <div class="category_content"><a><?php echo e($item->name); ?></a></div>
                </div>

                <div class="category">
                    <div class="category_name"><p>値段</p></div>
                    <div class="category_content"><a>¥<?php echo e($item->val); ?></a></div>
                </div>

                <div class="category">
                    <div class="category_name"><p>商品説明</p></div>
                    <div class="category_content"><a style="font-size:15px;"><?php echo e($item->explanation); ?></a></div>
                </div>

                <div class="category">
                    <div class="category_name"><p>写真</p></div>
                    <div class="category_content">
                        <img class="admin_picture" src="<?php echo e(asset('storage/' . $item->picture)); ?>" alt="<?php echo e($item->name); ?>">
                    </div>
                </div>



                <div class="category">
                    <div class="ed-container">
                        <button type="button" class="edit-button"
                            onclick="location.href='<?php echo e(route('admin.product.edit', $item->id)); ?>'">編集</button>

                        <form class="ed-form" action="<?php echo e(route('admin.product.delete', $item->id)); ?>" method="POST"
                            onsubmit="return confirm('本当に削除しますか？');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="delete-button">削除</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<div class="pagination">
    <?php echo e($products->appends(request()->query())->links()); ?>

</div>
<?php /**PATH /var/www/html/resources/views/components/product-list-admin.blade.php ENDPATH**/ ?>