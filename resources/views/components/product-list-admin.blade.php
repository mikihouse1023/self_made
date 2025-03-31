@props(['products'])

@php
    // カテゴリごとに分類
    $grouped = $products->groupBy('category');
@endphp

@foreach ($grouped as $category => $items)
    <div class="category-block">
        <div class="one-button-container">
            <h2>
                @switch($category)
                    @case('set_meal') 定食 @break
                    @case('dish') 丼・麺 @break
                    @case('side_menu') サイドメニュー @break
                    @default その他
                @endswitch
            </h2>
        </div>

        @foreach ($items as $item)
            <div class="admin-container">

                <div class="category">
                    <div class="category_name"><p>ID</p></div>
                    <div class="category_content"><a>{{ $item->id }}</a></div>
                </div>

                <div class="category">
                    <div class="category_name"><p>商品名</p></div>
                    <div class="category_content"><a>{{ $item->name }}</a></div>
                </div>

                <div class="category">
                    <div class="category_name"><p>値段</p></div>
                    <div class="category_content"><a>¥{{ $item->val }}</a></div>
                </div>

                <div class="category">
                    <div class="category_name"><p>商品説明</p></div>
                    <div class="category_content"><a style="font-size:15px;">{{ $item->explanation }}</a></div>
                </div>

                <div class="category">
                    <div class="category_name"><p>写真</p></div>
                    <div class="category_content">
                        <img class="admin_picture" src="{{ asset('storage/' . $item->picture) }}" alt="{{ $item->name }}">
                    </div>
                </div>



                <div class="category">
                    <div class="ed-container">
                        <button type="button" class="edit-button"
                            onclick="location.href='{{ route('admin.product.edit', $item->id) }}'">編集</button>

                        <form class="ed-form" action="{{ route('admin.product.delete', $item->id) }}" method="POST"
                            onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">削除</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach

{{-- ページネーション --}}
<div class="pagination">
    {{ $products->appends(request()->query())->links() }}
</div>
