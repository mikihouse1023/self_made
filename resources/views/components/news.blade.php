<!--コンポーネントを作成しない場合必要
@props(['news'])-->

<div class="News-container">
    <div class="News">
    <a>ニュース</a>
    </div>
    <div class="newsList">
        @foreach($news as $item)
        <div class="news-line">
            <div class="news-item" style="background-color:#FFCC33;">
                <p>{{ $item->date }}</p>
            </div>

            <div class="news-item" style=background-color:green;>
                <p>{{ $item->category }}</p>
            </div>
            @if($item->is_new)
            <div class="news-item" style=background-color:red;>
                <p>NEW</p>
            </div>
            @endif
        </div>
        <div class="news-title">
            <div class="news-item" style=color:black;>
                <a>{{ $item->title }}</a>
            </div>
        </div>
        @endforeach
    </div>
</div>