@extends('layouts.admin')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4" required style="background-color: white; color: black;">Danh sách sản phẩm</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Thêm mới sản phẩm</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Image</th>
                            <th>Danh mục</th>
                            <th>Giá cơ bản</th>
                            <th>Giá khuyến mãi</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    @if ($product->image_url)
                                        <img src="{{ asset('storage/' . ltrim($product->image_url, '/')) }}"
                                            alt="Product Image" style="width: 80px; height: auto;">
                                    @endif
                                </td>

                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>{{ number_format($product->base_price, 0) }} VNĐ</td>
                                <td>
                                    {{ $product->sale_price ? number_format($product->sale_price, 0) . ' VNĐ' : 'Không' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.show', $product) }}"
                                        class="btn btn-info btn-sm">Xem</a>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này không?')">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Chưa có sản phẩm nào.</td>
                            </tr>
                        @endforelse
                    </tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
