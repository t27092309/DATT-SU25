<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Laravel Auth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

</head>
<style>
    body {
        background: linear-gradient(to right, #e9f0f9, #f3f8ff);
        min-height: 100vh;
    }

    .card {
        margin-top: 50px;
        border-radius: 1rem;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Trang chủ</a>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="ms-auto">
                    @csrf
                    <button class="btn btn-danger">Đăng xuất</button>
                </form>
            @endauth
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
