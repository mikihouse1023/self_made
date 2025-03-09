@foreach($users as $user)
<div class="admin-container">


    <div class="category">
        <div class="category_name">
            <p>id</p>
        </div>
        <div class="category_content">
            <p>{{ $user->id }}</p>
        </div>

    </div>


    <div class="category">
        <div class="category_name">
            <p>ユーザー名</p>
        </div>
        <div class="category_content">
            <p>{{ $user->name }}</p>

        </div>
    </div>


    <div class="category">
        <div class="category_name">
            <p>メールアドレス</p>
        </div>
        <div class="category_content">
            <a>{{ $user->email }}</a>

        </div>
    </div>

    <div class="category">
        <div class="category_name">
            <p>電話番号</p>
        </div>
        <div class="category_content">
            <a>{{ $user->tel }}</a>

        </div>
    </div>
    <div class="category">
        <div class="category_name">
            <p>住所</p>
        </div>
        <div class="category_content">
            <a>{{ $user->address }}</a>
        </div>
    </div>

    <div class="category">
        <div class="ed-container">
            <button onclick="location.href='{{ route('admin.user.edit', ['id' => $user->id, 'tab' => 'user']) }}'" class="edit-button">編集</button>
            <form action="{{ route('admin.user.delete', $user->id) }}" method="post" style="display:inline;" class="ed-form">
                @csrf
                <button type="submit" class="button-14 w-button" onclick="return confirm('本当に削除しますか？');" class="delete-button">削除</button>
            </form>
        </div>
    </div>
</div>


</div>
@endforeach