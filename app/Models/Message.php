<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    use HasFactory;
    

    // 允許批量填充
    protected $fillable = [
        'user_id',
        'title',

        'content',
    ];
    // app/Models/Message.php


     public static function getMessagesWithParam(Request $request)
    {
        return DB::table('messages')
            ->join('users', 'messages.user_id', '=', 'users.id')
            ->select('messages.*', 'users.nickname as author_name')
            ->when($request->filled('title'), function ($q) use ($request) {
                $q->where('messages.title', 'like', "%{$request->title}%");
            })
            ->when($request->filled('keyword'), function ($q) use ($request) {
                $q->where('messages.content', 'like', "%{$request->keyword}%");
            })
            ->orderBy('messages.created_at', 'desc')
            ->get();
    }
}

//     // 一則留言屬於一個使用者
//     public function user()
//     {
//         return $this->belongsTo(User::class);
//     }//很少用
// }