@extends('layouts.admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4" required style="background-color: white; color: black;">Chi tiết sản phẩm</h2>

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">Quay lại danh sách</a>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    @if ($product->image_url)
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image" class="img-fluid rounded">
                    @else
                        <p>Không có ảnh sản phẩm</p>
                    @endif
                </div>

                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <th>Tên sản phẩm:</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Danh mục:</th>
                            <td>{{ $product->category->name ?? 'Không rõ' }}</td>
                        </tr>
                        <tr>
                            <th>Thương hiệu:</th>
                            <td>{{ $product->brand ?? 'Không rõ' }}</td>
                        </tr>
                        <tr>
                            <th>Giá cơ bản:</th>
                            <td>{{ number_format($product->base_price, 0) }} VNĐ</td>
                        </tr>
                        <tr>
                            <th>Giá khuyến mãi:</th>
                            <td>
                                {{ $product->sale_price ? number_format($product->sale_price, 0).' VNĐ' : 'Không' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Số lượng đã bán:</th>
                            <td>{{ $product->sold_quantity }}</td>
                        </tr>
                        <tr>
                            <th>Mô tả sản phẩm:</th>
                            <td>{{ $product->description ?? 'Không có mô tả' }}</td>
                        </tr>
                        <tr>
                            <th>Slug:</th>
                            <td>{{ $product->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
