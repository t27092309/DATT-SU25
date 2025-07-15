@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">💳 Thông tin thanh toán</h4>

    <form action="{{ route('checkout.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Họ tên</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="address">Địa chỉ giao hàng</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success w-100">XÁC NHẬN ĐẶT HÀNG</button>
    </form>
</div>
@endsection
