<?php

namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        $news = News::latest()->paginate(5); // ニュースデータを取得
        return view('index', compact('news')); // ビューに渡す
    }

    public function newsShow($id)
    {
        $news = News::findOrFail($id); // ニュース詳細を取得
        return view('news', compact('news')); // ビューに渡す
    }
    
}
