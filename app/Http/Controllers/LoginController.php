<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        //
        return view('login');
    }


    public function login(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email:rfc,dns',
                'password' => 'required|string',
            ],[
            'email.required'=>'メールアドレスを入力してください。',
            'email.email'=>'正しいメールアドレス形式で入力してください。',
            'password.required'=>'パスワードを入力してください',
            ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => '該当するメールアドレスが見つかりません。',
            ])->withInput();
        }

        // パスワードの認証
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'password' => 'パスワードが正しくありません。',
            ])->withInput();
        }

        // 認証成功時の処理
        return redirect()->route('index');
    }
}
