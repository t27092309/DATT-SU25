@extends('layouts.app')

@section('content')
    <div class="container text-center" style="padding-top: 100px; padding-bottom: 50px;">
        <h2 class="mb-4 text-success">Đơn hàng của bạn đã được đặt thành công!</h2>
        <p class="lead">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
        <p>Chi tiết đơn hàng sẽ được gửi đến email của bạn trong ít phút.</p>
        <div class="mt-4">
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Tiếp tục mua sắm</a>
            {{-- Hoặc link đến trang lịch sử đơn hàng của người dùng nếu có --}}
            {{-- <a href="{{ route('user.orders') }}" class="btn btn-info btn-lg ms-3">Xem đơn hàng của tôi</a> --}}
        </div>
    </div>
@endsection