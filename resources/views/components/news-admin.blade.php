@foreach($news as $news)
<div class="admin-container">


    <div class="category">
        <div class="category_name">
            <p>id</p>
        </div>
        <div class="category_content">
            <p>{{ $news->id }}</p>
        </div>

    </div>


    <div class="category">
        <div class="category_name">
            <p>日付</p>
        </div>
        <div class="category_content">
            <p>{{ $news->date }}</p>

        </div>
    </div>


    <div class="category">
        <div class="category_name">
            <p>カテゴリー</p>
        </div>
        <div class="category_content">
            <a>{{ $news->category }}</a>

        </div>
    </div>

    <div class="category">
        <div class="category_name">
            <p>タイトル</p>
        </div>
        <div class="category_content">
            <a>{{ $news->title }}</a>

        </div>
    </div>
    <div class="category" style="overflow: hidden;">
        <div class="category_name">

            <p>詳細説明</p>
        </div>
        <div class="category_content">
            <a>{{ $news->description }}</a>
        </div>
    </div>

 
</div>
@endforeach