<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Admin;
use App\Models\News;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{


    public function index(Request $request)
    {
        $tab = $request->input('tab', 'product');

        // 各タブのデータ取得
        $products = Product::paginate(8);
        $news = News::paginate(8);
        $users = User::paginate(8);
        $admins = Admin::paginate(8);

        // ✅ 売上データを取得（注文ごとに集約）
        $sales = \DB::table('sales')
            ->select(
                'order_code',
                'user_id',
                'created_at',
                \DB::raw('GROUP_CONCAT(name SEPARATOR ", ") as product_names'),
                \DB::raw('SUM(price * quantity) as total_amount'),
                \DB::raw('MAX(discounted_total) as discounted_total')
            )
            ->groupBy('order_code', 'user_id', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['*'], 'sale_page');

        // ✅ 予約データを取得（`is_reserved = true` のものを取得）
        $reservations = \DB::table('orders')
            ->where('is_reserved', true)
            ->select(
                'order_code',
                'user_id',
                'reserved_at',
                'guest_count',
                \DB::raw('GROUP_CONCAT(name SEPARATOR ", ") as product_names'),
                \DB::raw('SUM(price * quantity) as total_amount')
            )
            ->groupBy('order_code', 'user_id', 'reserved_at', 'guest_count')
            ->orderBy('reserved_at', 'asc')
            ->paginate(8, ['*'], 'reservation_page');


        return view('admin', compact(
            'products',
            'news',
            'users',
            'admins',
            'sales',
            'reservations',
            'tab'
        ));
    }



    public function createProduct()
    {
        return view('create_product');
    }
    public function storeProduct(Request $request)
    {
        // 入力データのバリデーション
        $validated = $request->validate([
            'category' => 'required|string|in:set_meals,dishes,side_menus',
            'name' => 'required|string|max:50',
            'val' => 'required|integer|min:0',
            'explanation' => 'required|string',
            'category' => 'required|string',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'category.required' => 'カテゴリを選択してください。',
            'name.required' => '商品名を入力してください。',
            'name.max' => '商品名は50文字以内で入力してください。',
            'val.required' => '値段は必須項目です。',
            'val.integer' => '値段は整数で入力してください。',
            'val.min' => '値段は0以上でなければなりません。',
            'explanation.required' => '説明を入力してください。',
            'picture.required' => '画像をアップロードしてください。',
            'picture.image' => '画像形式のファイルを選択してください。',
            'picture.mimes' => '画像形式はjpeg, png, jpg, gifのいずれかである必要があります。',
            'picture.max' => '画像サイズは2MB以下にしてください。',
        ]);

        // 画像のアップロード処理
        $path = $request->file('picture')->store('images', 'public');

        Product::create([
            'name' => $validated['name'],
            'val' => $validated['val'],
            'explanation' => $validated['explanation'],
            'category' => $validated['category'],
            'picture' => $path,
        ]);

        // 登録完了後のリダイレクト
        return redirect()->route('admin.index')->with('success', '商品を登録しました');
    }

    public function editProduct($id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.index')->with('error', '商品が見つかりません');
        }

        return view('edit_product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        // 入力データのバリデーション
        $validated = $request->validate([
            'category' => 'required|string|in:set_meals,dishes,side_menus',
            'name' => 'required|string|max:50',
            'val' => 'required|integer|min:0',
            'explanation' => 'required|string',
            'category' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.index')->with('error', '商品が見つかりません');
        }

        $product->name = $validated['name'];
        $product->val = $validated['val'];
        $product->explanation = $validated['explanation'];
        $product->category = $validated['category'];

        if ($request->hasFile('picture')) {
            if ($product->picture) {
                \Storage::disk('public')->delete($product->picture);
            }
            $product->picture = $request->file('picture')->store('images', 'public');
        }

        $product->save();

        return redirect()->route('admin.index')->with('success', '商品を更新しました');
    }

    public function deleteProduct($id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.index')->with('error', '商品が見つかりません');
        }

        if ($product->picture) {
            \Storage::disk('public')->delete($product->picture);
        }

        $product->delete();

        return redirect()->route('admin.index')->with('success', '商品を削除しました');
    }
}
