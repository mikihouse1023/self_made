<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Sale;
use App\Models\Coupon;
use App\Models\OrderCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{  //1:ログインチェック
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
    
        // ✅ 注文一覧を取得
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('order_code');
    
        // ✅ 使用済みクーポンを取得
        $appliedCoupons = Coupon::where('user_id', Auth::id())->where('used', true)->get();
    
        return view('orderlist', compact('orders', 'appliedCoupons'));
    }
    
    public function registerOrder()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
    
        // ✅ カートの取得
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'カートが空です');
        }
    
        // ✅ 合計金額（クーポン適用前）を計算
        $totalAmount = $cartItems->sum(fn($item) => $item->price * ($item->quantity ?? 1));
    
        // ✅ クーポン適用後の金額を取得
        $discountedTotal = session('discounted_total', $totalAmount);
    
        // ✅ 注文コードを作成
        $orderCode = 'ORDER-' . date('Ymd') . '-' . Str::random(6);
    
        // ✅ 注文情報を保存（discounted_total を追加）
        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => Auth::id(),
                'order_code' => $orderCode,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity ?? 1,
                'discounted_total' => $discountedTotal // ✅ クーポン適用後の金額を保存
            ]);
        }
    
        // ✅ carts テーブルを削除
        Cart::where('user_id', Auth::id())->delete();
    
        // ✅ クーポン情報をセッションから削除
        session()->forget(['discounted_total', 'applied_coupon_id']);
    
        return redirect()->route('menu')->with('success', "注文が登録されました（合計金額: {$discountedTotal} 円）");
    }
    
    

    public function viewOrder()
    {
        return $this->index(); //他のメソッドを呼び出す
    }


    public function deleteOrder($orderCode)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        // 該当の注文を取得
        $orderItems = Order::where('order_code', $orderCode)->get();

        if ($orderItems->isEmpty()) {
            return redirect()->route('order.view')->with('error', '注文が見つかりません');
        }

        // ✅ 割引適用された合計金額を取得
        $orderRecord = OrderCode::where('order_code', $orderCode)->first();

        if ($orderRecord && isset($orderRecord->discounted_total)) {
            // ✅ 適用されたクーポンを特定（この注文で割引された額をもつクーポンを検索）
            $coupon = \App\Models\Coupon::where('user_id', Auth::id())
                ->where('discount_value', $orderRecord->discounted_total) // 同じ割引額のクーポンを検索
                ->whereNotNull('used_at') // 既に使われたクーポン
                ->first();

            if ($coupon) {
                // ✅ クーポンを未使用に戻す
                $coupon->update(['used_at' => null]);
            }
        }

        // ✅ 注文と関連する OrderCode を削除
        Order::where('order_code', $orderCode)->delete();
        OrderCode::where('order_code', $orderCode)->delete();

        return redirect()->route('order.view')->with('success', '注文を削除し、クーポンを未使用に戻しました');
    }



    public function generateQRCode($orderCode)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        $completeUrl = config('app.url') . "/order/complete/{$orderCode}";

        $qrCode = QrCode::size(300)->encoding('UTF-8')->generate($completeUrl);

        // QRコードのデータを保存（まだ読み込まれていない）
        OrderCode::updateOrCreate(
            ['order_code' => $orderCode],
            ['is_scanned' => false]
        );

        return view('qr', compact('qrCode', 'orderCode'));
    }

    // 「読み込み完了」ボタンを押した時の処理
    public function waitForScan($orderCode)
    {
        return view('access', compact('orderCode'));
    }

    public function checkScanStatus($orderCode)
    {
        $orderCodeRecord = OrderCode::where('order_code', $orderCode)->first();

        if ($orderCodeRecord) {
            // Log::info("QRコードチェック: {$orderCode} -> is_scanned: " . ($orderCodeRecord->is_scanned ? 'true' : 'false'));
        } else {
            //Log::error("QRコードが見つかりません: {$orderCode}");
        }

        return response()->json(['scanned' => $orderCodeRecord && $orderCodeRecord->is_scanned]);
    }



    // 読み取った端末で complete.blade.php に移動
    public function completeOrder($orderCode)
    {
        // QRコードが読み込まれたか確認
        $orderCodeRecord = OrderCode::where('order_code', $orderCode)->first();
        if (!$orderCodeRecord || !$orderCodeRecord->is_scanned) {
            return redirect()->route('order.wait', ['orderCode' => $orderCode])
                ->with('error', 'QRコードがまだ読み込まれていません');
        }

        // 完了処理
        $userId = Auth::check() ? Auth::id() : null;
        $orderItems = Order::where('order_code', $orderCode)->get();

        if ($orderItems->isEmpty()) {
            return redirect()->route('order.view')->with('error', '注文が見つかりません');
        }

        $totalAmount = $orderItems->sum(fn($item) => $item->price * $item->quantity);

        foreach ($orderItems as $order) {
            Sale::create([
                'user_id'    => $userId,
                'order_code' => $order->order_code,
                'name'       => $order->name,
                'price'      => $order->price,
                'quantity'   => $order->quantity,
            ]);
        }

        Order::where('order_code', $orderCode)->delete();

        $gameCount = intdiv($totalAmount, 1000);
        $gameCode = rand(1000, 9999);

        session()->put('game_count', $gameCount);
        session()->put('game_code', $gameCode);

        return view('complete', compact('orderCode', 'gameCode', 'gameCount'));
    }

    public function markAsScanned($orderCode)
    {
        Log::info("markAsScanned() accessed: orderCode = {$orderCode}");

        $orderCodeRecord = OrderCode::where('order_code', $orderCode)->first();

        if ($orderCodeRecord) {
            $orderCodeRecord->update(['is_scanned' => true]);
            Log::info("OrderCode updated: orderCode = {$orderCode}, is_scanned = true");
        } else {
            OrderCode::create([
                'order_code' => $orderCode,
                'is_scanned' => true
            ]);
            Log::info("OrderCode created: orderCode = {$orderCode}, is_scanned = true");
        }

        return redirect()->route('order.wait', ['orderCode' => $orderCode])
            ->with('success', 'QRコードのスキャンが完了しました。');
    }

    public function playMiniGame(Request $request)
    {
        $gameCount = session('game_count', 0);
        $correctGameCode = session('game_code');

        if ($gameCount <= 0) {
            return redirect()->route('minigame')->with('error', 'ミニゲームの回数がありません。');
        }

        $inputGameCode = $request->input('game_code');

        if ($inputGameCode != $correctGameCode) {
            return redirect()->route('minigame')->with('error', '番号が間違っています。');
        }

        // 🎯 ランダムでスタンプを獲得
        $random = rand(1, 100);
        if ($random <= 90) {
            $result = '🎉 大吉！スタンプ3個ゲット！ 🎉';
            $stampsEarned = 5;
        } elseif ($random <= 95) {
            $result = '😊 中吉！スタンプ2個ゲット！ 😊';
            $stampsEarned = 2;
        } else {
            $result = '😌 小吉！スタンプ1個ゲット！ 😌';
            $stampsEarned = 1;
        }

        // 🎯 ユーザーのスタンプを更新
        $user = Auth::user();
        $user->stamps += $stampsEarned;
        $user->save();

        // 🎯 セッション情報を更新
        session(['game_count' => max(0, $gameCount - 1)]);

        return redirect()->route('minigame')->with([
            'game_result' => $result,
            'stamps_earned' => $stampsEarned,
            'game_count' => session('game_count'),
        ]);
    }
}