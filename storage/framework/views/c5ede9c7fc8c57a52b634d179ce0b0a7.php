<?php $__env->startSection('content'); ?>

<div class="carousel">
    <div class="slider">
        <div class="slides">
            <div class="slide"><img src="<?php echo e(asset('images/いろいろ定食.png')); ?>" alt="Slide 1"></div>
            <div class="slide"><img src="<?php echo e(asset('images/いろいろ定食2.png')); ?>" alt="Slide 1"></div>
            <div class="slide"><img src="<?php echo e(asset('images/いろいろ定食3.png')); ?>" alt="Slide 1"></div>
        </div>

        <div class="controls">
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>

        </div>
    </div>
</div>

<div class="ranking-container" style="padding: 20px;">

    
    <form method="GET" action="<?php echo e(route('index')); ?>" style="margin-bottom: 15px;">
        <label for="category">ジャンルを選択：</label>
        <select name="category" id="category" class="dropdown" onchange="this.form.submit()">
            <option value="">指定なし（全体）</option>
            <option value="set_meal" <?php echo e(request('category') == 'set_meal' ? 'selected' : ''); ?>>定食</option>
            <option value="dish" <?php echo e(request('category') == 'dish' ? 'selected' : ''); ?>>丼/麺</option>
            <option value="side_menu" <?php echo e(request('category') == 'side_menu' ? 'selected' : ''); ?>>サイドメニュー</option>
        </select>
    </form>

    <h1>
        🥇 売上ランキング TOP10 🥇
        <?php if($category == 'set_meal'): ?>
        （定食）
        <?php elseif($category == 'dish'): ?>
        （丼/麺）
        <?php elseif($category == 'side_menu'): ?>
        （サイドメニュー）
        <?php endif; ?>
    </h1>

    


    <table class="ranking-table">
        <thead>
            <tr>
                <th class="ranking-item" style="background-color:red;width:10%;">順位</th>
                <th class="ranking-item" style="background-color:orange;">商品名</th>
                

            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $ranking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="ranking"><?php echo e($index + 1); ?></td>
                <td><?php echo e($item->name); ?></td>
    

            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4">該当するデータがありません。</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php if (isset($component)) { $__componentOriginal3d452745d4a5eb38b6bef38907945e76 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d452745d4a5eb38b6bef38907945e76 = $attributes; } ?>
<?php $component = App\View\Components\News::resolve(['news' => $news] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('news'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\News::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d452745d4a5eb38b6bef38907945e76)): ?>
<?php $attributes = $__attributesOriginal3d452745d4a5eb38b6bef38907945e76; ?>
<?php unset($__attributesOriginal3d452745d4a5eb38b6bef38907945e76); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d452745d4a5eb38b6bef38907945e76)): ?>
<?php $component = $__componentOriginal3d452745d4a5eb38b6bef38907945e76; ?>
<?php unset($__componentOriginal3d452745d4a5eb38b6bef38907945e76); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/index.blade.php ENDPATH**/ ?>