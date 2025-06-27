@extends('layouts.app')

@section('title', '編輯留言')

@section('content')
    <h1>編輯留言</h1>

    @if ($errors->any())
        <div class="error alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('messages.update', $message->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label">標題</label>
            <input type="text" id="title" name="title" value="{{ old('title', $message->title) }}" 
                   class="form-control @error ('title') is-invalid @enderror"
                   required maxlength="50">
        @error('title')
            <div class="invalid-feedback" >{{$message}}</div>
        @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">留言內容(255字)</label>
            <textarea id="content" name="content" rows="5" class="form-control @error('content') is-invalid @enderror"
             required maxlength="255">{{ old('content', $message->content) }}</textarea>
             @error('content')
                <div class='invalid-feedback'>{{ $message }}</div>
             @enderror
        </div>

        <button type="submit" class="btn btn-primary">更新留言</button>
        <a href="{{ route('messages.index') }}" class="btn btn-secondary ms-2">取消</a>
    </form>
@endsection

