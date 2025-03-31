@props(['orders'])

@foreach ($orders as $orderCode => $orderItems)
@php
// ✅ クーポン適用前の合計金額
$totalAmount = $orderItems->sum(fn($item) => $item->price * $item->quantity);

// ✅ orders テーブルの discounted_total を取得
$discountedTotal = $orderItems->first()->discounted_total ?? $totalAmount;

$isReserved = $orderItems->contains(fn($item) => $item->is_reserved); // ←1件でも true ならOK
$reservedAt = $orderItems->firstWhere('is_reserved', true)?->reserved_at;
@endphp

<div class="order-container @if($isReserved) reserved @endif">
    <h3>注文コード: {{ $orderCode }}</h3>
    <table class="table">
        <thead>
            <tr>
                <th class="order-name">商品名</th>
                <th class="order-price">値段</th>
                <th class="order-quantity">数量</th>
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

    <h2>合計金額（クーポン適用前）: <strong>{{ number_format($totalAmount) }} 円</strong></h2>
    <h2>クーポン適用後の合計金額: <strong>{{ number_format($discountedTotal) }} 円</strong></h2>
    @if ($isReserved && $reservedAt)
    <p class="reserved-label">
        予約済み （{{ \Carbon\Carbon::parse($reservedAt)->format('Y年n月j日 H:i') }}）
    </p>
@endif

    <div class="order-button-container">
        <button onclick="location.href='{{ route('order.qr', ['orderCode' => $orderCode]) }}'" class="QR-button">
            QRコードを発行
        </button>


        @if(!$isReserved)

        <button onclick="location.href='{{ route('order.reservation', ['orderCode' => $orderCode]) }}'" class="reservation-button">予約する</button>
        @else

        <form action="{{ route('order.cancel', ['orderCode' => $orderCode]) }}" method="POST" class="reservation-form">
            @csrf
            <button type="submit" class="reservation-delete-button" onclick="return confirm('予約を解除しますか？');" >予約解除</button>
        </form>
        @endif
    </div>

    <form action="{{ route('order.delete', ['orderCode' => $orderCode]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="order-delete-button" onclick="return confirm('この注文を削除しますか？');">
            注文を削除
        </button>
    </form>
</div>
@if (session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif
@endforeach