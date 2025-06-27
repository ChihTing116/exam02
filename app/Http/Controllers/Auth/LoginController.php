<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 顯示登入表單
     */
    public function show()
    {
        if (Auth::check()) {
            return redirect()->route('messages.index'); // 已登入就導回留言列表
        }

        return view('auth.login');
    }

    /**
     * 處理登入請求
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('messages.index'));
        }

        return back()->withInput()->with('error', '帳號或密碼錯誤！');
    }

    /**
     * 處理登出
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', '已成功登出！');
    }
}
