<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
    
        // ✅ 予約時間が現在より過去の注文を削除（is_reserved = true のみ）
        $expiredOrders = Order::where('user_id', Auth::id())
            ->where('is_reserved', true)
            ->whereNotNull('reserved_at')
            ->where('reserved_at', '<', now())
            ->get();
    
        // order_code ごとに削除
        foreach ($expiredOrders->groupBy('order_code') as $orderCode => $group) {
            Order::where('order_code', $orderCode)->delete();
            OrderCode::where('order_code', $orderCode)->delete(); // QR関連も削除
            // ※クーポン処理がある場合はここで戻すなど追加可能
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
                'discounted_total' => $discountedTotal, // ✅ クーポン適用後の金額を保存
                'product_id' => $item->item_id, // carts.item_id → orders.product_id     
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

    public function showReservationForm($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->firstOrFail();

        return view('reservation', [
            'orderCode' => $orderCode,
            'isReserved' => $order->is_reserved
        ]);

    }

    public function reserveOrder(Request $request, $orderCode)
    {
        $request->validate([
            'reservation_datetime' => 'required|date|after:now',
            'guest_count' => 'required|integer|min:1'
        ]);
    
        $orders = Order::where('order_code', $orderCode)->get();
    
        if ($orders->isEmpty()) {
            return redirect()->route('order.view')->with('error', '注文が見つかりません。');
        }
    
        if ($orders->first()->is_reserved) {
            return redirect()->route('order.view')->with('error', 'この注文は既に予約済みです。');
        }
    
        // ← 全件に予約情報を適用
        Order::where('order_code', $orderCode)->update([
            'is_reserved' => true,
            'reserved_at' => $request->reservation_datetime,
            'guest_count' => $request->guest_count,
        ]);
    
        return redirect()->route('order.view')->with('success', '予約が完了しました！');
    }
    

    public function cancelReservation($orderCode)
    {
        // 指定された order_code に関連するすべての注文を取得
        $orders = Order::where('order_code', $orderCode)->get();

        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'この注文はまだ予約されていません。');
        }

        // すべてのレコードの is_reserved を false にし、予約情報をクリア
        Order::where('order_code', $orderCode)->update([
            'is_reserved' => false,
            'reserved_at' => null,
            'guest_count' => null
        ]);

        return redirect()->back()->with('success', '予約をキャンセルしました。');
    }


    

    public function generateQRCode($orderCode)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
    
        $order = Order::where('order_code', $orderCode)->firstOrFail();
    
        // ✅ 予約済みなら予約時間チェック
        if ($order->is_reserved && $order->reserved_at) {
            $reservedAt = Carbon::parse($order->reserved_at);
            $now = Carbon::now();
    
            if ($now->lt($reservedAt->subMinutes(30))) {
                return redirect()->route('order.view')
                    ->with('error', '予約時間30分前に、QRコードを発行できます。');
            }
        }
    
        // QRコードの生成処理
        $scanUrl = config('app.url') . "/order/scan/{$orderCode}";
        $qrCode = QrCode::size(300)->encoding('UTF-8')->generate($scanUrl);
    
        OrderCode::updateOrCreate(
            ['order_code' => $orderCode],
            ['is_scanned' => false]
        );
    
        return view('qr', [
            'orderCode' => $orderCode,
            'qrCode' => $qrCode,
            'isReserved' => $order->is_reserved,
        ]);
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

    public function scanWithoutAuth($orderCode)
    {
        // ユーザーがログインしている場合は、access.blade.php にリダイレクト
        if (Auth::check()) {
            return redirect()->route('order.wait', ['orderCode' => $orderCode]);
        }

        // ログイン後にリダイレクトするURLをセッションに保存
        session(['redirect_after_login' => route('order.wait', ['orderCode' => $orderCode])]);

        // ログインページへリダイレクト
        return redirect()->route('login')->with('error', 'QRコードを読み取るにはログインしてください');
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
        $discountedTotal = $orderItems->first()->discounted_total; // ✅ 割引後金額を1回だけ保存
        $first = true;

foreach ($orderItems as $order) {
    $saleData = [
        'user_id'      => $userId,
        'order_code'   => $order->order_code,
        'name'         => $order->name,
        'price'        => $order->price,
        'quantity'     => $order->quantity,
        'product_id'   => $order->product_id
    ];

    if ($first) {
        $saleData['discounted_total'] = $discountedTotal;
        $first = false;
    }

    Sale::create($saleData);
}

    
        // 🎯 予約情報がある場合、ドリンクバー(0円)を追加
        $reservation = $orderItems->first();
        if ($reservation->is_reserved && $reservation->guest_count > 0) {
            for ($i = 0; $i < $reservation->guest_count; $i++) {
                Sale::create([
                    'user_id'    => $userId,
                    'order_code' => $orderCode,
                    'name'       => 'ドリンクバー',
                    'price'      => 0,
                    'quantity'   => 1,
                ]);
            }
        }
    
        // 注文情報を削除
        Order::where('order_code', $orderCode)->delete();
    
        // ミニゲーム関連の処理
        $gameCount = intdiv($totalAmount, 1000); // 1000円ごとに1回
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

  
// OrderController.php

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

    $totalStamps = 0;
    $results = [];

    for ($i = 0; $i < $gameCount; $i++) {
        $random = rand(1, 100);
        if ($random <= 90) {
            $results[] = '🎉 大吉！スタンプ3個ゲット！ 🎉';
            $totalStamps += 3;
        } elseif ($random <= 95) {
            $results[] = '😊 中吉！スタンプ2個ゲット！ 😊';
            $totalStamps += 2;
        } else {
            $results[] = '😌 小吉！スタンプ1個ゲット！ 😌';
            $totalStamps += 1;
        }
    }

    $user = Auth::user();
    $user->stamps += $totalStamps;
    $user->save();

    session(['game_count' => 0]); // すべてプレイしたので0にリセット

    return redirect()->route('minigame')->with([
        'game_result' => implode("\n", $results),
        'stamps_earned' => $totalStamps,
        'game_count' => 0,
    ]);
}

}