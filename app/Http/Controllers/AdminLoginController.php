<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{

    //管理ユーザーログイン
    public function admin_index()
    {
        //
        return view('admin_login');
    }

    public function admin_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'password.required' => 'パスワードを入力してください。',
        ]);

        // Guard を使って admins テーブルを対象にログイン
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->route('admin.index'); // 管理画面へ
        }

        \Log::info('管理者ログイン失敗', ['email' => $request->email]);
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが間違っています'
        ])->withInput();
    }
}
