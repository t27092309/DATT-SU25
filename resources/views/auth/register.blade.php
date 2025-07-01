@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow rounded-4 border-0">
            <div class="card-header bg-primary text-white text-center rounded-top-4">
                <h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Đăng ký tài khoản</h4>
            </div>
            <div class="card-body px-4 py-4">
                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li><i class="bi bi-exclamation-circle me-1 text-danger"></i>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Tên đăng nhập" value="{{ old('username') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Xác nhận lại mật khẩu" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">
                        <i class="bi bi-check-circle me-1"></i> Đăng ký
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <small>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
