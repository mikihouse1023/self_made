<?php

namespace App\Http\Controllers;

use App\Models\SetMeal;
use App\Models\SideMenu;
use App\Models\Dish;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
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


    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        Cart::create([
            'user_id' => Auth::id(),
            'item_id' => $request->input('item_id'),
            'category' => $request->input('category'), // カテゴリを追加
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $request->input('image')
        ]);

        return redirect()->route('menu')->with('success', 'カートに追加しました');
    }

    public function viewCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('cart', compact('cartItems'));
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
