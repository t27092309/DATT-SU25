@extends('layouts.app') {{-- Assuming you have a main layout file --}}

@section('title', 'Giỏ hàng của bạn')

@section('content')
    <div class="container my-5">
        <h1>Giỏ hàng của bạn</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (empty($cart))
            <p>Giỏ hàng của bạn hiện đang trống. <a href="{{ route('home') }}">Tiếp tục mua sắm!</a></p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Màu sắc</th>
                            <th>Kích cỡ</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalCartPrice = 0;
                        @endphp
                        @foreach ($cart as $key => $item)
                            @php
                                $itemTotalPrice = $item['price'] * $item['quantity'];
                                $totalCartPrice += $itemTotalPrice;
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                        <a href="{{ route('product.detail', $item['slug']) }}">{{ $item['name'] }}</a>
                                    </div>
                                </td>
                                <td>{{ $item['color'] }}</td>
                                <td>{{ $item['size'] }}</td>
                                <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <form action="{{ route('cart.update', $key) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width: 70px; margin-right: 5px;">
                                        <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                                    </form>
                                </td>
                                <td>{{ number_format($itemTotalPrice, 0, ',', '.') }} VNĐ</td>
                                <td>
                                    <form action="{{ route('cart.remove', $key) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right"><strong>Tổng cộng:</strong></td>
                            <td colspan="2"><strong>{{ number_format($totalCartPrice, 0, ',', '.') }} VNĐ</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('home') }}" class="btn btn-secondary">Tiếp tục mua sắm</a>
                <a href="{{ route('checkout.index') }}" class="btn btn-success">Tiến hành thanh toán</a>
            </div>
        @endif
    </div>
@endsection