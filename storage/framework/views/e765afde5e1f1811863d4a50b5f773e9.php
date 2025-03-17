<?php $__env->startSection('content'); ?>

    <div style="display:flex;">
        <h1 style="width:60%;margin:0 auto;">■注文内容</h1>
    </div>

    <!-- カートの中身を表示 -->
    <?php if($cartItems->isEmpty()): ?>
        <p>カートに商品がありません。</p>
    <?php else: ?>
        <ul role="list" class="w-list-unstyled">
            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-item">
                    <?php if (isset($component)) { $__componentOriginal96dfb5874ab96cc1f7fb206874c3e7f4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal96dfb5874ab96cc1f7fb206874c3e7f4 = $attributes; } ?>
<?php $component = App\View\Components\CartItem::resolve(['item' => $item,'delete' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cart-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CartItem::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal96dfb5874ab96cc1f7fb206874c3e7f4)): ?>
<?php $attributes = $__attributesOriginal96dfb5874ab96cc1f7fb206874c3e7f4; ?>
<?php unset($__attributesOriginal96dfb5874ab96cc1f7fb206874c3e7f4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal96dfb5874ab96cc1f7fb206874c3e7f4)): ?>
<?php $component = $__componentOriginal96dfb5874ab96cc1f7fb206874c3e7f4; ?>
<?php unset($__componentOriginal96dfb5874ab96cc1f7fb206874c3e7f4); ?>
<?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        
        <h3>使用可能なクーポン</h3>
        <form action="<?php echo e(route('cart.applyCoupon')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label for="coupon">クーポンを選択:</label>
            <select name="coupon_id" id="coupon" class="form-control">
                <option value="">クーポンを使用しない</option> 
                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($coupon->id); ?>"><?php echo e($coupon->code); ?> - 割引 <?php echo e($coupon->discount_value); ?>円</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="btn btn-primary mt-2">クーポンを適用</button>
        </form>

    <?php endif; ?>

    
    <div style="text-align:center; margin-top:20px;">
        <h2>合計金額: <span id="total-price">
            <?php echo e(number_format($discountedTotal ?? $totalPrice)); ?> 円
        </span></h2>
    </div>

    <div class="button-container" style="margin:0 auto;">
        <button class="back-button" onclick="location.href='<?php echo e(route('menu')); ?>'">戻る</button>   
        <form action="<?php echo e(route('cart.register')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="registration-button">登録</button>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/cart.blade.php ENDPATH**/ ?>