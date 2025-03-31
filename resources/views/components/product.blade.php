@props(['products', 'category'])
<div class="products-wrapper">
    @foreach($products as $product)
    <div class="product-container">
        <div class="product">
            <p class="product-title">{{ $product->name }}</p>
            <p class="product-image-container"><img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->name }}" class="image"></p>
            <p class="product-price">{{ $product->val }}円</p>
            <p class="product-explanation">{{ $product->explanation }}</p>
            
            <form action="{{ route('cart.add') }}" method="POST" class="product-button-container" style="height:15%;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="category" value="{{ $category }}"> <!-- カテゴリを追加 -->
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->val }}">
                <input type="hidden" name="image" value="{{ asset('storage/' . $product->picture) }}">
               
                <button type="submit"  class="order-button">注文する</button>
             
            </form>
        </div>
    </div>
    @endforeach
</div>