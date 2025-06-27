<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 顯示註冊表單
    public function show()
    {
        return view('auth.register');
    }

    // 處理註冊請求
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nickname' => 'required|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ],[
            'nickname.required' => '請輸入作者名字',
            'nickname.max'      => '名字不能超過 255 字',

            'email.required'    => '請輸入 Email',
            'email.email'       => '請輸入正確的 Email 格式',
            'email.unique'      => '這個 Email 已經被註冊過了',

            'password.required' => '請輸入密碼',
            'password.min'      => '密碼至少需要 6 個字',
            'password.confirmed'=> '密碼確認不一致，請重新輸入',
    ]); 

        User::create([
            'nickname' => $validated['nickname'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', '註冊成功，請登入');
    }
}
