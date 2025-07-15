@extends('layouts.app')

@section('content')
    <div class="container checkout-page" style="padding-top: 100px; padding-bottom: 50px;">
        <h2 class="text-center mb-4">Tiến hành Thanh toán</h2>

        {{-- Hiển thị thông báo flash (success/error) --}}
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @if (empty($cart))
            <div class="alert alert-info text-center">
                Giỏ hàng của bạn trống. Vui lòng thêm sản phẩm trước khi thanh toán.
                <br>
                <a href="{{ route('product.index') }}" class="btn btn-primary mt-3">Quay lại cửa hàng</a>
            </div>
        @else
            <div class="row">
                {{-- Cột thông tin khách hàng và địa chỉ --}}
                <div class="col-md-7">
                    <div class="card mb-4">
                        <div class="card-header">
                            Thông tin Khách hàng và Vận chuyển
                        </div>
                        <div class="card-body">
                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="customer_name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name', $user->name ?? '') }}" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="customer_email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email', $user->email ?? '') }}" required>
                                    @error('customer_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="customer_phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                                    @error('customer_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="shipping_address" class="form-label">Địa chỉ nhận hàng <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('shipping_address') is-invalid @enderror" id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address') }}</textarea>
                                    @error('shipping_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Tùy chọn: Phương thức thanh toán --}}
                                {{-- <div class="mb-3">
                                    <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                                    <select class="form-select" id="payment_method" name="payment_method">
                                        <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                                        <option value="bank_transfer">Chuyển khoản ngân hàng</option>
                                    </select>
                                </div> --}}

                                {{-- Tùy chọn: Ghi chú --}}
                                {{-- <div class="mb-3">
                                    <label for="notes" class="form-label">Ghi chú (tùy chọn)</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                                </div> --}}

                                <button type="submit" class="btn btn-success btn-lg w-100 mt-3">Xác nhận và Đặt hàng</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Cột tổng quan đơn hàng --}}
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            Tóm tắt Đơn hàng
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush mb-3">
                                @php $totalOrderPrice = 0; @endphp
                                @foreach ($cart as $item)
                                    @php $itemSubtotal = $item['price'] * $item['quantity']; $totalOrderPrice += $itemSubtotal; @endphp
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold">{{ $item['name'] }}</span>
                                            <br>
                                            <small>{{ $item['color'] }} / {{ $item['size'] }} x {{ $item['quantity'] }}</small>
                                        </div>
                                        <span>{{ number_format($itemSubtotal, 0, ',', '.') }}₫</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="d-flex justify-content-between align-items-center fw-bold fs-5 mt-3">
                                <span>Tổng cộng:</span>
                                <span>{{ number_format($totalOrderPrice, 0, ',', '.') }}₫</span>
                            </div>
                            <small class="text-muted d-block text-end mt-2">Phí vận chuyển sẽ được tính sau.</small>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection