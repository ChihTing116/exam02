<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    /**
     * 顯示修改密碼表單
     */
    public function show()
    {
        return view('auth.passwords.change');
    }

    /**
     * 處理密碼修改
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ],[
            'current_password.required' => '請輸入目前密碼',

            'new_password.required'=>'請輸入新密碼',
            'new_password.min'=>'密碼至少6個字',
            'new_password.confirmed'=> '密碼確認不一致，請重新輸入',

        ]);

        $user = Auth::user();

        // 檢查舊密碼是否正確
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => '當前密碼不正確']);
        }

        // 更新密碼
        $user->password = Hash::make($request->new_password);
        $user->save();

        Auth::logout(); // 登出

    return redirect()->route('login')->with('success', '密碼已更新，請重新登入！');
    }
}
