

@extends('layouts.app')

@section('title', '留言列表')

@section('content')
    <h1>留言列表</h1>

    {{-- 成功訊息 --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 錯誤訊息 --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- 搜尋表單 --}}
    <form method="GET" action="{{ route('messages.index') }}" class="mb-4 d-flex gap-2 align-items-center">
        <input type="text" name="title" placeholder="搜尋主題" value="{{ request('title') }}" class="form-control" />
        <input type="text" name="keyword" placeholder="搜尋內容" value="{{ request('keyword') }}" class="form-control" />
        <button type="submit" class="btn btn-primary">搜尋</button>
        <a href="{{ route('messages.index') }}" class="btn btn-secondary">清除</a>
    </form>

    {{-- 留言新增表單（僅登入使用者可見） --}}
    @auth
        <form method="POST" action="{{ route('messages.store') }}" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">標題</label>
                <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror"  maxlength="50" required value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">內容(最多255字)</label>
                <textarea id="content" name="content" rows="3" class="form-control @error('content') is-invalid @enderror" maxlength="255" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">發佈留言</button>
        </form>
    @else
        <p>請先 <a href="{{ route('login') }}">登入</a> 才能留言。</p>
    @endauth
    {{-- 留言列表 --}}
    @if ($messages->isEmpty())
        <p class="text-muted">沒有找到符合條件的留言。</p>
    @else
        @foreach ($messages as $message)
            <div class="card mb-3 p-3">
                <h5>{{ $message->title }}</h5>
                <p>{{ $message->content }}</p>
                <small>作者：{{ $message->author_name ?? '未知' }}</small>

                <div class="d-flex justify-content-between text-muted small mt-1">
                    <div>建立時間：{{ \Carbon\Carbon::parse($message->created_at)->format('Y-m-d H:i') }}</div>
                    <div>編輯時間：{{ \Carbon\Carbon::parse($message->updated_at)->format('Y-m-d H:i') }}</div>
                </div>

                <div class="mt-2">
                    @auth
                        @if(Auth::id() === $message->user_id)
                            <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-outline-primary btn-sm">編輯</a>

                            <form action="{{ route('messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('確定刪除這則留言嗎？');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">刪除</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    @endif
@endsection
