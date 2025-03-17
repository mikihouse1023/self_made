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