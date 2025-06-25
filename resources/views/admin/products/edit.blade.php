@extends('layouts.admin')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4" required style="background-color: white; color: black;">Chỉnh sửa sản phẩm</h2>

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">Quay lại danh sách</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Danh mục *</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá cơ bản *</label>
                    <input type="number" step="0.01" name="base_price" class="form-control" value="{{ old('base_price', $product->base_price) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá khuyến mãi</label>
                    <input type="number" step="0.01" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Thương hiệu</label>
                    <input type="text" name="brand" class="form-control" value="{{ old('brand', $product->brand) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Số lượng đã bán</label>
                    <input type="number" name="sold_quantity" class="form-control" value="{{ old('sold_quantity', $product->sold_quantity) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh hiện tại</label><br>
                    @if ($product->image_url)
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image" style="width: 150px; height: auto; margin-bottom: 10px;">
                    @else
                        Không có ảnh
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Cập nhật hình ảnh mới (tùy chọn)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
            </form>
        </div>
    </div>
</div>
@endsection
