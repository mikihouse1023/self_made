<?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="admin-container">


    <div class="category">
        <div class="category_name">
            <p>id</p>
        </div>
        <div class="category_content">
            <p><?php echo e($admin->id); ?></p>
        </div>

    </div>


    <div class="category">
        <div class="category_name">
            <p>ユーザー名</p>
        </div>
        <div class="category_content">
            <p><?php echo e($admin->name); ?></p>

        </div>
    </div>


    <div class="category">
        <div class="category_name">
            <p>メールアドレス</p>
        </div>
        <div class="category_content">
            <a><?php echo e($admin->email); ?></a>

        </div>
    </div>

    <div class="category">
        <div class="category_name">
            <p>電話番号</p>
        </div>
        <div class="category_content">
            <a><?php echo e($admin->tel); ?></a>

        </div>
    </div>
    <div class="category">
        <div class="category_name">

            <p>住所</p>
        </div>
        <div class="category_content">
            <a><?php echo e($admin->address); ?></a>
        </div>
    </div>
    <div class="category">
    <div class="ed-container">
            <button onclick="location.href='<?php echo e(route('admin.user.edit',$admin->id)); ?>'" class="edit-button">編集</button>
            <form action="<?php echo e(route('admin.user.delete', $admin->id)); ?>" method="post"">
                <?php echo csrf_field(); ?>
                <button type="submit" class="delete-button" onclick="return confirm('本当に削除しますか？');">削除</button>
            </form>
        </div>

    </div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/html/resources/views/components/admin-list-admin.blade.php ENDPATH**/ ?>