<div>
    <h2>売上一覧</h2>
    <table border="1">

        <tbody>
            @foreach($sales as $sale)
                <tr>
                <th>注文コード</th>
                    <td>{{ $sale->order_code }}</td>
                    <th>ユーザーID</th>
                    <td>{{ $sale->user_id }}</td>
                    <th>購入日時</th>
                    <td>{{ $sale->created_at }}</td>
                    <th>購入商品</th>
                    <td>{{ $sale->product_names }}</td>
                    <th>合計金額</th>
                    <td>{{ number_format($sale->total_amount) }}円</td>
                    <th>使用クーポン金額</th>
                    <td>{{ number_format($sale->total_amount - $sale->discounted_total) }}円</td>
                    <th>クーポン適用後の金額</th>
                    <td>{{ number_format($sale->discounted_total) }}円</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $sales->appends(['tab' => 'sales'])->links() }}
    </div>
</div>