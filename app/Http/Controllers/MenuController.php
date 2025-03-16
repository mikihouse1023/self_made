<?php

namespace App\Http\Controllers;

use App\Models\SetMeal;
use App\Models\SideMenu;
use App\Models\Dish;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


use Illuminate\Http\Request;

class MenuController extends Controller
{
    //1:メニューの表示
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'set_meal');

        $set_mealPage = $request->input('set_meal_page', 1);
        $side_menuPage = $request->input('side_menu_page', 1);
        $dishPage = $request->input('dish_page', 1);

        $set_meals = SetMeal::paginate(8, ['*'], 'set_meal_page', $set_mealPage);
        $side_menus = SideMenu::paginate(8, ['*'], 'side_menu_page', $side_menuPage);
        $dishes = Dish::paginate(8, ['*'], 'dish_page', $dishPage);

        return view('menu', compact('set_meals', 'dishes', 'side_menus', 'tab'));
    }

    //2:商品をカートに追加する
    public function addToCart(Request $request)
    {   //ログインチェック
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
        //カートに商品を登録
        Cart::create([
            'user_id' => Auth::id(),
            'item_id' => $request->input('item_id'),
            'category' => $request->input('category'), // カテゴリを追加
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $request->input('image')
        ]);
        //メニュー画面にリダイレクト
        return redirect()->route('menu')->with('success', 'カートに追加しました');
    }

    //3:カートの確認
    public function viewCart()
    {   //ログイン確認
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        // 現在のユーザーのカートの中身を取得
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // 最新の合計金額を取得
        $totalPrice = $cartItems->sum(fn($item) => $item->price * ($item->quantity ?? 1));

        // カートに新しい商品が追加された場合、クーポン適用をリセット
        if (session()->has('applied_coupon_id')) {
            $previousCoupon = Coupon::where('id', session('applied_coupon_id'))->whereNotNull('used_at')->exists();

            if (!$previousCoupon) {
                session()->forget(['discounted_total', 'applied_coupon_id']);
            }
        }

        // ✅ 適用されているクーポンを取得
        $appliedCouponId = session('applied_coupon_id', null);
        $coupon = $appliedCouponId
            ? Coupon::where('id', $appliedCouponId)
            ->where('user_id', Auth::id())
            ->whereNotNull('used_at')
            ->first()
            : null;

        // ✅ クーポン割引後の金額を計算
        $discountedTotal = $coupon ? max(0, $totalPrice - $coupon->discount_value) : $totalPrice;

        // ✅ セッションに最新の割引金額を保存
        session(['discounted_total' => $discountedTotal]);

        // ✅ 利用可能なクーポンを取得
        $coupons = Coupon::where('user_id', Auth::id())->whereNull('used_at')->get();

        return view('cart', compact('cartItems', 'totalPrice', 'discountedTotal', 'coupons'));
    }



    public function applyCoupon(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        // ✅ 「クーポンを使用しない」が選択された場合（適用解除）
        if (!$request->has('coupon_id') || empty($request->coupon_id)) {
            $appliedCouponId = session('applied_coupon_id', null);

            if ($appliedCouponId) {
                // ✅ 使用済みクーポンを未使用に戻す
                $coupon = Coupon::where('id', $appliedCouponId)
                    ->where('user_id', Auth::id())
                    ->whereNotNull('used_at')
                    ->first();
                if ($coupon) {
                    $coupon->used_at = null; // 未使用に戻す
                    $coupon->save();
                }
            }

            // ✅ セッション情報をリセット
            session()->forget(['applied_coupon_id', 'discounted_total']);

            return redirect()->route('cart.view')->with('success', 'クーポンの適用を解除しました');
        }

        // ✅ クーポンの取得
        $coupon = Coupon::where('id', $request->coupon_id)
            ->where('user_id', Auth::id())
            ->whereNull('used_at')
            ->first();

        if (!$coupon) {
            return redirect()->route('cart.view')->with('error', '無効なクーポンです。');
        }

        // ✅ カート内の合計金額を取得
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalAmount = $cartItems->sum(fn($item) => $item->price * ($item->quantity ?? 1));

        // ✅ クーポン適用後の割引金額を計算
        $discountedAmount = max(0, $totalAmount - $coupon->discount_value);

        // ✅ クーポンを使用済みにする
        $coupon->used_at = now();
        $coupon->save();

        // ✅ セッションの値を更新（クーポン ID を記録）
        session([
            'applied_coupon_id' => $coupon->id,
            'discounted_total' => $discountedAmount,
        ]);

        return redirect()->route('cart.view')->with([
            'success' => "クーポンを適用しました！ 割引後の合計金額: {$discountedAmount}円"
        ]);
    }



    public function removeFromCart($id)
    {
        $cartItem = Cart::find($id);

        if ($cartItem && $cartItem->user_id === Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->route('cart.view')->with('success', 'カートから削除しました');
    }
}
