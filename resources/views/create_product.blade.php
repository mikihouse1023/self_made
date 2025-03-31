@extends('layouts.app_login')
@section('content')

<div class="register-container">
    <h1>■商品登録</h1>
    <div class="w-form">
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            {{-- カテゴリ --}}
            @error('category')
                <div class="error">※{{ $message }}</div>
            @enderror
            <label>カテゴリ</label>
            <select class="w-input" name="category" required>
                <option value="">選択してください</option>
                <option value="set_meal">定食</option>
                <option value="dish">丼/麺</option>
                <option value="side_menu">サイドメニュー</option>
            </select>

            {{-- 商品名 --}}
            @error('name')
                <div class="error">※{{ $message }}</div>
            @enderror
            <label>商品名</label>
            <input class="w-input" name="name" value="{{ old('name') }}" required>

            {{-- 値段 --}}
            @error('val')
                <div class="error">※{{ $message }}</div>
            @enderror
            <label>値段</label>
            <input class="w-input" name="val" type="number" value="{{ old('val') }}" required>

            {{-- 説明 --}}
            @error('explanation')
                <div class="error">※{{ $message }}</div>
            @enderror
            <label>説明</label>
            <textarea name="explanation" class="w-input" required>{{ old('explanation') }}</textarea>

            {{-- 画像 --}}
            @error('picture')
                <div class="error">※{{ $message }}</div>
            @enderror
            <label>商品画像</label>
            <input type="file" id="pictureInput" name="picture" class="w-input" accept="image/*" required>

            <div id="imagePreviewContainer" style="margin-top: 15px;">
                <img id="imagePreview" src="" alt="プレビュー画像" style="max-width: 300px; display: none;">
            </div>

            <div class="button-container">
                <button type="button" onclick="location.href='{{ route('admin.index') }}'" class="back-button">戻る</button>
                <input type="submit" class="submit-button" value="登録">
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
                } else {
                    preview.style.display = 'none';
                }
            });
        </script>
    </div>
</div>

@endsection
