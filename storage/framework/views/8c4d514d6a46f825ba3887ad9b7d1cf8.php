<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['item', 'delete' => false]));

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

foreach (array_filter((['item', 'delete' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="cart-item">
    <div class="cart-details">
        <!-- 商品画像 -->

        <img src="<?php echo e($item->image); ?>" alt="<?php echo e($item->name); ?>" style="object-fit: cover;" class="cart-image">


        <!-- 商品情報 -->

        <p class="cart-name"><?php echo e($item->name); ?></p>
        <p class="cart-price"><?php echo e($item->price); ?>円（税込）</p>
    </div>

    <!-- 削除ボタン -->

    <?php if($delete): ?>
    <div class="cart-button-container">
        <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST" class="cart-remove">
            <?php echo csrf_field(); ?>
            <button type="submit" class="cart-delete-button">削除</button>
        </form>
    </div>
    <?php endif; ?>

</div><?php /**PATH /var/www/html/resources/views/components/cart-item.blade.php ENDPATH**/ ?>