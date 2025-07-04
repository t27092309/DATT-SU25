@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">🛒 Shopping Cart</h4>

    @if(session('cart'))
    <div class="alert alert-success">
        <strong>{{ session('message') }}</strong>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>SẢN PHẨM</th>
                <th>GIÁ</th>
                <th>SỐ LƯỢNG</th>
                <th>TẠM TÍNH</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach(session('cart') as $key => $item)
            @php
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            @endphp
            <tr>
                <td>
                    <img src="{{ $item['image'] }}" width="60"> {{ $item['name'] }}
                </td>
                <td>{{ number_format($item['price']) }}₫</td>
                <td>
                    <form action="{{ route('cart.update', $key) }}" method="POST" style="display:inline-flex;">
                        @csrf
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width:80px;">
                        <button class="btn btn-sm btn-secondary ms-1">Cập nhật</button>
                    </form>
                </td>
                <td>{{ number_format($subtotal) }}₫</td>
                <td>
                    <form action="{{ route('cart.remove', $key) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-danger">X</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6 offset-md-6">
            <table class="table">
                <tr>
                    <th>Tạm tính:</th>
                    <td>{{ number_format($total) }}₫</td>
                </tr>
                <tr>
                    <th>Phí ship:</th>
                    <td>30.000₫</td>
                </tr>
                <tr>
                    <th>Tổng cộng:</th>
                    <td><strong>{{ number_format($total + 30000) }}₫</strong></td>
                </tr>
            </table>

            <a href="{{ route('checkout.form') }}" class="btn btn-dark w-100 mb-2">TIẾN HÀNH THANH TOÁN</a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark w-100">MUA THÊM SẢN PHẨM</a>
        </div>
    </div>
    @else
        <p>Giỏ hàng đang trống.</p>
    @endif
</div>
@endsection
