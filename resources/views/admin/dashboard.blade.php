@extends('layouts.app')
@section('content')
<h2>Trang quản trị - Xin chào {{ Auth::user()->username }}</h2>
@endsection

@extends('layouts.admin') {{-- Đảm bảo bạn đã có layouts.admin.blade.php và nó hoạt động --}}

@section('content')
    <div class="container mt-4">
        <h1 class="text-white">Chào mừng đến trang Dashboard Admin!</h1>
        <p class="text-white-50">Đây là nơi bạn có thể thêm các widget và thông tin tổng quan.</p>

        {{-- Ví dụ một card đơn giản --}}
        <div class="card bg-dark text-white rounded-3 shadow-sm mt-4" style="max-width: 600px;">
            <div class="card-body">
                <h5 class="card-title">Thông tin nhanh</h5>
                <p class="card-text">Tổng số người dùng: <strong>123</strong></p>
                <p class="card-text">Tổng số danh mục: <strong>{{ \App\Models\Category::count() ?? 0 }}</strong></p>
            </div>
        </div>
    </div>
@endsection

