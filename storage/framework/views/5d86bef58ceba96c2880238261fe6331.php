<?php $__env->startSection('content'); ?>

<h1>ADMIN画面</h1>
<div class="tabs">
  <div class="tab-menu">
    <a href="?tab=set_meal" data-tab="set_meal" class="tab-link w-inline-block w-tab-link <?php echo e($tab === 'set_meal' ? 'w--current' : ''); ?>">
      メニュー
    </a>
    <a href="?tab=news" data-tab="news" class="tab-link w-inline-block w-tab-link <?php echo e($tab === 'news' ? 'w--current' : ''); ?>">
      ニュース
    </a>
    <a href="?tab=user" data-tab="user" class="tab-link w-inline-block w-tab-link <?php echo e($tab === 'user' ? 'w--current' : ''); ?>">
      ユーザー
    </a>
  </div>
</div>

<div class="tab-content">

  <div id="set_meal" class="w-tab-pane fade " style="<?php echo e($tab === 'set_meal' ? 'display: block;' : 'display: none;'); ?>">
    <div class="one-button-container"><button onclick="location.href='<?php echo e(route('admin.food_add')); ?>'" class="add-button">商品追加</button></div>

    <h1>■メニュー</h1>
    <h1>定食</h1>
    <?php if (isset($component)) { $__componentOriginal183054c3be4009cdb7197b9f80292664 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal183054c3be4009cdb7197b9f80292664 = $attributes; } ?>
<?php $component = App\View\Components\ItemAdmin::resolve(['items' => $set_meals] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('item-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ItemAdmin::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => 'set_meals']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal183054c3be4009cdb7197b9f80292664)): ?>
<?php $attributes = $__attributesOriginal183054c3be4009cdb7197b9f80292664; ?>
<?php unset($__attributesOriginal183054c3be4009cdb7197b9f80292664); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal183054c3be4009cdb7197b9f80292664)): ?>
<?php $component = $__componentOriginal183054c3be4009cdb7197b9f80292664; ?>
<?php unset($__componentOriginal183054c3be4009cdb7197b9f80292664); ?>
<?php endif; ?>
    <h1>丼・麺</h1>

    <?php if (isset($component)) { $__componentOriginal183054c3be4009cdb7197b9f80292664 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal183054c3be4009cdb7197b9f80292664 = $attributes; } ?>
<?php $component = App\View\Components\ItemAdmin::resolve(['items' => $dishes] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('item-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ItemAdmin::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => 'dishes']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal183054c3be4009cdb7197b9f80292664)): ?>
<?php $attributes = $__attributesOriginal183054c3be4009cdb7197b9f80292664; ?>
<?php unset($__attributesOriginal183054c3be4009cdb7197b9f80292664); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal183054c3be4009cdb7197b9f80292664)): ?>
<?php $component = $__componentOriginal183054c3be4009cdb7197b9f80292664; ?>
<?php unset($__componentOriginal183054c3be4009cdb7197b9f80292664); ?>
<?php endif; ?>
    <h1>サイドメニュー</h1>
    <?php if (isset($component)) { $__componentOriginal183054c3be4009cdb7197b9f80292664 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal183054c3be4009cdb7197b9f80292664 = $attributes; } ?>
<?php $component = App\View\Components\ItemAdmin::resolve(['items' => $side_menus] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('item-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ItemAdmin::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => 'side_menus']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal183054c3be4009cdb7197b9f80292664)): ?>
<?php $attributes = $__attributesOriginal183054c3be4009cdb7197b9f80292664; ?>
<?php unset($__attributesOriginal183054c3be4009cdb7197b9f80292664); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal183054c3be4009cdb7197b9f80292664)): ?>
<?php $component = $__componentOriginal183054c3be4009cdb7197b9f80292664; ?>
<?php unset($__componentOriginal183054c3be4009cdb7197b9f80292664); ?>
<?php endif; ?>
  </div>

  <div id="news" class="w-tab-pane" style="<?php echo e($tab === 'news' ? 'display: block;' : 'display: none;'); ?>">

    <h1>■ニュース</h1>
    <div class="one-button-container">
      <button class="add-button" onclick="location.href='<?php echo e(route('admin.news_add')); ?>'" style="margin-right:50px;">ニュース登録</button>
    </div>
    <h2>ニュース</h2>
    <?php if (isset($component)) { $__componentOriginal47f37f16afdf26cc1257f029954322c0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal47f37f16afdf26cc1257f029954322c0 = $attributes; } ?>
<?php $component = App\View\Components\NewsAdmin::resolve(['news' => $news] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('news-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\NewsAdmin::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal47f37f16afdf26cc1257f029954322c0)): ?>
<?php $attributes = $__attributesOriginal47f37f16afdf26cc1257f029954322c0; ?>
<?php unset($__attributesOriginal47f37f16afdf26cc1257f029954322c0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal47f37f16afdf26cc1257f029954322c0)): ?>
<?php $component = $__componentOriginal47f37f16afdf26cc1257f029954322c0; ?>
<?php unset($__componentOriginal47f37f16afdf26cc1257f029954322c0); ?>
<?php endif; ?>
  </div>

  <div id="user" class="w-tab-pane" style="<?php echo e($tab === 'user' ? 'display: block;' : 'display: none;'); ?>">
    <h1>■ユーザー情報</h1>
    <div class="one-button-container">
      <button class="add-button" onclick="location.href='<?php echo e(route('admin.user_add')); ?>'" style="margin-right:50px;">ユーザー登録</button>
    </div>
    <h2>一般ユーザー</h2>
    <?php if (isset($component)) { $__componentOriginalc88b1f34aacf53df713d1c0411881bcd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc88b1f34aacf53df713d1c0411881bcd = $attributes; } ?>
<?php $component = App\View\Components\UserListAdmin::resolve(['users' => $users] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-list-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\UserListAdmin::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc88b1f34aacf53df713d1c0411881bcd)): ?>
<?php $attributes = $__attributesOriginalc88b1f34aacf53df713d1c0411881bcd; ?>
<?php unset($__attributesOriginalc88b1f34aacf53df713d1c0411881bcd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc88b1f34aacf53df713d1c0411881bcd)): ?>
<?php $component = $__componentOriginalc88b1f34aacf53df713d1c0411881bcd; ?>
<?php unset($__componentOriginalc88b1f34aacf53df713d1c0411881bcd); ?>
<?php endif; ?>

    <h2>管理ユーザー</h2>
    <?php if (isset($component)) { $__componentOriginaled6c974bffbffd17f1ec60a22c2496e3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled6c974bffbffd17f1ec60a22c2496e3 = $attributes; } ?>
<?php $component = App\View\Components\AdminListAdmin::resolve(['admins' => $admins] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin-list-admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdminListAdmin::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled6c974bffbffd17f1ec60a22c2496e3)): ?>
<?php $attributes = $__attributesOriginaled6c974bffbffd17f1ec60a22c2496e3; ?>
<?php unset($__attributesOriginaled6c974bffbffd17f1ec60a22c2496e3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled6c974bffbffd17f1ec60a22c2496e3)): ?>
<?php $component = $__componentOriginaled6c974bffbffd17f1ec60a22c2496e3; ?>
<?php unset($__componentOriginaled6c974bffbffd17f1ec60a22c2496e3); ?>
<?php endif; ?>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll(".tab-link");
        const panes = document.querySelectorAll(".w-tab-pane");

        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get("tab") || "set_meal";

        // 初期表示のタブを設定
        tabs.forEach((tab) => {
          const targetId = tab.getAttribute("data-tab");
          const targetPane = document.getElementById(targetId);

          if (targetId === activeTab) {
            tab.classList.add("w--current");
            targetPane.style.display = "block";
            targetPane.style.opacity = "1";
          } else {
            tab.classList.remove("w--current");
            targetPane.style.display = "none";
            targetPane.style.opacity = "0";
          }
        });

        // タブクリック時の処理
        tabs.forEach((tab) => {
          tab.addEventListener("click", function(e) {
            e.preventDefault();
            const targetId = this.getAttribute("data-tab");
            const currentTab = document.querySelector(".tab-link.w--current");
            const currentPane = document.querySelector(".w-tab-pane[style*='display: block;']");
            const targetPane = document.getElementById(targetId);

            if (currentTab === this) return;

            // フェードアウト処理
            if (currentPane) {
              currentPane.classList.add("fade-out");
              currentPane.style.opacity = "0";

              setTimeout(() => {
                currentPane.style.display = "none";
                currentPane.classList.remove("fade-out");

                // フェードイン処理
                targetPane.style.display = "block";
                targetPane.classList.add("fade-in");
                setTimeout(() => {
                  targetPane.style.opacity = "1";
                  targetPane.classList.remove("fade-in");
                }, 50);
              }, 500);
            }

            // タブの状態を更新
            tabs.forEach((t) => t.classList.remove("w--current"));
            this.classList.add("w--current");

            // URLを更新
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set("tab", targetId);
            history.pushState(null, "", newUrl);
          });
        });
      });
    </script>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin.blade.php ENDPATH**/ ?>