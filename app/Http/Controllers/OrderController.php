<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        // ユーザーの過去の注文を取得し、`order_code` ごとにグループ化
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('order_code');

        return view('orderlist', compact('orders'));
    }

    public function registerOrder()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'カートが空です');
        }

        // ✅ 一意の注文コードを生成
        $orderCode = 'ORDER-' . date('Ymd') . '-' . Str::random(6);
        Log::info('Generated Order Code: ' . $orderCode);

        // ✅ 商品ごとに数量を集約（キーを `name` で管理）
        $orderData = [];

        foreach ($cartItems as $item) {
            $key = $item->name;

            if (isset($orderData[$key])) {
                $orderData[$key]['quantity'] += 1;
            } else {
                $orderData[$key] = [
                    'user_id' => Auth::id(),
                    'order_code' => $orderCode,  
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => 1,
                ];
            }
        }


        foreach ($orderData as $order) {
            Log::info('Saving Order: ', $order);
            if (!isset($order['order_code'])) {
                Log::error('Order Code is missing before saving order.', $order);
            }
            Order::create($order);
        }

        // ✅ `carts` テーブルを削除
        Cart::where('user_id', Auth::id())->delete();
        Log::info('Cart cleared for user: ' . Auth::id());

        return redirect()->route('menu')->with('success', '注文が登録されました');
    }

    public function viewOrder()
    {
        return $this->index(); //他のメソッドを呼び出す
    }

    public function generateQRCode($orderCode)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        // 指定された `order_code` の注文情報を取得
        $orderItems = Order::where('user_id', Auth::id())
            ->where('order_code', $orderCode)
            ->get();

        if ($orderItems->isEmpty()) {
            return redirect()->route('order.view')->with('error', '注文が見つかりません');
        }

        // JSONデータを作成
        $orderData = $orderItems->map(function ($item) {
            return [
                '商品名' => $item->name,
                '値段' => $item->price,
                '数量' => $item->quantity,
            ];
        });

        // QRコードを生成
        $qrCode = QrCode::size(300)->encoding('UTF-8')->generate(json_encode($orderData, JSON_UNESCAPED_UNICODE));

        return view('qr', compact('qrCode', 'orderCode'));
    }
}
