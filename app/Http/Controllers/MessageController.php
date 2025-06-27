<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $messages = Message::getMessagesWithParam($request); // 改用模型方法處理條件查詢
        return view('messages.index', compact('messages'));
    }

    /**
     * 儲存留言
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required|max:255',
        ],[
            'title.required' => '請輸入標題',
            'title.max' => '標題不能超過 50 字',

            'content.required' => '請輸入內容',
            'content.max' => '內容不能超過 255 字',
    ]);

        $user_id = Auth::id();

        if (!$user_id) {
            return redirect()->route('messages.index')->with('error', '請先登入才能留言');
        }

        Message::create([
            'user_id' => $user_id,
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('messages.index')->with('success', '留言發佈成功！');
    }

    /**
     * 顯示編輯留言表單
     */
    public function edit(string $id)
    {
        $message = Message::findOrFail($id);

        // 檢查是否為本人
        if (Auth::id() !== $message->user_id) {
            return redirect()->route('messages.index')
            ->with('error', '你沒有權限編輯這筆留言。');
    }
        //     return back()->with('error', '你不能編輯別人的留言');
        // }

        return view('messages.edit', compact('message'));
    }

    /**
     * 更新留言
     */
    public function update(Request $request, string $id)
    {
        $message = Message::findOrFail($id);

        // 檢查是否為本人
        if (Auth::id() !== $message->user_id) {
            return back()->with('error', '你不能修改別人的留言');
        }
           $validated = $request->validate([
                'title' => 'required|max:50',
                'content' => 'required|max:255',
           ],[
                'title.required' => '請輸入標題',
                'title.max' => '標題不能超過 50 字',
                'content.required' => '請輸入內容',
                'content.max' => '內容不能超過 255 字',
        ]);

        $message->update($validated);

        return redirect()->route('messages.index')->with('success', '留言更新成功');
    }

    /**
     * 刪除留言
     */
    public function destroy(string $id)
    {
        $message = Message::findOrFail($id);

        // 檢查是否為本人
        if (Auth::id() !== $message->user_id) {
            return back()->with('error', '你不能刪除別人的留言');
        }

        $message->delete();
        return redirect()->route('messages.index')->with('success', '留言刪除成功');
    }
}
