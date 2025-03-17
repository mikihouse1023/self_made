<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="admin-container">


    <div class="category">
        <div class="category_name">
            <p>id</p>
        </div>
        <div class="category_content">
            <p><?php echo e($user->id); ?></p>
        </div>

    </div>


    <div class="category">
        <div class="category_name">
            <p>ユーザー名</p>
        </div>
        <div class="category_content">
            <p><?php echo e($user->name); ?></p>

        </div>
    </div>


    <div class="category">
        <div class="category_name">
            <p>メールアドレス</p>
        </div>
        <div class="category_content">
            <a><?php echo e($user->email); ?></a>

        </div>
    </div>

    <div class="category">
        <div class="category_name">
            <p>電話番号</p>
        </div>
        <div class="category_content">
            <a><?php echo e($user->tel); ?></a>

        </div>
    </div>
    <div class="category">
        <div class="category_name">
            <p>住所</p>
        </div>
        <div class="category_content">
            <a><?php echo e($user->address); ?></a>
        </div>
    </div>

    <div class="category">
        <div class="ed-container">
            <button type="button" onclick="location.href='<?php echo e(route('admin.user.edit', ['id' => $user->id, 'tab' => 'user'])); ?>'" class="edit-button">編集</button>
            <form action="<?php echo e(route('admin.user.delete', $user->id)); ?>" method="post" style="display:inline;" class="ed-form">
                <?php echo csrf_field(); ?>
                <button type="submit" class="delete-button" onclick="return confirm('本当に削除しますか？');" class="delete-button">削除</button>
            </form>
        </div>
    
</div>


</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /var/www/html/resources/views/components/user-list-admin.blade.php ENDPATH**/ ?>