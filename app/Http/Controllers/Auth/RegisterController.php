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
    public function register(Request $request)
    {
        $request->validate([
            'nickname' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'nickname' => $request->nickname,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', '註冊成功，請登入');
    }
}
