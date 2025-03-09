@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>QRコード</h1>
        <p>注文コード: {{ $orderCode }}</p>
        <div class="qr-code">
            {!! $qrCode !!}
        </div>
        <a href="{{ route('order.view') }}" class="btn btn-secondary">注文履歴に戻る</a>
    </div>
@endsection
