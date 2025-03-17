<!--コンポーネントを作成しない場合必要
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['news']));

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

foreach (array_filter((['news']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>-->

<div class="News">
    <div class="News-title">
    <a style=font-size:40px;>ニュース/News</a>
    </div>
    <div class="newsList">
        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="news-item">
            <div class="date" style="background-color:#FFCC33;">
                <p><?php echo e($item->date); ?></p>
            </div>

            <div class="news-category" style=background-color:green;>
                <p><?php echo e($item->category); ?></p>
            </div>
            <?php if($item->is_new): ?>
            <div class="is_new" style=background-color:red;>
                <p>NEW</p>
            </div>
            <?php endif; ?>
        </div>
        <div class="text">
            <div class="title">
                <a><?php echo e($item->title); ?></a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH /var/www/html/resources/views/components/news.blade.php ENDPATH**/ ?>