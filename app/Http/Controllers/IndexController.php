<?php

namespace App\Http\Controllers;

use App\Models\Sale;

use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    
        public function index(Request $request)
        {
            $category = $request->query('category'); // ← 修正ポイント: genre → category に変更
        
            // ベースクエリ
            $rankingQuery = DB::table('sales')
                ->join('products', 'sales.product_id', '=', 'products.id')
                ->where('sales.name', '!=', 'ドリンクバー');
        
            // カテゴリが指定されていればフィルタ
            if (!empty($category)) {
                $rankingQuery->where('products.category', $category);
            }
        
            $ranking = $rankingQuery
                ->select('sales.name', DB::raw('SUM(sales.quantity) as total_quantity'), DB::raw('SUM(sales.price * sales.quantity) as total_sales'))
                ->groupBy('sales.name')
                ->orderByDesc('total_sales')
                ->limit(10)
                ->get();
        
            $news = News::latest()->paginate(5);
        
            return view('index', compact('ranking', 'category', 'news')); // ← 変数名も統一
        }
        
            
    

    public function newsShow($id)
    {
        $news = News::findOrFail($id); // ニュース詳細を取得
        return view('news', compact('news')); // ビューに渡す
    }
}
