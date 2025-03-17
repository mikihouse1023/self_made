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
<div class="items-wrapper">
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="item-container">
        <div class="item">
            <p class="item-title"><?php echo e($item->name); ?></p>
            <p><img src="<?php echo e(asset('storage/' . $item->picture)); ?>" alt="<?php echo e($item->name); ?>" class="image-item" style="width:100%;"></p>
            <p class="item-price"><?php echo e($item->val); ?>円</p>
            <p class="item-explanation"><?php echo e($item->explanation); ?></p>
            <form action="<?php echo e(route('cart.add')); ?>" class="order-form" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
                <input type="hidden" name="category" value="<?php echo e($category); ?>"> <!-- カテゴリを追加 -->
                <input type="hidden" name="name" value="<?php echo e($item->name); ?>">
                <input type="hidden" name="price" value="<?php echo e($item->val); ?>">
                <input type="hidden" name="image" value="<?php echo e(asset('storage/' . $item->picture)); ?>">
                <button type="submit" class="order-button">注文する</button>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /var/www/html/resources/views/components/item.blade.php ENDPATH**/ ?>