<?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="admin-container">


    <div class="category">
        <div class="category_name">
            <p>id</p>
        </div>
        <div class="category_content">
            <p><?php echo e($news->id); ?></p>
        </div>

    </div>


    <div class="category">
        <div class="category_name">
            <p>日付</p>
        </div>
        <div class="category_content">
            <p><?php echo e($news->date); ?></p>

        </div>
    </div>


    <div class="category">
        <div class="category_name">
            <p>カテゴリー</p>
        </div>
        <div class="category_content">
            <a><?php echo e($news->category); ?></a>

        </div>
    </div>

    <div class="category">
        <div class="category_name">
            <p>タイトル</p>
        </div>
        <div class="category_content">
            <a><?php echo e($news->title); ?></a>

        </div>
    </div>
    <div class="category" style="overflow: hidden;">
        <div class="category_name">

            <p>詳細説明</p>
        </div>
        <div class="category_content">
            <a><?php echo e($news->description); ?></a>
        </div>
    </div>

 
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/html/resources/views/components/news-admin.blade.php ENDPATH**/ ?>