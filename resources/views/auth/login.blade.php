@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow rounded-4 border-0">
            <div class="card-header bg-success text-white text-center rounded-top-4">
                <h4 class="mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập</h4>
            </div>
            <div class="card-body px-4 py-4">
                @if (session('success'))
                    <div class="alert alert-success rounded-3">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li><i class="bi bi-exclamation-circle me-1 text-danger"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Tên đăng nhập" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold">
                        <i class="bi bi-door-open me-1"></i> Đăng nhập
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <small>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
