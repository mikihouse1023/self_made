@extends('layouts.app')

@section('content')


    <div style="display:flex;">
        <h1 style="width:60%;margin:0 auto;">■注文内容</h1>
    </div>

    <!-- カートの中身を表示 -->
    @if ($cartItems->isEmpty())
        <p>カートに商品がありません。</p>
    @else
        <ul role="list" class="w-list-unstyled">
            @foreach($cartItems as $item)
                <li class="list-item">
                    <x-cart-item :item="$item" :delete="true" />
                </li>
            @endforeach
        </ul>
    @endif
</div>

<div class="button-container" style="margin:0 auto;">
<button class="back-button" onclick="location.href='{{ route('menu') }}'">戻る</button>   
<form action="{{ route('cart.register') }}" method="POST">
    @csrf
        <button type="submit" class="registration-button">登録</button>
    </div>
</form>

</div>

@endsection
