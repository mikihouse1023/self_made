@extends('layouts.app_login')
@section('content')

<div class="register-container">
    <h1>■商品編集</h1>
    <div class="w-form">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- カテゴリ --}}
            <label>カテゴリ</label>
            <select class="w-input" name="category" required>
                <option value="set_meal" {{ $product->category === 'set_meal' ? 'selected' : '' }}>定食</option>
                <option value="dish" {{ $product->category === 'dish' ? 'selected' : '' }}>丼/麺</option>
                <option value="side_menu" {{ $product->category === 'side_menu' ? 'selected' : '' }}>サイドメニュー</option>
            </select>

            {{-- 商品名 --}}
            <label>商品名</label>
            <input class="w-input" name="name" value="{{ old('name', $product->name) }}" required>

            {{-- 値段 --}}
            <label>値段</label>
            <input class="w-input" name="val" type="number" value="{{ old('val', $product->val) }}" required>

            {{-- 説明 --}}
            <label>説明</label>
            <textarea name="explanation" class="w-input" required>{{ old('explanation', $product->explanation) }}</textarea>

            {{-- 画像 --}}
            <label>商品画像</label>
            <input type="file" id="pictureInput" name="picture" class="w-input" accept="image/*">
            <div id="imagePreviewContainer" style="margin-top: 15px;">
                <img id="imagePreview" src="{{ asset('storage/' . $product->picture) }}" alt="プレビュー画像" style="max-width: 300px;">
            </div>

            <div class="button-container">
                <button type="button" onclick="location.href='{{ route('admin.index') }}'" class="back-button">戻る</button>
                <input type="submit" class="submit-button" value="更新">
            </div>
        </form>

        <script>
            document.getElementById('pictureInput').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagePreview');
                const reader = new FileReader();

                if (file) {
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });
        </script>
    </div>
</div>

@endsection
