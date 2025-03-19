@props(['orders'])

@foreach ($orders as $orderCode => $orderItems)
    @php
        // ✅ クーポン適用前の合計金額
        $totalAmount = $orderItems->sum(fn($item) => $item->price * $item->quantity);

        // ✅ `orders` テーブルの `discounted_total` を取得
        $discountedTotal = $orderItems->first()->discounted_total ?? $totalAmount;
    @endphp

    <h3>注文コード: {{ $orderCode }}</h3>
    <table class="table">
        <thead>
            <tr>
                <th>商品名</th>
                <th>値段</th>
                <th>数量</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price) }}円</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>合計金額（クーポン適用前）: <strong>{{ number_format($totalAmount) }} 円</strong></h4>
    <h4>クーポン適用後の合計金額: <strong>{{ number_format($discountedTotal) }} 円</strong></h4>

    <button onclick="location.href='{{ route('order.qr', ['orderCode' => $orderCode]) }}'" class="QR-button">
        QRコードを発行
    </button>

    <form action="{{ route('order.delete', ['orderCode' => $orderCode]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-button" onclick="return confirm('この注文を削除しますか？');">
            注文を削除
        </button>
    </form>
@endforeach
