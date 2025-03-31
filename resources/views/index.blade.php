@extends('layouts.app')
@section('content')

<div class="carousel">
    <div class="slider">
        <div class="slides">
            <div class="slide"><img src="{{ asset('images/いろいろ定食.png') }}" alt="Slide 1"></div>
            <div class="slide"><img src="{{ asset('images/いろいろ定食2.png') }}" alt="Slide 1"></div>
            <div class="slide"><img src="{{ asset('images/いろいろ定食3.png') }}" alt="Slide 1"></div>
        </div>

        <div class="controls">
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>

        </div>
    </div>
</div>

<div class="ranking-container" style="padding: 20px;">

    {{-- ▼ ジャンル選択ドロップダウン --}}
    <form method="GET" action="{{ route('index') }}" style="margin-bottom: 15px;">
        <label for="category">ジャンルを選択：</label>
        <select name="category" id="category" class="dropdown" onchange="this.form.submit()">
            <option value="">指定なし（全体）</option>
            <option value="set_meal" {{ request('category') == 'set_meal' ? 'selected' : '' }}>定食</option>
            <option value="dish" {{ request('category') == 'dish' ? 'selected' : '' }}>丼/麺</option>
            <option value="side_menu" {{ request('category') == 'side_menu' ? 'selected' : '' }}>サイドメニュー</option>
        </select>
    </form>

    <h1>
        🥇 売上ランキング TOP10 🥇
        @if ($category == 'set_meal')
        （定食）
        @elseif ($category == 'dish')
        （丼/麺）
        @elseif ($category == 'side_menu')
        （サイドメニュー）
        @endif
    </h1>

    {{-- ▼ ランキングテーブル --}}


    <table class="ranking-table">
        <thead>
            <tr>
                <th class="ranking-item" style="background-color:red;width:10%;">順位</th>
                <th class="ranking-item" style="background-color:orange;">商品名</th>
                

            </tr>
        </thead>
        <tbody>
            @forelse ($ranking as $index => $item)
            <tr>
                <td class="ranking">{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
    

            </tr>
            @empty
            <tr>
                <td colspan="4">該当するデータがありません。</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
<x-news :news="$news" />
@endsection