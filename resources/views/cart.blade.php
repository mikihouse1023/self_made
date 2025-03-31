@extends('layouts.app')

@section('content')


        <h1>■注文内容</h1>


    <!-- カートの中身を表示 -->
    @if ($cartItems->isEmpty())
        <p class="total-price">カートに商品がありません。</p>
    @else
        
            @foreach($cartItems as $item)
                <li class="cart-list">
                    <x-cart-item :item="$item" :delete="true" />
                </li>
            @endforeach
       

        @if(session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif

        {{-- ✅ クーポン適用フォーム --}}
        
        <form action="{{ route('cart.applyCoupon') }}" method="POST">
            @csrf
            <label for="coupon">クーポンを選択:</label>
            <select name="coupon_id" id="coupon" class="dropdown">
                <option value="">クーポンを使用しない</option> {{-- ✅ 常に表示 --}}
                @foreach($coupons as $coupon)
                    <option value="{{ $coupon->id }}">{{ $coupon->code }} - 割引 {{ $coupon->discount_value }}円</option>
                @endforeach
            </select>
            <div class="one-button-container">
            <button type="submit" class="applicable-button">クーポンを適用</button>
            </div>
        </form>
    @endif

    {{-- ✅ 合計金額の表示 --}}
  
    <h1 class="total-price-container">合計金額: <span id class="total-price">
        {{ number_format($discountedTotal) }} 円
    </span></h1>



    <div class="button-container" style="margin:0 auto;">
        <button class="back-button" onclick="location.href='{{ route('menu') }}'">戻る</button>   
        <form action="{{ route('cart.register') }}" method="POST">
            @csrf
            <button type="submit" class="registration-button">登録</button>
        </form>
    </div>

@endsection
