<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>留言板 | @yield('title', '我的網站')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('messages.index') }}">留言板</a>

    <div class="ms-auto">
      <ul class="navbar-nav mb-2 mb-lg-0">
        @auth
          <li class="nav-item d-flex align-items-center">
            <span class="me-2 text-light">
              👤 {{ Auth::user()->nickname }}（{{ Auth::user()->email }}）
            </span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-danger btn-sm me-2">登出</button>
            </form>
            <a href="{{ route('password.change') }}" class="btn btn-outline-warning btn-sm">修改密碼</a>

          </li>
        @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登入</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">註冊</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
