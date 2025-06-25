@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 required style="background-color: white; color: black;">Danh sách biến thể sản phẩm</h2>
    <a href="{{ route('admin.variants.create') }}" class="btn btn-primary mb-3">Thêm biến thể</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sản phẩm</th>
                <th>Màu</th>
                <th>Size</th>
                <th>Tồn kho</th>
                <th>Giá phụ trội</th>
                <th>Ảnh riêng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($variants as $variant)
            <tr>
                <td>{{ $variant->variant_id }}</td>
                <td>{{ $variant->product->name ?? 'N/A' }}</td>
                <td>{{ $variant->color }}</td>
                <td>{{ $variant->size }}</td>
                <td>{{ $variant->stock_quantity }}</td>
                <td>{{ number_format($variant->price_modifier) }} đ</td>
                <td>{{ $variant->image_url_specific }}</td>
                <td>
                    <a href="{{ route('admin.variants.edit', $variant) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('admin.variants.destroy', $variant) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
