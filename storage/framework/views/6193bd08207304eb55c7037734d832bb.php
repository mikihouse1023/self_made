<?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="admin-container">


    <div class="category">
        <div class="category_name">
            <p>id</p>
        </div>
        <div class="category_content">
            <p><?php echo e($item->id); ?></p>
        </div>

    </div>


    <div class="category">
        <div class="category_name">
            <p>日付</p>
        </div>
        <div class="category_content">
            <p><?php echo e($item->date); ?></p>

        </div>
    </div>


    <div class="category">
        <div class="category_name">
            <p>カテゴリー</p>
        </div>
        <div class="category_content">
            <a><?php echo e($item->category); ?></a>

        </div>
    </div>

    <div class="category">
        <div class="category_name">
            <p>タイトル</p>
        </div>
        <div class="category_content">
            <a><?php echo e($item->title); ?></a>

        </div>
    </div>
    <div class="category" style="overflow: hidden;">
        <div class="category_name">

            <p>詳細説明</p>
        </div>
        <div class="category_content">
            <a><?php echo e($item->description); ?></a>
        </div>
    </div>
    <div class="category">
        <div class="ed-container">
            <button type="button" class="edit-button"
                onclick="location.href='<?php echo e(route('admin.news.edit', ['id' => $item->id])); ?>'">
                編集
            </button>
            <form class="ed-form" action="<?php echo e(route('admin.news.delete', ['id' => $item->id])); ?>" method="POST"
                onsubmit="return confirm('本当に削除しますか？');">

                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="delete-button">削除</button>
            </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/html/resources/views/components/news-admin.blade.php ENDPATH**/ ?>