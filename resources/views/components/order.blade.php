@foreach ($orders as $orderCode => $orderItems)
    @php
        // ✅ クーポン適用前の合計金額
        $totalAmount = $orderItems->sum(fn($item) => $item->price * $item->quantity);

        // ✅ クーポン適用後の金額をデータベースから取得（NULLの場合は適用前の金額を設定）
        $orderRecord = \App\Models\OrderCode::where('order_code', $orderCode)->first();
        $discountedTotal = $orderRecord && isset($orderRecord->discounted_total) ? $orderRecord->discounted_total : $totalAmount;
        $discountApplied = $totalAmount - $discountedTotal;
    @endphp
    
    <h3>注文コード: {{ $orderCode }}</h3>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th class="table-name">商品名</th>
                    <th class="table-price">値段</th>
                    <th class="table-quantity">数量</th>
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

        {{-- ✅ 合計金額（クーポン適用前）を表示 --}}
        <h4>合計金額（クーポン適用前）: <strong>{{ number_format($totalAmount) }} 円</strong></h4>

        {{-- ✅ クーポン適用後の金額を表示 --}}
        @if ($discountApplied > 0)
            <h4>割引額: -{{ number_format($discountApplied) }} 円</h4>
            <h4>クーポン適用後の合計: <strong>{{ number_format($discountedTotal) }} 円</strong></h4>
        @endif

        <button onclick="location.href='{{ route('order.qr', ['orderCode' => $orderCode]) }}'" class="QR-button">
            QRコードを発行
        </button>

        {{-- ✅ 削除ボタン --}}
        <form action="{{ route('order.delete', ['orderCode' => $orderCode]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-button" onclick="return confirm('この注文を削除しますか？');">
                注文を削除
            </button>
        </form>
    </div>
@endforeach
