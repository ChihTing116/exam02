@extends('layouts.app')

@section('title', '新增留言')

@section('content')
    <h1>新增留言</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <textarea name="content" rows="5" placeholder="請輸入留言內容">{{ old('content') }}</textarea>
        <br>
        <button type="submit">送出</button>
    </form>
@endsection

