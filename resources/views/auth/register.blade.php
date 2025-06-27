@extends('layouts.app')

@section('title', '註冊')
 
@section('content')
    <h1 class="mb-4">註冊</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="nickname" class="form-label">暱稱</label>
                <input
                    type="text"
                    id="nickname"
                    name="nickname"
                    value="{{ old('nickname') }}"
                    class="form-control"
                    required
                    autofocus
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">電子郵件</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">密碼(至少6碼)</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    required
                    autocomplete="new-password"
                >
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">確認密碼(至少6碼)</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">註冊</button>
        </form>
    </div>
@endsection
