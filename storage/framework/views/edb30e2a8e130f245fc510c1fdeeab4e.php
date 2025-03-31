<div>
    <h2>売上一覧</h2>
    <table border="1">

        <tbody>
            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                <th>注文コード</th>
                    <td><?php echo e($sale->order_code); ?></td>
                    <th>ユーザーID</th>
                    <td><?php echo e($sale->user_id); ?></td>
                    <th>購入日時</th>
                    <td><?php echo e($sale->created_at); ?></td>
                    <th>購入商品</th>
                    <td><?php echo e($sale->product_names); ?></td>
                    <th>合計金額</th>
                    <td><?php echo e(number_format($sale->total_amount)); ?>円</td>
                    <th>使用クーポン金額</th>
                    <td><?php echo e(number_format($sale->total_amount - $sale->discounted_total)); ?>円</td>
                    <th>クーポン適用後の金額</th>
                    <td><?php echo e(number_format($sale->discounted_total)); ?>円</td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php echo e($sales->appends(['tab' => 'sales'])->links()); ?>

    </div>
</div><?php /**PATH /var/www/html/resources/views/components/sale-list-admin.blade.php ENDPATH**/ ?>