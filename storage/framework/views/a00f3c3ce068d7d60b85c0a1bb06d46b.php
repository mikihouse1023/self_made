<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['products', 'category']));

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

foreach (array_filter((['products', 'category']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<div class="products-wrapper">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="product-container">
        <div class="product">
            <p class="product-title"><?php echo e($product->name); ?></p>
            <p class="product-image-container"><img src="<?php echo e(asset('storage/' . $product->picture)); ?>" alt="<?php echo e($product->name); ?>" class="image"></p>
            <p class="product-price"><?php echo e($product->val); ?>円</p>
            <p class="product-explanation"><?php echo e($product->explanation); ?></p>
            
            <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="product-button-container" style="height:15%;">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                <input type="hidden" name="category" value="<?php echo e($category); ?>"> <!-- カテゴリを追加 -->
                <input type="hidden" name="name" value="<?php echo e($product->name); ?>">
                <input type="hidden" name="price" value="<?php echo e($product->val); ?>">
                <input type="hidden" name="image" value="<?php echo e(asset('storage/' . $product->picture)); ?>">
               
                <button type="submit"  class="order-button">注文する</button>
             
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /var/www/html/resources/views/components/product.blade.php ENDPATH**/ ?>