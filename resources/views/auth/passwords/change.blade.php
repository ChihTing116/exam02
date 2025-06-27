@extends('layouts.app')

@section('title', '修改密碼')

@section('content')
    <h1 class="mb-4">修改密碼</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-4">
        <form method="POST" action="{{ route('password.update')  }}">
            @csrf

            <div class="mb-3">
                <label for="current_password" class="form-label">當前密碼</label>
                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    class="form-control"
                    required
                    autocomplete="current-password"
                >
            </div>

            <div class="mb-3">
                <label for="new_password" class="form-label">新密碼(至少6碼)</label>
                <input
                    type="password"
                    id="new_password"
                    name="new_password"
                    class="form-control"
                    required
                    minlength="6"
                    autocomplete="new-password"
                >
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">確認新密碼</label>
                <input
                    type="password"
                    id="new_password_confirmation"
                    name="new_password_confirmation"
                    class="form-control"
                    required
                    autocomplete="new-password"
                >
            </div>

            <button type="submit" class="btn btn-primary">更新密碼</button>
        </form>
    </div>
@endsection
